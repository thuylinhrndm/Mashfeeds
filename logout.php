<?php
unset($_COOKIE['session']);
setcookie('session', '', time() - 3600);
header("Location: login.php");
?>