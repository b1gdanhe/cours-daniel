<?php

class LivreController extends BaseController
{
    public $table = 'livres';

    public function index()
    {
        $this->render('livres/index.page.php');
    }
}
