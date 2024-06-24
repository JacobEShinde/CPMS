--cpms DATABASE CREATION!

CREATE DATABASE IF NOT EXISTS cpms;
USE cpms;

--PUPIL TABLE CREATION!

CREATE TABLE IF NOT EXISTS pupils(
    id INT AUTO_INCREMENT,
    exam_number INT NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
   last_name VARCHAR(50) NOT NULL,
    gender TEXT(1) NOT NULL,
    grade INT NOT NULL,
    class TEXT(1) NOT NULL,
    address VARCHAR(50) NOT NULL,
    contact INT NOT NULL,
    date_of_birth DATE NOT NULL,
    first_entry YEAR NOT NULL,
    PRIMARY KEY(id)
);



--TEACHER TABLE CREATION

CREATE TABLE IF NOT EXISTS teachers(
    id INT AUTO_INCREMENT,
    tcz_number INT NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50) NOT NULL,
   last_name VARCHAR(50) NOT NULL,
   department VARCHAR(50) NOT NULL,
   roles TEXT NOT NULL,
   email VARCHAR(70) NOT NULL UNIQUE,
   contact INT NOT NULL,
   address VARCHAR(50) NOT NULL,
    gender TEXT(1) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

-- ADMIN TABLE CREATION

CREATE TABLE IF NOT EXISTS admin(
    id INT AUTO_INCREMENT,
    nrc_number VARCHAR(20) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
   last_name VARCHAR(50) NOT NULL,
   email VARCHAR(70) NOT NULL UNIQUE,
   contact INT NOT NULL,
   address VARCHAR(50) NOT NULL,
    gender TEXT(1) NOT NULL,
    role VARCHAR(50),
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

-- LOGS TABLE CREATION ?









 INSERT INTO teachers(tcz_number,
 first_name,
 middle_name,
 last_name,
 department,
 role,
 email,
  contact,
  address,
  gender,
  password)
   VALUES('2018',
   'Brian',
   '-',
   'Lupasa',
   'Mathematics Department',
   'HOD',
   'BrianLupasa19@gmail.com',
   '973214567',
   'kabwata 5/45',
   'M',
   'br4nlups');


 INSERT INTO teachers(tcz_number,
 first_name,
 middle_name,
 last_name,
 department,
 role,
 email, 
 contact,
 address,
 gender,
 password) 
 VALUES('2019',
 'Emmanuel',
 '-',
 'Jacobs',
 'ICT',
 'HOD',
 'Emmanueljacobs41@gmail.com',
 '973821822',
 'Kabs',
 'M',
 'Emm@2');
