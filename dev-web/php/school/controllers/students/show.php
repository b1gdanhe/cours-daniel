<?php

$db = connectToDb();
$getCurrentStudentQuery = "SELECT * FROM  students, filiers WHERE matricule = :matricule";
$student = getOne($db, $getCurrentStudentQuery, ['matricule' => $_GET['matricule']]);
require 'pages/students/show.page.php';