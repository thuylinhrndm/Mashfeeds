#!/usr/bin/env python

import requests
import json
import cgi
import cgitb; cgitb.enable()  # for troubleshooting

print "Content-type: text/html"
print ""

form = cgi.FieldStorage()
link = form.getvalue("link")

query_params = {'access_token': '071aae6f9506878ab9b975e1d29882882cd8778a',
                'link': link,
                'unit': 'day',
                'units': '100'} 

endpoint = 'https://api-ssl.bitly.com/v3/link/clicks'
response = requests.get(endpoint, params=query_params, verify=False)

data = json.loads(response.content)
print data['data']['link_clicks']