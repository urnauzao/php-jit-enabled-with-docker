<?php
declare (strict_types = 1);
$jit = (ini_get('opcache.jit') === 'on' || ini_get('opcache.jit') === "1235") ? true : false;

echo "<h1>Teste Fibonacci | " . ($jit ? "JIT ATIVO" : "Não Ativo Jit") . "</h1>" . PHP_EOL;
echo "----------------------------<br>" . PHP_EOL;
echo "----------------------------<br>" . PHP_EOL;

function fibonacci($n)
{
    if ($n <= 1) {
        return $n;
    } else {
        return fibonacci($n - 1) + fibonacci($n - 2);
    }
}

$start = microtime(true);
echo "<p>";
for ($i = 0; $i < 40; $i++) {
    echo "Fibonacci($i): " . number_format(fibonacci($i), 0, ',', '.') . "<br>";
}
echo "</p>";

echo "----------------------------<br>";
echo "----------------------------<br>";

$end = microtime(true);
$elapsed = $end - $start;

$filename = "";
if ($jit) {
    $filename = "/var/www/app/public/results/jit_ativo_teste1.html";
} else {
    $filename = "/var/www/app/public/results/jit_inativo_teste1.html";
}
$file = fopen($filename, 'a'); // 'a' significa modo de anexar (append)
fwrite($file, "<h2>Tempo decorrido: <strong>$elapsed</strong> segundos</h2>");

echo "<h2>Tempo decorrido: <strong>$elapsed</strong> segundos</h2>";
