#!/usr/bin/python3

import mysql.connector
import networkx as nx

import tables

db = mysql.connector.connect(host="mywedding.gdn", db="base", user="iut2info", passwd="projetweb")


wedd_id = 1

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


for table in tables.get_tables(db, 1):
	while not table.full() and g.number_of_nodes() != 0:
		try:
			for p_id in nx.maximal_independent_set(g):
				table.append(p_id)
				g.remove_node(p_id)
		except tables.FullException:
			pass


db.close()
