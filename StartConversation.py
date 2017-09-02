#!/usr/bin/python
import MySQLdb
import sys
db = MySQLdb.connect(host="filantropiadb.c8sdfecsnkao.us-east-2.rds.amazonaws.com",    # your host, usually localhost
                     user="user",         # your username
                     passwd="password",  # your password
                     db="Botzilla")        # name of the data base

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Use all the SQL you like
cur.execute("Call SP_AddConversation(" + sys.argv[1] + ")")

# print all the first cell of all the rows
for row in cur.fetchall():
    print row[0]

db.close()
