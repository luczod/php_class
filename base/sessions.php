<?php
  session_start();
  $_SESSION['name'] = "Bruce";
  print_r($_SESSION);

  // remove all session variables
  session_unset();
  // destroy the session
  session_destroy();

  /* 
  The session uses cookie resources for its operation and 
  if the resource is disabled it propagates the session via URL.
  The session saves only an id, the user data is saved in a temporary file directly on the server.
  The path to this temporary file is in php.ini : "session.save_path"
  Format: php or Web Distributed Data Exchange(WDDX)
   
  */

?>