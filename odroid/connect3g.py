#!/usr/bin/env python

import urllib2, subprocess, datetime, sqlite3 as lite, sys, requests

date = datetime.datetime.now()

def internet_on():
    try:
        response=urllib2.urlopen('http://www.google.com',timeout=3)
        return True
    except urllib2.URLError as err: pass
    return False

def can_connect():
    output = subprocess.check_output('.././sakis3g connect --nostorage --pppd APN="sunsurf" APN_USER="0" APN_PASS="0" USBINTERFACE="1" USBDRIVER="option" OTHER="USBMODEM" USBMODEM="12d1:1003"', shell=True)
    #subprocess.call('.././sakis3g connect --nostorage --pppd APN="sunsurf" APN_USER="0" APN_PASS="0" USBINTERFACE="1" USBDRIVER="option" OTHER="USBMODEM" USBMODEM="12d1:1003"')
    print(output)
    if internet_on():
        return True
    return False

def log(message):
    f = open('/bobodata/log', 'a')
    f.write(message)
    f.close()

if internet_on() or can_connect():
    log(str(date)+" Yay connected :)\n")
    #send some data
    con = lite.connect('/bobodata/database.txt')

    with con:
        cur = con.cursor()
        tableName = "y" + str(date.year) + "m" + str(date.month)
        cur.execute("SELECT * FROM "+tableName+"Voltage")
        rows = cur.fetchall()

        for row in rows:
           print row
           requests.post("http://solarboat.d1.comp.nus.edu.sg/cgi-bin/newVoltage.py", data={'time' : row[0],  'battery_voltage': row[1]})
           cur.execute("DELETE FROM "+tableName+"Voltage WHERE time = '"+row[0]+"'")


        cur.execute("SELECT * FROM "+tableName+"Current")
        rows = cur.fetchall()

        for row in rows:
           print row
           requests.post("http://solarboat.d1.comp.nus.edu.sg/cgi-bin/newCurrent.py", data={'time' : row[0],  'load_current': row[1]})
           cur.execute("DELETE FROM "+tableName+"Current WHERE time = '"+row[0]+"'")

        cur.execute("SELECT * FROM "+tableName+"MPPT")
        rows = cur.fetchall()

        for row in rows:
           print row
           requests.post("http://solarboat.d1.comp.nus.edu.sg/cgi-bin/newMPPT.py", data={'time' : row[0], 'panel_voltage' : row[1], 'panel_power' : row[2],'battery_voltage' : row[3], 'battery_current' : row[4]})
           cur.execute("DELETE FROM "+tableName+"MPPT WHERE time = '"+row[0]+"'")        


else:
    log(str(date)+" Couldn't connect :(\n")

    
