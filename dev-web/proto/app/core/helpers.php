<?php

function dd(...$args): void
{
    // Set header for proper formatting in browser
    if (!headers_sent() && php_sapi_name() !== 'cli') {
        header('Content-Type: text/html; charset=utf-8');
    }

    echo "<pre style='background-color: #1a1a1a; color: #f8f8f2; padding: 15px; margin: 10px; border-radius: 5px; font-family: monospace; font-size: 14px; line-height: 1.4; overflow: auto;'>";

    // Get the backtrace to show file and line information
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
    $file = $trace[0]['file'] ?? '';
    $line = $trace[0]['line'] ?? '';

    if ($file && $line) {
        echo "<div style='margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #3a3a3a;'>";
        echo "<strong style='color: #ff79c6;'>Called from:</strong> " . htmlspecialchars($file) . " (line " . $line . ")";
        echo "</div>";
    }

    $count = count($args);
    foreach ($args as $index => $arg) {
        echo "<div" . ($index < $count - 1 ? " style='margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px dashed #3a3a3a;'" : "") . ">";

        echo "<strong style='color: #8be9fd;'>Type:</strong> " . gettype($arg) . "\n";
        echo "<strong style='color: #50fa7b;'>Value:</strong>\n";

        if (is_bool($arg)) {
            echo htmlspecialchars($arg ? 'true' : 'false');
        } elseif (is_null($arg)) {
            echo '<span style="color: #bd93f9;">null</span>';
        } elseif (is_array($arg) || is_object($arg)) {
            // Use var_export for arrays and objects with syntax highlighting
            $export = var_export($arg, true);

            // Simple syntax highlighting
            $export = preg_replace('/\b(array|object|stdClass|true|false|null)\b/', '<span style="color: #bd93f9;">$1</span>', $export);
            $export = preg_replace('/=>/', '<span style="color: #ff79c6;">=></span>', $export);
            $export = preg_replace('/\'([^\']+)\'/', '<span style="color: #f1fa8c;">\'$1\'</span>', $export);
            $export = preg_replace('/\b(\d+)\b/', '<span style="color: #bd93f9;">$1</span>', $export);

            echo $export;
        } else {
            echo htmlspecialchars(var_export($arg, true));
        }

        echo "</div>";
    }

    echo "</pre>";

    // Terminate script execution
    exit(1);
}

function base_path(string $path): string
{
    return BASE_PATH . $path;
}
function app_path(string $path): string
{
    return base_path("app/$path");
}


function controller(string $path, $data = [])
{
    require app_path("controllers/{$path}");
}

function page(string $path, $data = [])
{
    extract($data);
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['flash']) && is_array($_SESSION['flash']))
    extract($_SESSION['flash']);
    require app_path("pages/{$path}");
}

function asset(string $path)
{
    return  "/assets/{$path}";
}

function isCurrentUrl($currentUrl, $menuUrl): bool
{
    return $currentUrl === $menuUrl;
}


function redirect($path, $with = [])
{
    // Démarrer la session si elle n'est pas déjà démarrée
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Stocker les données temporairement en session
    if (!empty($with)) {
        foreach ($with as $key => $value) {
            $_SESSION['flash'][$key] = $value;
        }
    }

    // Rediriger vers la page demandée
    header('Location: ' . $path);
    exit;
}


function getConfig(string $configKey): mixed
{
    return (require(app_path('config/app.php')))[$configKey];
}
