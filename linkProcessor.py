#!/usr/bin/env python

import requests
import json
import cgi
import cgitb; cgitb.enable()  # for troubleshooting

print "Content-type: text/html"
print ""

form = cgi.FieldStorage()
long_url = form.getvalue("long_url")

#Process the link to the bit.ly
query_params = {'access_token': '071aae6f9506878ab9b975e1d29882882cd8778a',
					'login': 'Yakumanification',
					'longUrl': long_url} 

endpoint = 'https://api-ssl.bitly.com/v3/shorten'
response = requests.get(endpoint, params=query_params, verify=True)

data = json.loads(response.content)
result = data ['data']['url']

print result