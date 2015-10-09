#!/usr/bin/ruby
 
puts "Content-type: text/html"
puts ""


require 'evernote_oauth'

require 'cgi'
cgi = CGI.new

everTa = cgi['everTa']
 
#Real applications authenticate with Evernote using OAuth, but for the
# purpose of exploring the API, you can get a developer token that allows
# you to access your own Evernote account. To get a developer token, visit
# https://sandbox.evernote.com/api/DeveloperToken.action
 
 
auth_token = "S=s1:U=8de44:E=14b63a07aa8:C=1440bef4eab:P=1cd:A=en-devtoken:V=2:H=17aa6f70b244616c9f30be05c9f4458f"
 
 
# Initial development is performed on our sandbox server. To use the production
# service, add "sandbox: false" option and replace your
# developer token above with a token from
# https://www.evernote.com/api/DeveloperToken.action
 
client = EvernoteOAuth::Client.new(token: auth_token)
 
# List all of the notebooks in the user's account
note_store =  client.note_store
notebooks = note_store.listNotebooks
 
# To create a new note, simply create a new Note object and fill in
# attributes such as the note's title.
note = Evernote::EDAM::Type::Note.new
note.title = "My Evernote API"


# The content of an Evernote note is represented using Evernote Markup Language
# (ENML). The full ENML specification can be found in the Evernote API Overview
# at http://dev.evernote.com/documentation/cloud/chapters/ENML.php
 


note.content ='<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE en-note SYSTEM "http://xml.evernote.com/pub/enml2.dtd">
<en-note>' + everTa + '</en-note>'

note_store.createNote(note)