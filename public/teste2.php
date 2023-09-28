<?php
declare (strict_types = 1);
$jit = (ini_get('opcache.jit') === 'on' || ini_get('opcache.jit') === "1235") ? true : false;

echo "<h1>Teste Leitura em arquivos JSON | " . ($jit ? "JIT ATIVO" : "Não Ativo Jit") . "</h1>";
echo "----------------------------<br>";
echo "----------------------------<br>";

$start = microtime(true);
$files = glob('/var/www/app/public/docs/*.json');

echo "<p>";
foreach ($files as $file) {
    $content = file_get_contents($file);
    $json = json_decode($content, true);
    if ($json['seller_id'] == "838463265") {
        echo "<br>";
        echo "Vendedor encontrado<br>";
        echo "Anúncio: " . $json['title'] . "<br>";
        echo "___________<br>";
    }

    $arr = explode('/', $file);
    $name_file = end($arr);
    echo "Arquivo: $name_file, Tamanho do conteúdo: " . strlen($content) . " letras.<br>";
}
echo "</p>";

$end = microtime(true);
$elapsed = $end - $start;

$filename = "";
if ($jit) {
    $filename = "/var/www/app/public/results/jit_ativo_teste2.html";
} else {
    $filename = "/var/www/app/public/results/jit_inativo_teste2.html";
}
$file = fopen($filename, 'a'); // 'a' significa modo de anexar (append)
fwrite($file, "<h2>Tempo decorrido: <strong>$elapsed</strong> segundos</h2>");

echo "<h2>Tempo decorrido: <strong>$elapsed</strong> segundos</h2>";
