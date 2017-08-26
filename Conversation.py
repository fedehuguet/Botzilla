#!/usr/bin/python
import urllib2
import urllib

import string
import json
from watson_developer_cloud import ConversationV1
import urlparse
import MySQLdb

import sys

db = MySQLdb.connect(host="filantropiadb.c8sdfecsnkao.us-east-2.rds.amazonaws.com",    # your host, usually localhost
                     user="Jolum",         # your username
                     passwd="FilantropiaDB1234",  # your password
                     db="Botzilla")        # name of the data base

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

conversation = ConversationV1(
        username='d19359df-e6fc-4774-8fdc-1e5fea2eee42',
        password='5FDnK2H87H5d',
        version='2017-04-21')

workspace_id = '6438675d-c6bf-4e9f-8222-ddc0ed1a4a65'
response = []
if mcontext == "-1":
    response = conversation.message(workspace_id=workspace_id, message_input={
        'text': sys.argv[2]} )
else:
    response = conversation.message(workspace_id=workspace_id, message_input={
        'text': sys.argv[2]}, context=mcontext)

db = MySQLdb.connect(host="filantropiadb.c8sdfecsnkao.us-east-2.rds.amazonaws.com",    # your host, usually localhost
                     user="Jolum",         # your username
                     passwd="FilantropiaDB1234",  # your password
                     db="Botzilla")        # name of the data base

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Use all the SQL you like
cur.execute("CALL SP_UpdateContext(" + sys.argv[1] + ", \'" + str(response['context']) + "\');")
db.close()

print(json.dumps(response['output']['text'][0]))
