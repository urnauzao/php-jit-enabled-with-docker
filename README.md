# PHP with JIT enabled with Dockerfile and Docker Compose stack.
- Neste projeto teremos um ambiente Docker com as configurações necessárias para ativar o JIT, além disso todo ambiente será feito com Docker e estará pronto para ser executado via Docker Compose.

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