<?php
//suma//

function sumar(int $a, int $b): int {
    return $a + $b;
}
echo sumar(5, 8); // 13

function saludarA(string $nombre = "invitado"): string {
    return "Hola, $nombre";
}
echo saludarA();        // Hola, invitado
echo saludarA("Santiago"); // Hola, Santiago