# Sistema Gerador de Certificados de Especialidades - DBV

## Iniciar

A partir da pasta raiz do projeto, entre no terminal e use

```sh
cd src
```

para entrar na pasta dos arquivos.

Agora inicie o servidor PHP usando

```sh
php -S localhost:8080
```

Vá no navegador de internet e cole o seguinte código na barra de endereço

```sh
http://localhost:8080
```

Pronto, sistema iniciado.

## Como usar

Crie um arquivo CSV, com uma única coluna, com cabeçalho. Selecione o arquivo na página principal do sistema. Logo após isso clique no botão de *submit* e o sistema gerará o PDF com os certificados automaticamente.

Obs.: O sistema remove a primeira linha do arquivo CSV, pois entende que ela seja o cabeçalho.
