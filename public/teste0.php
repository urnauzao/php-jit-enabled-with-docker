<?php
declare (strict_types = 1);
$jit = (ini_get('opcache.jit') === 'on' || ini_get('opcache.jit') === "1235") ? true : false;
echo "<h1>Teste de Request | " . ($jit ? "JIT ATIVO" : "Não Ativo Jit") . "</h1>" . PHP_EOL;
echo "----------------------------<br>" . PHP_EOL;
echo "----------------------------<br>" . PHP_EOL;

$start = microtime(true);

// Número inicial do serial
$serialNumber = 2061113099;
$numRequests = 200; // Número de solicitações a serem feitas

// Diretório onde os arquivos JSON serão salvos
$outputDirectory = '/var/www/app/public/docs';

// Certifique-se de que o diretório de saída exista
if (!file_exists($outputDirectory)) {
    mkdir($outputDirectory, 0777, true);
}

echo "<p class='line-height: 1.8; font-size: 12px; font-family: monospace;'>";
for ($i = 0; $i < $numRequests; $i++) {
    // Construa a URL com o número serial atual
    $url = "https://api.mercadolibre.com/items/MLB{$serialNumber}";

    // Inicialize a sessão cURL
    $ch = curl_init($url);

    // Defina as opções do cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Defina um timeout de conexão de 10 segundos
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

    // Defina um timeout total de 30 segundos
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    // Faça a solicitação HTTP
    $response = curl_exec($ch);

    // Verifique se a solicitação foi bem-sucedida
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
        // Gere um nome de arquivo único com base no número serial
        $filename = "{$outputDirectory}/MLB{$serialNumber}.json";

        // Salve o conteúdo da resposta no arquivo JSON
        file_put_contents($filename, $response);

        echo "<span style='color:white; background: green; padding: 5px; margin-bottom: 5px'>SUCESSO</span> | Solicitação para {$url} bem-sucedida. Arquivo JSON salvo em {$filename}<br>";
    } else {
        echo "<span style='color:white; background: red; padding: 5px; margin-bottom: 5px'>FALHA</span> | Falha na solicitação para {$url}<br>";
    }

    // Incremente o número serial
    $serialNumber++;

    // Feche a sessão cURL
    curl_close($ch);
}
echo "</p>";

echo "----------------------------<br>";
echo "----------------------------<br>";

$end = microtime(true);
$elapsed = $end - $start;

$filename = "";
if ($jit) {
    $filename = "/var/www/app/public/results/jit_ativo_teste0.html";
} else {
    $filename = "/var/www/app/public/results/jit_inativo_teste0.html";
}
$file = fopen($filename, 'a'); // 'a' significa modo de anexar (append)
fwrite($file, "<h2>Tempo decorrido: <strong>$elapsed</strong> segundos</h2>");

echo "<h2>Tempo decorrido: <strong>$elapsed</strong> segundos</h2>";
