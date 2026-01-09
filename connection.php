<?php
    $servername="localhost";
    $username="root";
    $password="password";
    $dbname="invoiceapp";
    try{
        $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //echo("connected ok");
    }
    catch (PDOException $e)
    {
        echo("connection failed " .$e->getMessage()."<br>");
    }
?>