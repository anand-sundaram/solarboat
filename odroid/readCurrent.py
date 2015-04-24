#!/usr/bin/env python

import os, subprocess, sqlite3, datetime

output = subprocess.check_output("cat /sys/class/saradc/saradc_ch0", shell=True)

reading = int(output.strip())
print reading

current = reading

print current

conn = sqlite3.connect('/bobodata/database.txt')

c = conn.cursor()

date = datetime.datetime.now()
year = date.year
month = date.month
tableName = "y" + str(year) + "m" + str(month)

time = date.strftime("%Y-%m-%d %H:%M:%S")

print time

# Create table
c.execute("CREATE TABLE IF NOT EXISTS "+tableName+"Current (time time, load_current integer)")

c.execute("INSERT INTO "+tableName+"Current VALUES('"+time+"', '"+str(current)+"')")

conn.commit()


conn.close()
