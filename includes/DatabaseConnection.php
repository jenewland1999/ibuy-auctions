<?php

// Establish a Database connection using PHP's PDO library.
// Error mode has been set to exception for debugging purposes.
// ! Remove the setAttribute line when moving to production!
$pdo = new PDO('mysql:host=v.je;dbname=ibuy;charset=utf8', 'student', 'student');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
