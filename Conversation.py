#!/usr/bin/python
# coding=utf-8
import urllib2
import urllib

import string
import json
from watson_developer_cloud import ConversationV1
import urlparse
import MySQLdb

import sys

db = MySQLdb.connect(host="filantropiadb.c8sdfecsnkao.us-east-2.rds.amazonaws.com",  # your host, usually localhost
                     user="Jolum",  # your username
                     passwd="FilantropiaDB1234",  # your password
                     db="Botzilla")  # name of the data base

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Use all the SQL you like
cur.execute("CALL SP_GetContext(" + sys.argv[1] + ");")

# print all the first cell of all the rows

mcontext = "-1"
for row in cur.fetchall():
    mcontext = row[0]

db.close()

db = MySQLdb.connect(host="filantropiadb.c8sdfecsnkao.us-east-2.rds.amazonaws.com",  # your host, usually localhost
                     user="Jolum",  # your username
                     passwd="FilantropiaDB1234",  # your password
                     db="Botzilla")  # name of the data base

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Use all the SQL you like
cur.execute("CALL SP_VerifyConversation(" + sys.argv[1] + ");")

# print all the first cell of all the rows

countConver = 0
for row in cur.fetchall():
    countConver = row[0]

db.close()

if countConver > 0:
    conversation = ConversationV1(
        username='d19359df-e6fc-4774-8fdc-1e5fea2eee42',
        password='5FDnK2H87H5d',
        version='2017-04-21')

    workspace_id = '6dbc2654-4bc8-4767-9f0e-c118434dead5'
    response = []
    if mcontext == "-1":
        response = conversation.message(workspace_id=workspace_id, message_input={
            'text': sys.argv[2]})
    else:
        response = conversation.message(workspace_id=workspace_id, message_input={
            'text': sys.argv[2]}, context=json.loads(mcontext))

    db = MySQLdb.connect(host="filantropiadb.c8sdfecsnkao.us-east-2.rds.amazonaws.com",  # your host, usually localhost
                         user="Jolum",  # your username
                         passwd="FilantropiaDB1234",  # your password
                         db="Botzilla")  # name of the data base

    # you must create a Cursor object. It will let
    #  you execute all the queries you need
    cur = db.cursor()

    # Use all the SQL you like
    proce = "CALL SP_UpdateContext(" + sys.argv[1] + ", \'" + json.dumps(response['context']) + "\', " + json.dumps(
        response['intents'][0]['intent']) + ");"
    cur.execute(proce)
    db.close()

    if ord(response['output']['text'][0][0]) == ord(str("~")):
        print("1")
        xb = MySQLdb.connect(host="filantropiadb.c8sdfecsnkao.us-east-2.rds.amazonaws.com",
                             # your host, usually localhost
                             user="Jolum",  # your username
                             passwd="FilantropiaDB1234",  # your password
                             db="Botzilla")  # name of the data base

        # you must create a Cursor object. It will let
        #  you execute all the queries you need
        cur = xb.cursor()

        # Use all the SQL you like
        proce = "CALL SP_SetSovedUnSolved(" + sys.argv[1] + ",\'Sí\');"
        cur.execute(proce)
        xb.close()
    elif ord(response['output']['text'][0][0]) == ord(str("^")):
        print("2")
        xb = MySQLdb.connect(host="filantropiadb.c8sdfecsnkao.us-east-2.rds.amazonaws.com",
                             # your host, usually localhost
                             user="Jolum",  # your username
                             passwd="FilantropiaDB1234",  # your password
                             db="Botzilla")  # name of the data base

        # you must create a Cursor object. It will let
        #  you execute all the queries you need
        cur = xb.cursor()

        # Use all the SQL you like
        proce = "CALL SP_SetSovedUnSolved(" + sys.argv[1] + ",\'No\');"
        cur.execute(proce)
        xb.close()

    print(json.dumps(response['output']['text'][0]))
else:
    print("error")
