<?php

$db = connectToDb();
$post_data = $_POST;
$server = $_SERVER;

$students = [];
$getUserquery = "SELECT * FROM students,filiers WHERE students.filier_id = filiers.id ";
$params = [];

if ($server['REQUEST_METHOD'] === 'POST') {

    if (isset($post_data['my-delete-student-form']) && $post_data['my-delete-student-form'] === 'Delete Student') {
        
        try {
            $deleteStudentQuery = "DELETE FROM students WHERE matricule = :matricule";
            storeNew($db, $deleteStudentQuery, ['matricule' => $post_data['matricule']]);
            header("Location: /");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    if (isset($post_data['my-search-button']) && $post_data['my-search-button'] === 'Filter') {

        if ($search_key = validate($post_data['search_key'])) {
            $getUserquery .=  (str_contains($getUserquery, 'WHERE') ? "AND" : "WHERE") . "(first_name LIKE :search_key OR last_name LIKE :search_key OR email LIKE :search_key OR filier_id LIKE :search_key)";
            $params['search_key'] = '%' . $search_key . '%';
        }
        //dd($getUserquery);
    }
}



$students = getList($db, $getUserquery, $params);



//dd($students);

require 'pages/students/index.page.php';
