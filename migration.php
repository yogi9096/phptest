<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require './connection.php';

$conn = new connection();


if ($conn->createCommand->query(createStudentTable()) === TRUE) {
    echo "Student table created successfully";echo "<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

function createStudentTable() {
    $sql = "CREATE TABLE student (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(30) NOT NULL,
last_name VARCHAR(30) NOT NULL,
email VARCHAR(50),
pocket_money INT(10),
password VARCHAR(50),
is_deleted TINYINT(1) NOT NULL DEFAULT '0'
)";
    return $sql;
}
