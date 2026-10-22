<?php
//ejercicio 1
echo"HOLA!";
?>

<?php
//ejercicio 2
$a = 2;
$b = 5;
   echo $a + $b; 
?>

<?php
//ejercicio 3
$numero =1;

if ($numero < 0) {
    echo "El número es negativo";
} else {
    echo "El número no es negativo";
}
?>

<?php
//ejercicio 4
$numero =1;

if ($numero < 0) {
    echo "El número es negativo";
} else {
    echo "El número no es negativo";
}
?>

<?php
//ejercicio 5

for($i= 1; $i <10; $i ++ ){
    echo $i . "<br>";
}
?>

<?php
//ejercicio 6
function saludarr(){
    echo "Hola, Bienvenido";
}

saludarr();
?>

<?php
//ejercicio 7
function saludar($nombre){
    echo "Hola" . $nombre;
}

saludar ("Instructora");
?>

<?php
// ejercicio 8

function area($base, $altura) {
    return $base * $altura;
}

echo area(12, 8);
?>

<?php
// ejercicio 9

$a1 = 15;
$b1 = 25;

if ($a1 > $b1) {
    echo "Es mayor";
} else {
    echo "Es menor";
}
?>