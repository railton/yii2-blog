Yii 2 Blog
===================================

Atividade realizada no treinamento de Yii2


Instalação
===================================

Instalar a seguinte extensão:
~~~
composer global require "fxp/composer-asset-plugin:1.0.0-beta2"
~~~

Na pasta do projeto digite o seguinte comando para atualizar o projeto:
~~~
composer update
~~~

Apos atualizar deixe o projeto no modo Development com o comando:
~~~
./init
~~~
Selecione a opção 0

Após isso e ó criar o banco e configurar a conexão no arquivo common/config/main-local.php.

Edite o arquivo @backend/config/main.php
e em 'baseUrl' => '/blog/frontend/web', configure a url do frontend do blog.
O exemplo está configurado caso ele esteja na seguinte url rlhttp://localhost/blog/frontend/web


O script do banco encontra-se na pasta database.

Caso queira visualizar as tabelas do banco, baixe o Sql Power Architect.
http://www.sqlpower.ca/page/architect

