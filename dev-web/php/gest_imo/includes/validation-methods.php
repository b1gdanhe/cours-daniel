<?php

$error_messages =  require_once(BASE_PATH . 'includes/validation-messages.php');

function string(string $name, $value, int $min = 1,  $max = INF): array
{
    global $error_messages;
    $condition = is_string($value) &&  strlen($value) >= $min && strlen($value) <= $max;
    $current_error_message = format_error_message($error_messages['string'], "{attr}", $name);
    return  returnValidationResult($condition, $value, $current_error_message);
}

function int(string $name, $value, int $min = 1,  $max = INF): array
{
    global $error_messages;
    $condition = is_int($value) &&  $value >= $min && $value <= $max;
    $current_error_message = format_error_message($error_messages['int'], "{attr}", $name);
    return  returnValidationResult($condition, $value, $current_error_message);
}

function email(string $name, $value): array
{
    global $error_messages;
    $condition = filter_var($value, FILTER_VALIDATE_EMAIL);
    $current_error_message = format_error_message($error_messages['email'], "{attr}", $name);
    return  returnValidationResult($condition, $value, $current_error_message);
}



function exists($table, $column, $value): array
{
    global $error_messages;
    $condition  = one($table, $column, $value);
    $current_error_message = format_error_message($error_messages['exsist'], "{attr}", $column);
    return  returnValidationResult($condition, $value, $current_error_message);
}



function unique($table, $column, $value): array
{
    $query = "SELECT $column FROM $table WHERE $column = :value";
    $params =  ['value' => $value];
    $result  = one($query, $column, $value);
    return [];
}




function validate($value)
{
    if (!isset($value)) {
        return false;
    } else {
        $valueCleaned = htmlspecialchars(strip_tags(trim($value)));
        return empty($valueCleaned) ? false : $valueCleaned;
    }
}

function is_file_valide(array $file, $types = ['pdf', 'image'], ?int $maxSize = null): array
{
    // Vérifier les erreurs d'upload PHP
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors = [
            UPLOAD_ERR_INI_SIZE => 'Le fichier dépasse la taille maximale autorisée par PHP',
            UPLOAD_ERR_FORM_SIZE => 'Le fichier dépasse la taille maximale autorisée par le formulaire',
            UPLOAD_ERR_PARTIAL => 'Le fichier a été partiellement téléchargé',
            UPLOAD_ERR_NO_FILE => 'Aucun fichier n\'a été téléchargé',
            UPLOAD_ERR_NO_TMP_DIR => 'Dossier temporaire manquant',
            UPLOAD_ERR_CANT_WRITE => 'Impossible d\'écrire sur le disque',
            UPLOAD_ERR_EXTENSION => 'Une extension PHP a arrêté l\'upload',
        ];

        return [
            'success' => false,
            'message' => $errors[$file['error']] ?? 'Erreur inconnue lors du téléchargement',
            'file_info' => null
        ];
    }

    // Normaliser les types en tableau
    $allowedTypes = is_array($types) ? $types : [$types];

    // Collecter tous les types MIME autorisés
    $allowedMimes = [];
    $totalMaxSize = 0;

    foreach ($allowedTypes as $type) {
        if (!isset(FILE_CONFIG[$type])) {
            return [
                'success' => false,
                'message' => "Type de fichier non configuré: $type",
                'file_info' => null
            ];
        }

        $allowedMimes = array_merge($allowedMimes, FILE_CONFIG[$type]['mime']);
        $totalMaxSize = max($totalMaxSize, FILE_CONFIG[$type]['max_size']);
    }

    // Utiliser la taille max spécifiée si fournie
    $maxFileSize = $maxSize ?? $totalMaxSize;

    // Vérifier le type MIME
    if (!in_array($file['type'], $allowedMimes)) {
        return [
            'success' => false,
            'message' => 'Type de fichier non autorisé. Types acceptés: ' . implode(', ', $allowedTypes),
            'file_info' => null
        ];
    }

    // Vérifier la taille
    if ($file['size'] > $maxFileSize) {
        return [
            'success' => false,
            'message' => 'Le fichier est trop volumineux. Taille maximale: ' . formatBytes($maxFileSize),
            'file_info' => null
        ];
    }

    // Vérifier l'extension (sécurité supplémentaire)
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $extensionValidated = false;

    foreach ($allowedTypes as $type) {
        $validExtensions = array_map(function ($mime) {
            return str_replace(['image/', 'application/'], '', $mime);
        }, FILE_CONFIG[$type]['mime']);

        if (in_array($extension, $validExtensions) || in_array(str_replace('jpeg', 'jpg', $extension), $validExtensions)) {
            $extensionValidated = true;
            break;
        }
    }

    if (!$extensionValidated) {
        return [
            'success' => false,
            'message' => 'Extension de fichier non autorisée',
            'file_info' => null
        ];
    }

    // Retourner les infos du fichier si tout est valide
    return [
        'success' => true,
        'message' => 'Fichier valide',
        'file_info' => [
            'name' => $file['name'],
            'type' => $file['type'],
            'size' => $file['size'],
            'formatted_size' => formatBytes($file['size']),
            'tmp_name' => $file['tmp_name'],
            'extension' => $extension
        ]
    ];
}

function format_error_message($message, $search, $replace): string
{
    return str_replace($search, $replace, $message);
}

function returnValidationResult(bool $condition, $value, string  $message = 'Ce champ est obligatoire'): array
{
    if (!$condition) {
        return [
            'message' => $message,
            'isValidated'  => false
        ];
    } else {
        return [
            'value' => $value,
            'isValidated'  => true
        ];
    }
}
