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


function dd($value, bool $die = true, string $color = 'lightgreen'): void
{
    echo sprintf(
        '<pre style="background-color: black; color: %s; padding: 10px; border-radius: 5px; overflow: auto; max-height: 80vh;">',
        htmlspecialchars($color)
    );
    var_dump($value);
    echo '</pre>';

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
