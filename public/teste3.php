<?php
declare (strict_types = 1);
$jit = (ini_get('opcache.jit') === 'on' || ini_get('opcache.jit') === "1235") ? true : false;

echo "<h1>Teste de Cálculo de PI | " . ($jit ? "JIT ATIVO" : "Não Ativo Jit") . "</h1>";
echo "----------------------------<br>";
echo "----------------------------<br>";

function calculatePi(float $n)
{
    $pi = 0;
    for ($i = 0; $i < $n; $i++) {
        $pi += 4 * ((-1) ** $i) / (2 * $i + 1);
    }
    return $pi;
}

$iterations = 100000000; // Número de iterações para calcular Pi
$start = microtime(true);

$pi = calculatePi($iterations);
echo "Valor estimado de Pi após $iterations iterações: $pi\n";

$end = microtime(true);
$elapsed = $end - $start;

$filename = "";
if ($jit) {
    $filename = "/var/www/app/public/results/jit_ativo_teste3.html";
} else {
    $filename = "/var/www/app/public/results/jit_inativo_teste3.html";
}
$file = fopen($filename, 'a'); // 'a' significa modo de anexar (append)
fwrite($file, "<h2>Tempo decorrido: <strong>$elapsed</strong> segundos</h2>");

echo "Tempo decorrido: $elapsed segundos\n";
