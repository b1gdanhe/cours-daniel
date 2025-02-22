<?php

$moy = 14.5;
switch ($variable) {
    case 'value':
        # code...
        break;

    default:
        # code...
        break;
}

// if ($moy >= 18) {
//     echo "Excéllent\n";
// } else if ($moy >= 16) {
//     echo "Très Bien\n";
// } else if ($moy >= 14) {
//     echo "Bien\n";
// } else if ($moy >= 12) {
//     echo "Passable\n";
// } else if ($moy >= 10) {
//     echo "Admissible\n";
// } else {
//     echo "Echec\n";
// }

if ($moy < 10) {
    echo "Echec\n";
} else if ($moy < 12) {
    echo "Admissible\n";
} else if ($moy < 14) {
    echo "Passable\n";
} else if ($moy < 16) {
    echo "Bien\n";
} else if ($moy < 18) {
    echo "Très Bien\n";
} else if ($moy < 18) {
    echo "Excéllent\N";
}
