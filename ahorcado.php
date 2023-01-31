<?php

function clear() {

    if (PHP_OS === "WINNT")
        system("cls");
    else
        system("clear");

}

/* Solo agrega palabras */
$lista_palabras = ["programador", "gato", "comida", "desprolijo", "pensamiento", "satisfacción", "dormir", "codear"];

// constantes
define("MAX_INTENTOS", 3);

// variables lógica
$palabra = $lista_palabras[rand(0, count($lista_palabras) -1)]; // resto porque los arrays comienzan en cero
$palabra = strtolower($palabra); // paso la palabra a minuscula para asegurar
$size_palabra = strlen($palabra);
$cadena_letras = str_pad("", 2*$size_palabra, "_ ");

// variables jugador
$vidas = 3;
$letra;
$gano = false; $econtro_letra = false;

// clear();
do{
    // inicio
    echo "\n\n\t¡Bienvenido al juego del ahorcado!\n\n\n";

    // va a variar
    echo "VIDAS = $vidas" . "\n\n";
    echo "\t\t" . $cadena_letras . "\n\n";
    $letra = readline("Ingrese una letra: ");
    $letra = strtolower($letra); // aseguramos que sea minuscula

    // busca coincidencia de la letra con la palabra, si es asi lo remplaza
    for ($i=0; $i < strlen($palabra) ; $i++) { 
        if( $letra == $palabra[$i]){
            // multiplico x2 a la posición porque mi cadena es así "_ _ _ _ _ _ _ _"
            $cadena_letras[2*$i] = $letra; $econtro_letra = true;
        }
    }

    // si no hubo por lo menos una coincidencia disminuye la vida
    if($econtro_letra == false){
        $vidas--;
    }
    $econtro_letra = false; // reiniciamos la variable

    // obtenemos la palabra encontrada, quitando espacios en blanco y guiones bajo
    $palabra_encontrada = preg_replace(array('/\s/', '/_/'), '', $cadena_letras);
    
    // termina el juego si econtro la palabra
    if($palabra == $palabra_encontrada){
        $gano = true; break;
    }
    
}while($vidas > 0 && $gano == false);

echo "\n\n\n\n";
if($gano == true){
    echo "\tFelicitaciones!!! 🏆😊, econtraste la palabra";
    echo "\nPalabra mágica = " . $palabra;
}
else{
    echo "\tLo siento 😥, intentalo otra vez!!!😉";
    echo "\nPalabra mágica = " . $palabra;
    echo "\nEcontraste = " . $cadena_letras ;
}
echo "\n\nHecho por Keneth Lopez 💚\n\n\n";

?>