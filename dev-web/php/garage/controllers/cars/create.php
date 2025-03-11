<?php

const SUBMIT_VALUE = 'Enregistrer';
$garages = [];
$clients = [];
$errors = [];

$post_data = $_POST;
$server = $_SERVER;
$file_data = $_FILES;

if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data['my-create-car-form']) || $post_data['my-create-car-form'] !== SUBMIT_VALUE) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        if (($garage_id = validate($post_data['garage_id'])) && existInTable('garages', 'id', $post_data['garage_id'])) {
            if (($client_id = validate($post_data['client_id'])) && existInTable('clients', 'id', $post_data['client_id'])) {
                if ($mark = validate($post_data['mark'])) {
                    if ($model = validate($post_data['model'])) {
                        if ($enter_date = validate($post_data['enter_date'])) {
                            if ($out_date = validate($post_data['out_date'])) {
                                if ($year = validate($post_data['year'])) {
                                    $user_data = [
                                        'garage_id' => $garage_id,
                                        'client_id' => $client_id,
                                        'mark' => $mark,
                                        'model' => $model,
                                        'matricule' => random_int(10000, 1000010),
                                        'enter_date' => $enter_date,
                                        'out_date' => $out_date,
                                        'year' => $year,
                                    ];
                                    //dd($user_data);
                                    try {
                                        $query = "INSERT INTO cars (garage_id, client_id, mark, model, enter_date, out_date, year, matricule) VALUES (:garage_id, :client_id, :mark, :model, :enter_date, :out_date, :year, :matricule)";
                                        $new_city = storeNew($db, $query, $user_data);
                                        header("Location: /cars");
                                    } catch (\Throwable $th) {
                                        dd($th->getMessage());
                                    }
                                } else {
                                    $errors['year'] = "Le téléphone est obligatoire";
                                }
                            } else {
                                $errors['out_date'] = "L'address est obligatoire";
                            }
                        } else {
                            $errors['enter_date'] = "L'address est obligatoire";
                        }
                    } else {
                        $errors['model'] = "L'address est obligatoire";
                    }
                } else {
                    $errors['mark'] = "L'address est obligatoire";
                }
            } else {
                $errors['client_id'] = "L'address est obligatoire";
            }
        } else {
            $errors['garage_id'] = "Le nom est obligatoire";
        }
    }
};

$garageQuery = "SELECT * FROM garages";
$garages  = all( $garageQuery);

$clientQuery = "SELECT * FROM clients";
$clients  = all( $clientQuery);
//dd($clients);

require 'pages/cars/create.page.php';
