import statistics
import mysql.connector
from collections import deque

class FullException(Exception):
	pass

class IncorrectDataException(Exception):
	pass

class Table(object):
	def __init__(self, id, size):
		self.id = id
		self.size = size
		self.ppl = []

	def append(self, pers_id):
		if self.full():
			raise FullException("the table is already filled")
		else:
			self.ppl.append(pers_id)

	def full(self):
		return len(self.ppl) == self.size

def get_ppl_amount(db, wedd_id):
	cur = db.cursor(buffered=True)

	req = (
		"SELECT count(*) "
		"FROM Contact "
		"WHERE cont_idM = %s"
	)
	cur.execute(req, (wedd_id,))

	ppl_amount = cur.next()[0]

	cur.close()

	return ppl_amount

def get_total_seats(db, wedd_id):
	cur = db.cursor(buffered=True)
	req = (
		"SELECT sum(listTab_nbPlaces) "
		"FROM ListeTables "
		"WHERE listTab_idM = %s"
	)
	cur.execute(req, (wedd_id,))

	total_seats = cur.next()[0]

	cur.close()

	return total_seats


def get_tables(db, wedd_id):
	cur = db.cursor(buffered=True)
	req = (
		"SELECT listTab_id, listTab_nbPlaces "
		"FROM ListeTables "
		"WHERE listTab_idM = %s "
		"ORDER BY listTab_nbPlaces"
	)
	cur.execute(req, (wedd_id,))

	tables = deque()

	for (id, size) in cur:
		tables.append(Table(id, size))

	cur.close()

	ppl_amount = get_ppl_amount(db, wedd_id)
	total_seats = get_total_seats(db, wedd_id)

	if ppl_amount > total_seats:
		raise IncorrectDataException("less seats than people")

	def chop_left():
		nonlocal total_seats

		tb_size = tables[0].size
		if total_seats - tb_size < ppl_amount:
			return False
		else:
			tables.popleft()
			total_seats -= tb_size
			return True

	def chop_right():
		nonlocal total_seats

		tb_size = tables[len(tables) -1].size
		if total_seats - tb_size < ppl_amount:
			return False
		else:
			tables.pop()
			total_seats -= tb_size
			return True

	while chop_left() and chop_right():
		pass

	while chop_left():
		pass

	tables.reverse() # ugly, it should be reversed in the SQL request

	return tables
