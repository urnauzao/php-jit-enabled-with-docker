<?php
declare (strict_types = 1);
ini_set('memory_limit', '1024M');
$jit = (ini_get('opcache.jit') === 'on' || ini_get('opcache.jit') === "1235") ? true : false;
echo "<h1>Teste de Memória | " . ($jit ? "JIT ATIVO" : "Não Ativo Jit") . "</h1>";
echo "----------------------------<br>";
echo "----------------------------<br>";

$start = microtime(true);
// Tamanho do array para alocar memória
$size = 100000; // Isso alocará aproximadamente 10MB

// Aloca memória para um grande array
$largeArray = [];
for ($i = 0; $i < $size; $i++) {
    $largeArray[] = str_repeat('A', 1024); // Aloca 1KB para cada elemento
}

// Verifica o uso de memória atual
$memoryUsage = memory_get_usage(true);
// echo "Uso de memória atual: " . formatBytes($memoryUsage) . "\n";

// Função para formatar bytes
function formatBytes($bytes, $precision = 2)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    return round($bytes, $precision) . ' ' . $units[$pow];
}

$end = microtime(true);
$elapsed = $end - $start;

$filename = "";
if ($jit) {
    $filename = "/var/www/app/public/results/jit_ativo_teste5.html";
} else {
    $filename = "/var/www/app/public/results/jit_inativo_teste5.html";
}
$file = fopen($filename, 'a'); // 'a' significa modo de anexar (append)
fwrite($file, "<h2>Tempo decorrido: <strong>$elapsed</strong> segundos</h2>");

echo "Tempo decorrido: $elapsed segundos\n";
