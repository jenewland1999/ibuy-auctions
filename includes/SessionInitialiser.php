<?php

// Session Initialiser simply checks to see if the session 
// is not running and if so start the session.
if (session_status() == PHP_SESSION_NONE)
  session_start();
