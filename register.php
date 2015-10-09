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
  <title>Register</title>
  <link href="log.css" rel="stylesheet" type="text/css">

</head>
<body>
  <div class="container" >
      <div class="website"><img src="images/screen_s.png" alt="website" align="middle"/></div>
	  <div class="register"><a href="login.php"><img src="images/coollogo_mashfeeds.png" alt="logo" width="210" height="82" align="middle"/></a>
			<?php
			require_once("db_const.php");
			if (!isset($_POST['submit'])) {
			?>
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post"><br/>
					Username	: <input type="text" name="username" size="30" /><br/><br/>
					Password	: <input type="password" name="password" size="30" /><br/><br/>
					First name	: <input type="text" name="first_name" size="30" /><br/><br/>
					Last name	: <input type="text" name="last_name"  size="30"/><br/><br/>
					Email		: <input type="type" name="email" size="35"/><br/><br/>
	 
					<input type="submit" class="myButton" name="submit" value="Register"/>
				</form>
			<?php
			} else {
			## connect mysql server
				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				# check connection
				if ($mysqli->connect_errno) {
					echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
					exit();
				}
			## query database
				# prepare data for insertion
				$username    = $_POST['username'];
				$password    = $_POST['password'];
				$first_name    = $_POST['first_name'];
				$last_name    = $_POST['last_name'];
				$email        = $_POST['email'];
			 
				# check if username and email exist else insert
				$exists = 0;
				$result = $mysqli->query("SELECT username from users WHERE username = '{$username}' LIMIT 1");
				if ($result->num_rows == 1) {
					$exists = 1;
					$result = $mysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
					if ($result->num_rows == 1) $exists = 2;    
				} else {
					$result = $mysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
					if ($result->num_rows == 1) $exists = 3;
				}
			 
				if ($exists == 1) echo "<p>Username already exists!</p>";
				else if ($exists == 2) echo "<p>Username and Email already exists!</p>";
				else if ($exists == 3) echo "<p>Email already exists!</p>";
				else {
					# insert data into mysql database
					$sql = "INSERT  INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`) 
							VALUES (NULL, '{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$email}')";
			 
					if ($mysqli->query($sql)) {
						//echo "New Record has id ".$mysqli->insert_id;
						header("Location: login.php");
					} else {
						echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
						exit();
					}
				}
			}
			?>  
			</div>
			<div class="intro1">
			<p>MashFeeds is designed for listening to musics and watching videos in one place</p>
			</div>
			
			<div class="intro2">
				<p>Search twitter relates to the music and video</p>
			</div>
			
			<div class="intro3">
				<p>Save everything cool and exciting you see online and in the real world.</p>
			</div>
			
			<div id="bottom">
			<h5>@2014 MashFeeds</h5>
			</div>
			
		
   </div>
</body>

</html>
