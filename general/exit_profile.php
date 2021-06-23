<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['user_id']);

header("Location: /index.php");
session_destroy();
?>