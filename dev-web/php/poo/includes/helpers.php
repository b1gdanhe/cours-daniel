<?php


function dd($value, bool $die = true, string $color = 'lightgreen'): void
{
    ob_start(); // Démarre la mise en mémoire tampon de sortie
    var_export($value); // Génère une représentation de code PHP
    $output = ob_get_clean(); // Récupère et nettoie la sortie mise en mémoire tampon
    
    $highlighted = highlight_string("<?php " . $output . ";", true); // Colore la sortie
    
    // Supprime les balises <?php et ; ajoutées par highlight_string
    
    $highlighted = str_replace('<?php&nbsp;', '', $highlighted);
  

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

function controller($path)
{
    require base_path("controllers/$path");
}

function page($path, $datas)
{
    extract($datas);
    require base_path("pages/$path");
}

function class_path($path)
{
    require base_path("class/$path");
}
