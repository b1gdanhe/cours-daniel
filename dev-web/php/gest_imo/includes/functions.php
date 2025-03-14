<?php

const FILE_CONFIG = [
    'pdf' => [
        'mime' => ['application/pdf'],
        'max_size' => 5242880, // 5 MB
    ],
    'image' => [
        'mime' => ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'],
        'max_size' => 2097152, // 2 MB
    ],
];

function dd( $value, bool $die = true, string $color = 'lightgreen'): void
{
    ob_start(); // Démarre la mise en mémoire tampon de sortie
    var_export($value); // Génère une représentation de code PHP
    $output = ob_get_clean(); // Récupère et nettoie la sortie mise en mémoire tampon

    $highlighted = highlight_string("<?php " . $output . ";", true); // Colore la sortie

    // Supprime les balises <?php et ; ajoutées par highlight_string
    
    $highlighted = str_replace('&lt;?php&nbsp;', '', $highlighted);
    $highlighted = str_replace(';</code></pre>', '</code></pre>', $highlighted);
    $highlighted = str_replace('#007700', htmlspecialchars($color), $highlighted);
    $highlighted = str_replace('#DD0000', "#db4747", $highlighted);
    $highlighted = str_replace('#0000BB', "#8c8cf8", $highlighted);
    echo sprintf(
        '<pre style="background-color:rgb(0, 0, 0); color: %s; padding: 7px; border-radius: 5px; overflow: auto; max-height: 80vh; box-shadow: 1px 1px 5px  grey ">%s</pre>',
        htmlspecialchars($color),
        $highlighted
    );

    if ($die) {
        die();
    }
}

function formatBytes(int $bytes, int $precision = 2): string
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . ' ' . $units[$pow];
}

function storeFile(array $file, string $destination, bool $createDirs = true, $allowedTypes = ['pdf', 'image']): array
{
    $directory = dirname($destination);

    if ($createDirs && !is_dir($directory)) {
        if (!mkdir($directory, 0755, true)) {
            return [
                'success' => false,
                'message' => "Impossible de créer le répertoire: $directory",
                'file_path' => null
            ];
        }
    }

    if (!is_writable($directory)) {
        return [
            'success' => false,
            'message' => "Le répertoire n'est pas accessible en écriture: $directory",
            'file_path' => null
        ];
    }

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return [
            'success' => false,
            'message' => "Échec lors du déplacement du fichier vers: $destination",
            'file_path' => null
        ];
    }

    return [
        'success' => true,
        'message' => 'Fichier enregistré avec succès',
        'file_path' => $destination
    ];
}

function generateSecureFileName(string $originalName, string $prefix = ''): string
{
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $uniqueId = time() . '_' . bin2hex(random_bytes(8));
    $fileName = $prefix ? "{$prefix}_{$uniqueId}.{$extension}" : "{$uniqueId}.{$extension}";

    return $fileName;
}

function controller(string $path)
{
    return base_path("controllers/{$path}");
}

function page(string $path, array $datas = [])
{
    extract($datas);
    require base_path("pages/{$path}");
}

function partial(string $path, array $datas = [])
{
    extract($datas);
    require base_path("partials/{$path}");
}


function asset(string $path)
{
    return public_path("{$path}");
}
