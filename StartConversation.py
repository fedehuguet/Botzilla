#!/usr/bin/python
import MySQLdb

db = MySQLdb.connect(host="filantropiadb.c8sdfecsnkao.us-east-2.rds.amazonaws.com",    # your host, usually localhost
                     user="Jolum",         # your username
                     passwd="FilantropiaDB1234",  # your password
                     db="Botzilla")        # name of the data base

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Use all the SQL you like
cur.execute("SP_AddConversation();")

# print all the first cell of all the rows
for row in cur.fetchall():
    print row[0]

db.close()
