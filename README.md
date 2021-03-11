# seventh
**Desafio VAGA PHP-FULLSTACK**
<hr>

O seguinte sistema foi desenvolvido tendo como base a arquitetura MVC, utilizando-se do Laravel 5.8 (PHP >= 7.1.3) para o desenvolvimento do Backend atuando como um REST API JSON via autenticação JWT. Já no Frontend foi se utilizado o framework Vue.js 2x, com plugins para o desenvolvimento de uma aplicação SPA, como o vue-router, vuex e o axios.

Ao clonar o repositório, seguir os seguintes passos:

**1º.:** Abrir a raíz do projeto
````
cd seventh
````
**2º.:** Instalar as dependências do PHP via Composer
````
composer install
````
**3º.:** Instalar as dependências do Node via NPM
````
npm install
````
**4º.:** Criar o arquivo do banco de dados sqlite
````
cd database
````
````
touch database.sqlite
````
**5º.:** Migrar as migrations
````
cd ..
````
````
php artisan migrate
````
