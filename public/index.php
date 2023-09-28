<?php
echo "<h1>Testes Disponíveis</h1>";
echo "<p>";
echo "<a href='/info.php' target='_blank'>Informações do PHP</a><br>";
echo "<hr>";
foreach (range(0, 5) as $id) {
    echo "<a href='/teste{$id}.php' target='_blank'>Teste {$id}</a><br>";
}
echo "<hr><h2>Resultados</h2>";
foreach (range(0, 5) as $id) {
    echo "<a href='/results/jit_ativo_teste{$id}.html' target='_blank'>Teste {$id} | JIT Ativo</a><br>";
    echo "<a href='/results/jit_inativo_teste{$id}.html' target='_blank'>Teste {$id} | JIT Inativo</a><br>";
    echo "<hr>";
}
echo "</p>";
