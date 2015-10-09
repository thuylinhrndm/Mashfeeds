<!doctype html>

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
  <title>Login</title>
  <link href="log.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
<!--
/*
 *
    function visible_div(id) {
       var e = document.getElementById(id);
	   if (id = 'register') {
				document.getElementById('regOne').style.visibility = 'hidden';
				document.getElementById('register').style.visibility = 'visible';
	   }
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
	
	function invisibleDiv(id) {
		var d = document.getElementById(id);
		if (id = 'register') {
			document.getElementById('regOne').style.visibility = 'visible';
			document.getElementById('register').style.visibility = 'hidden';
		}
	}
	
	function hideReg() {
		document.getElementById('register').style.visibility = 'hidden';
	}
 */
	
//-->
</script>
</head>
<body>
  <div class="container">
      <div class="website"><img src="images/screen_s.png" alt="website" align="middle"/></div>
    	<div class="login"><img src="images/coollogo_mashfeeds.png" alt="logo" width="210" height="82" align="middle">
		<?php
		if (isset($_COOKIE['session'])){
			header("Location: index.php");
		}
		?>
		<?php
		if (!isset($_POST['submit'])){
		?>
		<!-- The HTML login form -->
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post"><br/>
				Username: <input type="text" name="username" size="30"/><br/><br/>
				Password: <input type="password" name="password" size="30" /><br/><br/>
				<input type="submit" name="submit" value="Login" class="myButton"/>	<br/><br/>
				<input type="button" name="register" class="myButton" value="Create New Account" onclick="window.open('register.php');"/>
			</form>
		<?php
		} else {
			require_once("db_const.php");
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			# check connection
			if ($mysqli->connect_errno) {
				echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
				exit();
			}
		 
			$username = $_POST['username'];
			$password = $_POST['password'];
		 
			$sql = "SELECT * from users WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1";
			$result = $mysqli->query($sql);
			if (!$result->num_rows == 1) {
				echo "<p>Invalid username/password combination</p>";
			} else {
				echo "<p>Logged in successfully</p>";
				session_start();
				$sid = session_id();
				setcookie("session", $username, time()+3600);
				echo ('<script type="text/javascript">alert("'.$username.'");</script>');
				header("Location: index.php");
			}
		}
		?> 
			
		</div>
		<div class="intro1"><br/>
			<p>MashFeeds is designed for listening to musics and watching videos in one place</p>
		</div>
		
		<div class="intro2"><br/>
			<p>Search twitter relates to the music and video</p>
		</div>
		
		<div class="intro3"><br/>
			<p>Save everything cool and exciting you see online and in the real world.</p>
		</div>
		<div id="bottom">
		<h5>@2014 MashFeeds</h5>
		</div>
	
		
   </div>
</body>

</html>
