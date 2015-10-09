<!--
/*
 *
 * Copyright 2013 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

-->
<html>
<head>
  <title>Mashfeeds!</title>
  <link href="mash.css" rel="stylesheet" type="text/css">
<!--  <link rel="canonical" href="http://www.example.com" /> -->
<script src='https://cdn.firebase.com/v0/firebase.js'></script>
  
  <!-- JavaScript specific to this application that is not related to API
     calls -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" ></script>
  <!-- Custom scripts -->
  <script type="text/javascript" src="bitLy.js"></script>
  <script type="text/javascript" src="evernoteJS.js"></script>
  <script type="text/javascript" src="twitter.js"></script>
  <script type="text/javascript" src="twitterSearch.js"></script>
  <script src="http://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
  <script type="text/javascript" src="http://cdn-files.deezer.com/js/min/dz.js"></script>
  <div id="dz-root"></div>
  
  	<script type="text/javascript">
		function checkRadio(){
			var bitly = document.getElementById('bitlyCheck');
			var twitter = document.getElementById('twitterCheck');
			var yt = document.getElementById('ytCheck');
			var deezer = document.getElementById('deezerCheck');
			
			if (bitly.checked) {
				getdata('shortUrl');
			} else if (twitter.checked) {
				getTweets('tweetsHashtags');
			} else if (yt.checked) {
				SearchYouTube(document.getElementById('shortUrl').value);
			} else if (deezer.checked) {
				search();
			} else {
				getTweets('tweetsHashtags');
				SearchYouTube(document.getElementById('shortUrl').value);
				search();
			}
		}
	</script>
  
      <script>
                DZ.init({
            appId: '133121',
            channelUrl: 'http://nci-project.mooo.com/channel.html',
            player: {
                onload: function () { 
                    //other player functions
                    //autoplay set to false
                    //DZ.player.playAlbum(2962681, false)
                    //DZ.player.playPlaylist(484767873);
                    //DZ.player.playTracks(['68973465']);
                }
            }
        });

    </script>

	<script type="text/javascript" src="jquery-2.1.0.min.js"></script>
<script type="text/javascript">
function openVideo(vidSource){
	document.getElementById('videoWind').innerHTML = '<br/><iframe width="560" height="315" src="//www.youtube.com/embed/' + vidSource + '" frameborder="0" allowfullscreen></iframe>';
}

function separateId(str) {
	var temp = str.split("&");
	return temp[0];
}

function cutLink(longLink){
	var temp = longLink.split("=");
	return separateId(temp[1]);
}

function SearchYouTube(query) {
    $.ajax({
        url: 'http://gdata.youtube.com/feeds/mobile/videos?alt=json-in-script&q=' + query,
        dataType: 'jsonp',
        success: function (data) {
            var row = "";
            for (i = 0; i < data.feed.entry.length; i++) {
                row += "<div class='search_item'>";
                row += "<table width='100%'>";
                row += "<tr>";
                row += "<td vAlign='top' align='left'>";
                row += '<a href="' + data.feed.entry[i].link[0].href + '"><img width="120px" height="80px" src="' + data.feed.entry[i].media$group.media$thumbnail[0].url + '" /></a>';
                row += "</td>";
                row += "<td vAlign='top' width='100%' align='left'>";
                row += '<a href="#search-results-block" class="links" onclick="openVideo(\'' + cutLink(data.feed.entry[i].link[0].href) + '\')"><b>' + data.feed.entry[i].media$group.media$title.$t + '</b></a><br/>';
                row += "<span style='font-size:12px; color:#555555'>by " + data.feed.entry[i].author[0].name.$t + "</span><br/>";
                row += "<span style='font-size:12px' color:#666666>" + data.feed.entry[i].yt$statistics.viewCount + " views" + "<span><br/>";
                row += "</td>";
                row += "</tr>";
                row += "</table>";
                row += "</div>";
            }
            document.getElementById("search-results-block").innerHTML = row;
        },
        error: function () {
            alert("Error loading youtube video results");
        }
    });
    return false;
}

</script>
<script>
var userToken;

function login(){
    DZ.login(function(response) {
    if (response.authResponse) {
    DZ.api('/user/me', function(user) {
    console.log('Successful Login!');   
                       $('#name').html(user.name);
    });
}
             }, {perms: 'email'});
        }

function play_track(track_id){
DZ.player.playTracks([track_id]);
}		

function search(){
	$('#results').empty();
	//var songName = document.getElementById('search_input').value
	var songName = document.getElementById('shortUrl').value
    DZ.api('/search?q=' + songName, function(json){
		for (var i=0, len = 10; i<len ; i++)
		{
			$('#results').append('<li>' + json.data[i].title + ': <input type="button" value="Play" onclick="play_track('+ json.data[i].id +')"></li>');
		}
	});
	
}
</script>
  
  <script type="text/javascript">
   function searchClicked()
        {
            document.getElementById("videoResultsDiv").innerHTML = 
                                    'Loading YouTube videos ...';
			var tags = document.getElementById('searchTags').value;
			

            //create a JavaScript element that returns our JSON data.
            var script = document.createElement('script');
            script.setAttribute('id', 'jsonScript');
            script.setAttribute('type', 'text/javascript');
            script.setAttribute('src', 'http://gdata.youtube.com/feeds/' + 
                   'videos?vq=' + tags + '&max-results=8&' + 
                   'alt=json-in-script&callback=showMyVideos&' + 
                   'orderby=relevance&sortorder=descending&format=5&fmt=18');

            //attach script to current page -  this will submit asynchronous
            //search request, and when the results come back callback 
            //function showMyVideos(data) is called and the results passed to it
            document.documentElement.firstChild.appendChild(script);
        }

        function showMyVideos(data)
        {
            var feed = data.feed;
            var entries = feed.entry || [];
            var html = ['<ul>'];
            for (var i = 0; i < entries.length; i++)
            {
                var entry = entries[i];
                var playCount = entry.yt$statistics.viewCount.valueOf() + ' views';
                var title = entry.title.$t;
                var lnk = '<a href = \"' + entry.link[0].href + '\">link</a>';
                html.push('<li>', title, ', ', playCount, ', ', lnk, '</li>');
				
            }
            html.push('</ul>');
            document.getElementById('videoResultsDiv').innerHTML = html.join('');
        }
			
		function openWindow()
		{
			window.open("https://sandbox.evernote.com/Login.action?targetUrl=%2FHome.action","mywindow","menubar=1,resizable=1,width=400,height=500");
		}
			

    </script>
</head>
<body>
<?php
if (isset($_COOKIE['session'])){
	$username = $_COOKIE['session'];
	echo '<b style = "color:white;">Welcome, '.$username.' | <a href="logout.php" id="logout">Logout</a></b>';
} else {
	echo '<b style = "color:white;">You are not logged in!</b>';
	echo '<script type="text/javascript">
					window.location = "login.php";
				  </script>';
}
?>
<script>
	var myDataRef = new Firebase('https://nv5afc69hal.firebaseio-demo.com/');
</script>
<div class="container" >
      <div class="logo"><img src="images/coollogo_mashfeeds.png" alt="logo" width="210" height="82"></div>
     <div class="bitly"><br />
		<form action="javascript:checkRadio()" >
			&nbsp;&nbsp;<input type="text" id="shortUrl"/>
			<input type="submit" value="Submit" class="myButton" />
			<!--search selection-->
			<input type="radio" name="toggleGrp" value="bitlyCheckValue" id="bitlyCheck">Bitly&nbsp;
			<input type="radio" name="toggleGrp" value="twitterCheckValue" id="twitterCheck">Twitter&nbsp;
			<input type="radio" name="toggleGrp" value="deezerCheckValue" id="deezerCheck">Deezer&nbsp;
			<input type="radio" name="toggleGrp" value="youtubeCheckValue" id="ytCheck">Youtube&nbsp;
			<input type="radio" name="toggleGrp" value="youtubeCheckValue" id="allCheck" checked>Multi&nbsp;
		</form>
	</div>

      <br>
    <div class="twitter">
		<div id="tweetsHashtags">
			Twitter Content
		</div>
    </div>
      
	 <div class="deezer">
        <div id="deezerContainer">
		<form action = "javascript:search()">

		<!-- Previous track -->
        <input class="player-button" type="button" onclick="DZ.player.prev();" value="9"/> 
        <!-- Play button -->
        <input class="player-button" type="button" onclick="DZ.player.play();" value="4"/>
        <!-- Pause button -->
        <input class="player-button" type="button" onclick="DZ.player.pause();" value=";"/> 
        <!-- Next track -->
        <input class="player-button" type="button" onclick="DZ.player.next();" value=":"/>
		<!-- Login button -->
		&nbsp;<input type="button" onclick="login();" value="Login" class="myButton" /><br/><br/>
		</form>
		<!-- Results -->
		<ul id="results"></ul>
		</div>
     </div>
      
	 <div class="evernote">
        <form action="javascript:getData('viewNote')">
			<!-- TextArea-->
			<textarea id="everTa" cols="40" rows="12"></textarea><br/>
			&nbsp;&nbsp;<input type="submit" value="Submit" class="myButton"/>
			<!-- Login button -->
			<button onclick="openWindow()" class="myButton">Login</button>
		   </form>
			<div id="viewNote"> </div>
    </div>
	
    <div class="youtube">
	<div id="search-results-block"></div>
    </div>
	<div id="videoWind">
	
	</div>
	
	
</div>


</body>
<script type="text/javascript">
var helper = (function() {
  var BASE_API_PATH = 'plus/v1/';

  return {
    /**
     * Hides the sign in button and starts the post-authorization operations.
     *
     * @param {Object} authResult An Object which contains the access token and
     *   other authentication information.
     */
    onSignInCallback: function(authResult) {
      gapi.client.load('plus','v1', function(){
        $('#authResult').html('Auth Result:<br/>');
        for (var field in authResult) {
          $('#authResult').append(' ' + field + ': ' +
              authResult[field] + '<br/>');
        }
        if (authResult['access_token']) {
          $('#authOps').show('slow');
          $('#gConnect').hide();
          helper.profile();
          helper.people();
        } else if (authResult['error']) {
          // There was an error, which means the user is not signed in.
          // As an example, you can handle by writing to the console:
          console.log('There was an error: ' + authResult['error']);
          $('#authResult').append('Logged out');
          $('#authOps').hide('slow');
          $('#gConnect').show();
        }
        console.log('authResult', authResult);
      });
    },

    /**
     * Calls the OAuth2 endpoint to disconnect the app for the user.
     */
    disconnect: function() {
      // Revoke the access token.
      $.ajax({
        type: 'GET',
        url: 'https://accounts.google.com/o/oauth2/revoke?token=' +
            gapi.auth.getToken().access_token,
        async: false,
        contentType: 'application/json',
        dataType: 'jsonp',
        success: function(result) {
          console.log('revoke response: ' + result);
          $('#authOps').hide();
          $('#profile').empty();
          $('#visiblePeople').empty();
          $('#authResult').empty();
          $('#gConnect').show();
        },
        error: function(e) {
          console.log(e);
        }
      });
    },

    /**
     * Gets and renders the list of people visible to this app.
     */
    people: function() {
      var request = gapi.client.plus.people.list({
        'userId': 'me',
        'collection': 'visible'
      });
      request.execute(function(people) {
        $('#visiblePeople').empty();
        $('#visiblePeople').append('Number of people visible to this app: ' +
            people.totalItems + '<br/>');
        for (var personIndex in people.items) {
          person = people.items[personIndex];
          $('#visiblePeople').append('<img src="' + person.image.url + '">');
        }
      });
    },

    /**
     * Gets and renders the currently signed in user's profile data.
     */
    profile: function(){
      var request = gapi.client.plus.people.get( {'userId' : 'me'} );
      request.execute( function(profile) {
        $('#profile').empty();
        if (profile.error) {
          $('#profile').append(profile.error);
          return;
        }
        $('#profile').append(
            $('<p><img src=\"' + profile.image.url + '\"></p>'));
        $('#profile').append(
            $('<p>Hello ' + profile.displayName + '!<br />Tagline: ' +
            profile.tagline + '<br />About: ' + profile.aboutMe + '</p>'));
        if (profile.cover && profile.coverPhoto) {
          $('#profile').append(
              $('<p><img src=\"' + profile.cover.coverPhoto.url + '\"></p>'));
        }
      });
    }
  };
})();

/**
 * jQuery initialization
 */
$(document).ready(function() {
  $('#disconnect').click(helper.disconnect);
  $('#loaderror').hide();
  if ($('[data-clientid="YOUR_CLIENT_ID"]').length > 0) {
    alert('This sample requires your OAuth credentials (client ID) ' +
        'from the Google APIs console:\n' +
        '    https://code.google.com/apis/console/#:access\n\n' +
        'Find and replace YOUR_CLIENT_ID with your client ID.'
    );
  }
});

/**
 * Calls the helper method that handles the authentication flow.
 *
 * @param {Object} authResult An Object which contains the access token and
 *   other authentication information.
 */
function onSignInCallback(authResult) {
  helper.onSignInCallback(authResult);
}
</script>
</html>
