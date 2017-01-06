#!/usr/bin/python3

import mysql.connector
import networkx as nx
import sys

import tables

db = mysql.connector.connect(host="mywedding.gdn", db="base", user="iut2info", passwd="projetweb")


wedd_id = int(sys.argv[1])

g = nx.Graph()


cur = db.cursor(buffered=True)

ppl = (
	"SELECT cont_id "
	"FROM Contact "
	"WHERE cont_idM = %s"
)

cur.execute(ppl, (wedd_id,))

for (cont_id,) in cur:
	g.add_node(cont_id)

cur.close()


cur = db.cursor(buffered=True)
pref = (
	"SELECT pref_idContact, pref_idContact2, pref_aime "
	"FROM Preferences "
	"WHERE pref_idM = %s"
)

cur.execute(pref, (wedd_id,))

for (c1, c2, aime) in cur:
	if aime == "non":
		g.add_edge(c1, c2)

g.remove_node


for table in tables.get_tables(db, wedd_id):
	while not table.full() and g.number_of_nodes() != 0:
		try:
			for p_id in nx.maximal_independent_set(g):
				table.append(p_id)
				g.remove_node(p_id)
		except tables.FullException:
			pass

	if len(table.ppl) != 0:
		req = (
			"UPDATE Contact "
			"SET cont_idT = %s "
		)
		for i, pers_id in enumerate(table.ppl):
			if i == 0:
				req += "WHERE cont_id = " + str(pers_id)
			else:
				req += " OR cont_id = " + str(pers_id)

		cur = db.cursor(buffered=True)
		cur.execute(req, (table.id,))
		db.commit()
		cur.close()
		print(table.id, req)


db.close()
