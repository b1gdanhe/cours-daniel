<?php

class EditeurController extends BaseController
{
    private $table = 'editeurs';
    private $primaryKey = 'num_editeur';
    private $create_form_name = 'create-form';
    private $create_form_value = 'Enregistrer';
    private $edit_form_name = 'edit-form';
    private $edit_form_value = 'Modifier';
    private $delete_form_name = 'delete-form';
    private $delete_form_value = 'Supprimer';

    public function index()
    {
        $editeurs = Database::table($this->table)->findAll();
        $search_form_name = 'search-form';
        $search_form_value = 'Rechercher';
        $clear_search_name = 'search-form-clear';
        $clear_search_value = 'Vider';
        $pageTitle = 'Editeurs';

        $this->render('editeurs/index.page.php', [
            'editeurs' => $editeurs,
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
        $pageTitle = 'Ajout editeur';
        $this->render('editeurs/create.page.php', [
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
            redirect('/editeurs/create', [
                'errors' => $this->validator->getErrors(),
                'old' => $_POST
            ]);
        }
        Database::table($this->table)->insert($validatedData);
        redirect('/editeurs', [
            'errors' => $this->validator->getErrors(),
            'old' => []
        ]);
    }

    public function edit()
    {
        $numediteur = $_GET[$this->primaryKey];
        $editeur =  Database::table($this->table)::primaryKey($this->primaryKey)->findById($numediteur);
        $pageTitle = 'Modifier editeur';

        $this->render('editeurs/edit.page.php', [
            'primaryKey' => $this->primaryKey,
            'form_name' => $this->edit_form_name,
            'form_value' => $this->edit_form_value,
            'pageTitle' => $pageTitle,
            'editeur' => $editeur,
        ]);
    }

    public function update()
    {
        $numediteur = $_POST[$this->primaryKey];
        $rules = [
            'nom' => 'required',
            'adresse' => 'required',
        ];
        $validatedData = $this->validate($_POST, $rules);

        if (!$validatedData) {
            redirect('/editeurs/edit', [
                'errors' => $this->validator->getErrors(),
                'old' => $_POST
            ]);
        }
        Database::table($this->table)
            ::primaryKey($this->primaryKey)
            ->update($numediteur, $validatedData);

        redirect('/editeurs', [
            'errors' => $this->validator->getErrors(),
            'old' => []
        ]);
    }

    public function delete()
    {
        $numediteur = $_POST[$this->primaryKey];
        Database::table($this->table)::primaryKey($this->primaryKey)->delete($numediteur);
        $pageTitle = 'Modifier editeur';

        redirect('/editeurs', [
            'errors' => $this->validator->getErrors(),
            'old' => []
        ]);
    }
}
