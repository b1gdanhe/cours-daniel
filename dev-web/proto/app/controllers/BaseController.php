<?php

class BaseController
{

    public function render(string $view, array $data = [])
    {
        page($view, $data);
    }
}
