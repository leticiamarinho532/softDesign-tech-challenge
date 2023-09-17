# Desafio Técnico
## Aplicação web em PHP com acesso restrito, que exiba uma listagem de livros com as opções de ver os detalhes, editar, deletar e criar um livro, e também exiba o clima atual da sua região.

### Sumário

1. Tecnologias
2. BoilerPlate
3. Como usar na sua máquina
    - Clonando
    - Definindo Variáveis de Ambiente
    - Rodando
4. Testes
    - Unidade / Integração
    - Como Está sendo usado o banco de dados
5. Explicações de Algumas Funcionalidades
6. Itens Não Completos


## **1. Tecnologias**
1. PHP 8.1
2. Laravel 10.10
3. Composer 2.x
4. MYSql 8
6. PHPUnit 10.1
9. Docker
10. React 18

## **2. Boilerplate**

No back-end:

Com o uso do laravel, existe pastas que são default.
Código que foi feito por mim está localizado nas seguintes pastas:

```
.
├── app                    
│   ├── Exceptions                              # Here
│   ├── Interfaces                              # Here
│   ├── Models                                  # Here
│   ├── Repositories                            # Here
│   ├── Services                                # Here
│   └── Http                                    # Here
│   └── ... 
├── ...
├── database                                    # Here
├── config                                      # Here
├── ...               
├── ...
├── routes                                      # Here
├── ...
├── tests                                       # Here
├── .env                                        # Here
├── .env.testing                                # Here
├── DockerFile                                  # Here
├── docker-compose.yalm                         # Here
├── DockerFile-dependency-manager               # Here
└──
```


## **3. Como usar na sua máquina**

#### Clonando
- Instale o Docker no seu local [site Docker](https://docs.docker.com/desktop/).
- Clone  esse repositório.

#### Definindo Variáveis de Ambiente
- Copie a .env.example para o arquivo .env

```
Obs: a `.env` foi disponibilizada na `.env.example` por ser tratar de um desafio técnico e para tornar a utilização mais fácil. Em caso de um projeto real, essa prática não é recomendada, pois dados sensíveis deve ser guardados.
```
#### Rodando
```
Aviso: Não é necessário rodar comandos para instalar as dependências dos projetos pois já existe uma configuração automática em conjunto com as configurações do docker.
```

- Disponibilize a porta 3306 para o banco de dados.
- Rode esse comando `docker compose up` na pasta raiz (onde o arquivo docker-compose.yaml está).
- Use seu Ip local, com a porta 8181, para usar as rotas do back-end que estão listadas no tópico `Rotas`
- Já tem migrations e seeders prontas para uso! para utliza-las é necessário fazer o passo a passo citado no `tópico testes` para entrar no container e então rodar o comando `php artisan migrate --seed`.

## **4. Testes**
- Unidade / Integração (Backend)

    Os testes de unidade foram aplicados para assegurar comportamento correto nos menores pedaços de código, que nesse projeto se encontram nos `Services`.

    Os testes de integração foram aplicados para assegurar que a junção de tecnologias, que no caso foi a junção com banco de dados, funcione corretamente.

    Para executar os testes, entre no container do projeto back-end `nome do container: app-bank-managment` usando o comando `docker exec -it ID_DO_CONTAINER bash` e utilize artisan para rodar os testes com o comando `php artisan test`.

- Como Está sendo usado o banco de dados

    Para os testes não poluirem o banco principal, foi utilizado um banco de dados in memomy `SQLite`. para que isso pudesse acontecer, foi utilizado um arquivo `.env` de testes, com nome de `env.testing`.

    É necessário rodar as migrations no banco de testes, com o comando `php artisan migrate --env=testing`

## **5. Explicações de Algumas Funcionalidades**
- Banco de Dados

    Não foi disponibilizado um volume para o banco de dados principal `MySQL` pois da maneira utilizada, a aplicação consegue ser consultada com softwares de consulta de banco, pelo seu IP local usando porta `3006`. Dessa maneira, para um projeto que ficará somente no local, é mais rápido a conclusão do mesmo.

- Mensagens de retorno extras

    Acrescentei mensagem personalizadas extras para que, por exemplo, quando está tentando fazer uma transferência e a conta não existe, a mensagem consegue auxiliar qual é o problema que está ocorrendo.
    Obs: Mensagem de error internas (ex: tabela não existe, timeout, etc) não são passadas no response. Nesses casos é passado uma mensagem genérica que indica que não foi possível realizar X ação.

- Logs

    Acrescentei logs (escrevendo no arquivo laravel.log) para ser possível trabalhar com algum tipo de monitoramento.
    Obs: Em aplicações reais o melhor é usar algum tipo de APM para poder realizar monitoramento e observabilidade.

- Acces Token no Local Storage

    Por ser tratar de um desafio técnico, o access token foi guardado no local storage. Mas em uma aplicação real esse tipo de tratamento com dados sensíveis não é recomendado. O ideal é procurar por uam outra solução.

## **6. Itens Não Completos**

No frontend
- finalizar página e componentes de livros: listagem de livros com possibilidade de editar, exluir e criar novos livros.
- Proteger as rotas que devem ser acessadas somente com autenticação feita.
- Criar página e componente de clima da Região.