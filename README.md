# Projeto Final - Sistemas Distribuídos e Mobile

Este aplicativo compõe o trabalho final da disciplina Sistemas Distribuídos e Mobile da faculdade UniBH / UNA.

## Setup da aplicação
Siga as instruções abaixo para realizar o setup da aplicação em seu computador e configurar o ambiente local de desenvolvimento.

### Pré-requisitos
Para realizar o setup do sistema, será necessário ter instalado no computador o software [Docker](https://www.docker.com/get-started/), junto com a ferramenta [Docker Compose](https://docs.docker.com/compose/)

O uso do VSCode não é obrigatório, mas recomendado para edição de códigos e manuseio dos arquivos enviados e baixados para o container da aplicação.

### Cópia dos arquivos
Para ter os arquivos do projeto em seu computador, basta clonar o projeto ou baixar os arquivos utilizando as instruções do próprio Github.

## Instalação
Uma vez baixado ou clonado o projeto, em seu prompt de comando (terminal) acesse a pasta raiz contendo todos os arquivos da aplicação. Em seguida execute o seguinte comando :

```
docker-compose up -d
```

O comando acima irá realizar sequencialmente dois passos: a montagem da aplicação (`build`) e a inicialização dos containers. Este processo poderá demorar um pouco, pois todas as imagens serão baixadas e os comandos de criação dos containers da aplicação serão executados.

Caso a execução ocorra com sucesso, três serviços (containers) serão inicializados:

* httpserver
* phpfpm
* db

O status dos serviços podem ser conferidos por meio do seguinte comando:

```
docker container ls
```

Caso sejam listadas três linhas, cada uma com a informação a respeito de um serviço, a criação dos containers foi realizada com sucesso. Caso contrário, ocorreu algum erro e você deve entrar em contato com o grupo.

### Cópia dos arquivos base
Neste ponto, devemos sincronizar os arquivos do projeto (baixados nos passos anteriores) com os arquivos nos containers Docker. Este passo não é recomendado para usuários Linux, portanto prossiga somente caso utilize sistemas operacionais Windows ou Mac. O comando para enviar os arquivos da aplicação ao container é o seguinte e deve ser executado a partir da pasta raiz da aplicação no seu prompt de comandos (terminal):

```
docker cp "src/" "$(docker-compose ps -q phpfpm|awk '{print $1}')":/var/www/app/
```

#### Sincronização de arquivos em sistemas Linux
Caso utilize sistema operacional Linux, estas pastas podem ser sincronizadas automaticamente removendo o caracter de comentário nas seguintes linhas do arquivo `docker-compose.yml`:

```
volumes: &sharedvolumes
 - ./src:/var/www/app
volumes: *sharedvolumes
```

**Atenção!** Caso utilize sistema operacional Windows ou Mac, **não** realize esta alteração pois causará sérios problemas de desempenho na máquina durante a execução dos containers.


### Instalação das bibliotecas utilizadas

Acesse o terminal do container Docker para instalar as bibliotecas utilizadas pelo sistema, por meio do gerenciador de pacotes Composer.

Para acessar o terminal do container, digite o seguinte no prompt de comandos, a partir da pasta raiz da aplicação:

```
docker-compose exec phpfpm /bin/bash
```

Após a execução desta instrução, você deverá estar na linha de comandos do container denominado `phpfpm`. Para instalar as bibliotecas via Composer, execute o seguinte comando:

```
composer install
```

Este passo deverá ser suficiente para instalar todas as bilbiotecas utilizadas pelo sistema. Para sair do terminal do container Docker, digite `exit` e aperte a tecla Enter.


### Criação da estrutura do banco de dados

A aplicação utiliza o ORM Doctrine para manipular os dados persistidos no banco de dados. Para tanto, antes de executar a aplicação a primeira vez, faz-se necessário executar o seguinte comando para criar as tabelas no banco de dados:

```
docker-compose exec phpfpm php /var/www/app/bin/console doctrine:migrations:migrate
```

A partir deste ponto, sua aplicação deverá estar pronta para ser acessada a partir do seguinte endereço:

http://127.0.0.1/api
