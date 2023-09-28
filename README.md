# PHP with JIT enabled with Dockerfile and Docker Compose stack.
- Neste projeto teremos um ambiente Docker com as configurações necessárias para ativar o JIT, além disso todo ambiente será feito com Docker e estará pronto para ser executado via Docker Compose.
- O projeto será executado por padrão na porta 8000. Você pode acessar clicando aqui [localhost:8000](localhost:8000)
- Vídeos com todo o tutorial de utilização do JIT + Benchmarking
  - Como usar o Jit: [https://youtu.be/2KC-m0ChSU4?si=4aHx9LMmCe8M8MY8](https://youtu.be/2KC-m0ChSU4?si=4aHx9LMmCe8M8MY8)
  - Benchmarking com JIT: [#](#)

## Scripts 

- Fazer buikd ambiente Docker
```sh
sh dc-build.sh
```

- Subir ambiente Docker
```sh
sh dc-up.sh
```

- Derrubar ambiente Docker
```sh
sh dc-down.sh
```

- Reiniciar ambiente Docker
```sh
sh dc-restart.sh
```

- Entrar no container do PHP
```sh
sh dc-container.sh
```

- Checar se JIT está ativo
```sh
sh dc-check-jit.sh
```

- Remover todos os logs/results/docs
```sh
rm -rf ./public/results/*.html
rm -rf ./public/docs/*.json
rm -rf ./public/logs/*.log
```
/////////////////////////////////////
 # Usando o Vegeta para test de stress

- Confira o vídeo em que faço um tutorial sobre o uso do Vegeta [https://youtu.be/FNj0e1ZT4fI](https://youtu.be/FNj0e1ZT4fI)

- Dentro do terminal WSL, já com o Vegeta configurado, execute:
```sh
    # TESTE 1 - Script teste5.php
    #### Com JIT max 900 | Sem JIT max 180 ####
    echo "GET http://127.0.0.1:8000/teste5.php" | vegeta attack -rate=900 -duration=30s | vegeta report

    # Teste 2 - Script index.php
    #### Com Jit Max 3700 | Sem JIT max 4100
    echo "GET http://127.0.0.1:8000/index.php" | vegeta attack -rate=3700 -duration=10s | vegeta report
```