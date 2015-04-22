import sqlite3

conn = sqlite3.connect('database.txt')

c = conn.cursor()

# Create table
c.execute('''CREATE TABLE IV
             (time time, panel_voltage integer, panel_power integer, battery_current integer, battery_voltage integer)''')

conn.commit()


conn.close()
