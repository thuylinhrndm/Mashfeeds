#!/usr/bin/ruby

puts "Content-type: text/html"
puts ""

require 'evernote_oauth'
require 'cgi'
cgi = CGI.new

everTa = cgi['everTa']

auth_token = "S=s1:U=8de44:E=14b63a07aa8:C=1440bef4eab:P=1cd:A=en-devtoken:V=2:H=17aa6f70b244616c9f30be05c9f4458f"
client = EvernoteOAuth::Client.new(token: auth_token)
note_store =  client.note_store
notebooks = note_store.listNotebooks
note = Evernote::EDAM::Type::Note.new
note.title = "My first test"

puts "The name goes here:"
note.content = 'everTa'
note_store.createNote(note)




