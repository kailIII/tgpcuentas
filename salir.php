<?php
  session_start();
  session_unset("session_user");
  session_destroy();
  header("Location: index.php");
?>