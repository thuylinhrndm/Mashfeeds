#!/usr/bin/ruby
puts "Content-type: text/html"
puts ""
require 'rubygems'
require 'oauth'
require 'json'
require 'cgi'
cgi=CGI.new

message = cgi['twitter']

# You will need to set your application type to
# read/write on dev.twitter.com and regenerate your access
# token.  Enter the new values here:
consumer_key = OAuth::Consumer.new(
  "cLSXLYu3ze7nGCMoIlOWA",
  "XFJG8ifjHqs8GfM5z7ktHNBRNtmM03wQl8zuP7So0")
access_token = OAuth::Token.new(
  "2265678453-b1hyjrgOaTtHW9QorTDf4hFNXb5SlX6rtD8gZm0",
  "HNWLhVqsm2e2OUcMhNMMkKWxMBNEHZnYt8yBRRNzJUlkv")

# Note that the type of request has changed to POST.
# The request parameters have also moved to the body
# of the request instead of being put in the URL.
baseurl = "https://api.twitter.com"
path    = "/1.1/statuses/update.json"
address = URI("#{baseurl}#{path}")
request = Net::HTTP::Post.new address.request_uri
request.set_form_data(
  "status" => message,
)

# Set up HTTP.
http             = Net::HTTP.new address.host, address.port
http.use_ssl     = true
http.verify_mode = OpenSSL::SSL::VERIFY_PEER

# Issue the request.
request.oauth! http, consumer_key, access_token
http.start
response = http.request request

# Parse and print the Tweet if the response code was 200
tweet = nil
if response.code == '200' then
  tweet = JSON.parse(response.body)
  puts "#{tweet["text"]}"
else
  puts "Could not send the Tweet! " +
  "Code:#{response.code} Body:#{response.body}"
end
