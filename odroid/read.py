import sqlite3
conn = sqlite3.connect('database.txt')
c = conn.cursor()

c.execute("SELECT * FROM IV")

print c.fetchone()

conn.close()
