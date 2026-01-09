<?php
    #create varialbes with server details on
    $servername="localhost";
    $username="root";
    $password="password";

    $conn=new PDO("mysql:host=$servername",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="CREATE DATABASE IF NOT EXISTS InvoiceApp";
    $conn->exec($sql);
    $sql="USE InvoiceApp";
    $conn->exec($sql);
    echo("DB made");
    $stmt1= $conn->prepare("DROP TABLE IF EXISTS tblclient;
    CREATE TABLE tblclient
    (ClientID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(20) NOT NULL,
    Phonenumber VARCHAR(20) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Address1 VARCHAR(100) NOT NULL,
    Address2 VARCHAR(100),
    Town VARCHAR(50) NOT NULL,
    Postcode VARCHAR(10) NOT NULL);
    ");
    $stmt1->execute();
    echo("client table made");
    
  

    $stmt1= $conn->prepare("DROP TABLE IF EXISTS tblSession;
    CREATE TABLE tblsession
    (SessionID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Treatment VARCHAR(400) NOT NULL,
    Date DATE NOT NULL,
    Time INT(4) NOT NULL,
    ClientID INT(4) NOT NULL,
    Total DECIMAL (15,2) NOT NULL,
    Paid BOOLEAN NOT NULL DEFAULT 0,
    Duedate DATE NOT NULL);
    ");
    $stmt1->execute();
    
    echo("session table made");
?>