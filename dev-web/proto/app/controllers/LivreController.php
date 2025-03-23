<?php

class LivreController extends BaseController
{
    private $table = 'livres';
    private $primaryKey = 'num_etd';
    private $create_form_name = 'create-form';
    private $create_form_value = 'Enregistrer';
    private $edit_form_name = 'edit-form';
    private $edit_form_value = 'Modifier';
    private $delete_form_name = 'delete-form';
    private $delete_form_value = 'Supprimer';

    public function index()
    {
        $livres = Database::table($this->table)->findAll();
        $search_form_name = 'search-form';
        $search_form_value = 'Rechercher';
        $clear_search_name = 'search-form-clear';
        $clear_search_value = 'Vider';
        $pageTitle = 'Livres';

        $this->render('livres/index.page.php', [
            'livres' => $livres,
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
        $pageTitle = 'Ajout etudiant';
        $this->render('livres/create.page.php', [
            'form_name' => $this->create_form_name,
            'form_value' => $this->create_form_value,
            'pageTitle' => $pageTitle,
        ]);
    }

    public function store()
    {
        $rules = [
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
        ];
        $validatedData = $this->validate($_POST, $rules);

        if (!$validatedData) {
            redirect('/livres/create', [
                'errors' => $this->validator->getErrors(),
                'old' => $_POST
            ]);
        }
        Database::table($this->table)->insert($validatedData);
        redirect('/livres', [
            'errors' => $this->validator->getErrors(),
            'old' => []
        ]);
    }

    public function edit()
    {
        $numetudiant = $_GET[$this->primaryKey];
        $etudiant =  Database::table($this->table)::primaryKey($this->primaryKey)->findById($numetudiant);
        $pageTitle = 'Modifier etudiant';

        $this->render('livres/edit.page.php', [
            'primaryKey' => $this->primaryKey,
            'form_name' => $this->edit_form_name,
            'form_value' => $this->edit_form_value,
            'pageTitle' => $pageTitle,
            'etudiant' => $etudiant,
        ]);
    }

    public function update()
    {
        $numetudiant = $_POST[$this->primaryKey];
        $rules = [
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
        ];
        $validatedData = $this->validate($_POST, $rules);

        if (!$validatedData) {
            redirect('/livres/edit', [
                'errors' => $this->validator->getErrors(),
                'old' => $_POST
            ]);
        }
        Database::table($this->table)
            ::primaryKey($this->primaryKey)
            ->update($numetudiant, $validatedData);

        redirect('/livres', [
            'errors' => $this->validator->getErrors(),
            'old' => []
        ]);
    }

    public function delete()
    {
        $numetudiant = $_POST[$this->primaryKey];
        Database::table($this->table)::primaryKey($this->primaryKey)->delete($numetudiant);
        $pageTitle = 'Modifier etudiant';

        redirect('/livres', [
            'errors' => $this->validator->getErrors(),
            'old' => []
        ]);
    }
}
