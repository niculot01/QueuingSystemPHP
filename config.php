<?php
ini_set('memory_limit', '256M');
gc_enable();

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'queuing';

// Create a PDO object to connect to the database
try {
  $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
  // Set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die('Failed to connect to MySQL: ' . $e->getMessage());
}