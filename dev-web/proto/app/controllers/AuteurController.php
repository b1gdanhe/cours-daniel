<?php

class AuteurController extends BaseController
{
    private $table = 'auteurs';
    private $primaryKey = 'num_auteur';
    private $create_form_name = 'create-form';
    private $create_form_value = 'Enregistrer';
    private $edit_form_name = 'edit-form';
    private $edit_form_value = 'Modifier';
    private $delete_form_name = 'delete-form';
    private $delete_form_value = 'Supprimer';

    public function index()
    {
        $auteurs = Database::table($this->table)->findAll();
        $search_form_name = 'search-form';
        $search_form_value = 'Rechercher';
        $clear_search_name = 'search-form-clear';
        $clear_search_value = 'Vider';
        $pageTitle = 'Auteurs';

        $this->render('auteurs/index.page.php', [
            'auteurs' => $auteurs,
            'primaryKey' => $this->primaryKey,
            'search_form_name' => $search_form_name,
            'search_form_value' => $search_form_value,
            'clear_search_name' => $clear_search_name,
            'clear_search_value' => $clear_search_value,
            'delete_form_name' => $this->delete_form_name,
            'delete_form_value' => $this->delete_form_value,
            'pageTitle' => $pageTitle,
        ]);
    }

    public function create()
    {
        $pageTitle = 'Ajout auteur';
        $this->render('auteurs/create.page.php', [
            'form_name' => $this->create_form_name,
            'form_value' => $this->create_form_value,
            'pageTitle' => $pageTitle,
        ]);
    }

    public function store()
    {
        $rules = [
            'nom' => 'required',
            'adresse' => 'required',
        ];
        $validatedData = $this->validate($_POST, $rules);

        if (!$validatedData) {
            redirect('/auteurs/create', [
                'errors' => $this->validator->getErrors(),
                'old' => $_POST
            ]);
        }
        Database::table($this->table)->insert($validatedData);
        redirect('/', [
            'errors' => $this->validator->getErrors(),
            'old' => []
        ]);
    }

    public function edit()
    {
        $numAuteur = $_GET[$this->primaryKey];
        $auteur =  Database::table($this->table)::primaryKey($this->primaryKey)->findById($numAuteur);
        $pageTitle = 'Modifier auteur';

        $this->render('auteurs/edit.page.php', [
            'primaryKey' => $this->primaryKey,
            'form_name' => $this->edit_form_name,
            'form_value' => $this->edit_form_value,
            'pageTitle' => $pageTitle,
            'auteur' => $auteur,
        ]);
    }

    public function update()
    {
        $numAuteur = $_POST[$this->primaryKey];
        $rules = [
            'nom' => 'required',
            'adresse' => 'required',
        ];
        $validatedData = $this->validate($_POST, $rules);

        if (!$validatedData) {
            redirect('/auteurs/edit', [
                'errors' => $this->validator->getErrors(),
                'old' => $_POST
            ]);
        }
        Database::table($this->table)
            ::primaryKey($this->primaryKey)
            ->update($numAuteur, $validatedData);

        redirect('/', [
            'errors' => $this->validator->getErrors(),
            'old' => []
        ]);
    }

    public function delete()
    {
        $numAuteur = $_POST[$this->primaryKey];
        Database::table($this->table)::primaryKey($this->primaryKey)->delete($numAuteur);
        $pageTitle = 'Modifier auteur';

        redirect('/', [
            'errors' => $this->validator->getErrors(),
            'old' => []
        ]);
    }
}
