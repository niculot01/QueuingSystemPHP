CREATE DATABASE queuing;
USE queuing;

CREATE TABLE queue (
  id INT(11) NOT NULL AUTO_INCREMENT,
  queue_number VARCHAR(255) NOT NULL,
  party_size INT(11) NOT NULL,
  queue_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE priority_queue (
  id INT(11) NOT NULL AUTO_INCREMENT,
  queue_number VARCHAR(255) NOT NULL,
  party_size INT(11) NOT NULL,
  queue_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);


CREATE TABLE seated_customers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  queue_number VARCHAR(255) NOT NULL,
  party_size INT(11) NOT NULL,
  queue_time DATETIME NOT NULL,
  seated_time DATETIME NOT NULL,
  PRIMARY KEY (id)
);



CREATE TABLE served_customers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  queue_number VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  phone VARCHAR(255) NOT NULL,
  party_size INT(11) NOT NULL,
  queue_time DATETIME NOT NULL,
  seated_time DATETIME NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE canceled_customers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  queue_number VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  phone VARCHAR(255) NOT NULL,
  party_size INT(11) NOT NULL,
  queue_time DATETIME NOT NULL,
  canceled_time DATETIME NOT NULL,
  PRIMARY KEY (id)
);


SELECT MAX(primary_key_column) FROM table_name;

ALTER TABLE table_name AUTO_INCREMENT = highest_value + 1;
