<?php
declare (strict_types = 1);
$jit = (ini_get('opcache.jit') === 'on' || ini_get('opcache.jit') === "1235") ? true : false;
echo "<h1>Teste Muito Louco | " . ($jit ? "JIT ATIVO" : "Não Ativo Jit") . "</h1>";
echo "----------------------------<br>";
echo "----------------------------<br>";

$start = microtime(true);
// Inclua o arquivo que contém a classe Resources
require_once 'Resources.php';

// Função para gerar uma string aleatória com um comprimento específico
function generateRandomString($length)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $randomString;
}

// Defina o comprimento desejado (pelo menos 50.0000 caracteres)
$length = 50000;

// Gere a string aleatória
// $randomString = generateRandomString($length);
$randomString = Resources::getString();

$output = (new Resources)->generate($randomString);

// Imprima a string gerada (você pode redirecionar a saída para um arquivo, se desejar)
// echo $output;

$end = microtime(true);
$elapsed = $end - $start;

$filename = "";
if ($jit) {
    $filename = "/var/www/app/public/results/jit_ativo_teste4.html";
} else {
    $filename = "/var/www/app/public/results/jit_inativo_teste4.html";
}
$file = fopen($filename, 'a'); // 'a' significa modo de anexar (append)
fwrite($file, "<h2>Tempo decorrido: <strong>$elapsed</strong> segundos</h2>");

echo "Tempo decorrido: $elapsed segundos\n";
