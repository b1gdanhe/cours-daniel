<?php

class Autoloader
{
    public function register()
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    public function loadClass($className)
    {
        // Retirer l'éventuel namespace
        $parts = explode('\\', $className);
        $className = end($parts);

        // Liste des répertoires à vérifier
        $directories = [
            __DIR__ . '/../controllers/',
            __DIR__ . '/../core/',
        ];

        // Chercher la classe dans chaque répertoire
        foreach ($directories as $directory) {
            if (file_exists($directory . $className . '.php')) {
                require_once $directory . $className . '.php';
                return;
            }
        }
    }
}
