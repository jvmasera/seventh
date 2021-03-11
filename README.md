# seventh
**Desafio VAGA PHP-FULLSTACK**
<hr>

<h3>Informações Técnicas:</h3>

O seguinte sistema foi desenvolvido tendo como base a arquitetura MVC, utilizando-se do Laravel 5.8 (PHP >= 7.1.3) para o desenvolvimento do Backend atuando como um REST API JSON via autenticação JWT. Já no Frontend foi se utilizado o framework Vue.js 2x, com plugins para o desenvolvimento de uma aplicação SPA, como o vue-router, vuex e o axios.
Para a montagem do ambiente, foi se utilizado o Docker com as imagens do <a href="https://laradock.io/" target="_blank">Laradock</a>.

<hr>

<h3>Subindo o ambiente:</h3>

**1º.:** Crie uma pasta X, e dentro dela, clone o repositório do laradock
````
git clone https://github.com/Laradock/laradock.git
````

**2º.:** Entre na pasta do laradock e renomeie env-example para .env
````
cp env-example .env
````

**3º.:** Volte para a pasta X e clone o repositório do sistema
````
git clone https://github.com/jvmasera/seventh.git
````

as pastas ficarão dispostas dessa maneira:
````
X
|__ laradock
|__ seventh
````
**4º.:** Volte para a pasta do laradock e procure pela pasta **apache2/sites**

**5º.:** Copie e Cole o arquivo **sample.conf.example**, renomeando para **seventh.conf** (*caso tenha renomeado a pasta do sistema, colocar o mesmo nome*)

**6º.:** Edite o arquivo .conf colocando as seguintes configurações de Virtual Host:
````
<VirtualHost *:80>
  ServerName seventh
  DocumentRoot /var/www/seventh/public/
  Options Indexes FollowSymLinks

  <Directory "/var/www/seventh/public/">
    AllowOverride All
    <IfVersion < 2.4>
      Allow from all
    </IfVersion>
    <IfVersion >= 2.4>
      Require all granted
    </IfVersion>
  </Directory>

</VirtualHost>
````

**7º.:** Edite o arquivo *Host* do Windows, localizado em *C:\Windows\System32\drivers\etc\hosts*, e adicione a seguinte linha
````
127.0.0.1 seventh
````

**8º.:** Por fim, crie os Containers do Laradock
````
docker-compose up -d apache2 workspace
````
A aplicação, após a sua configuração, ficará disponível caso todos os passos anteriores tenha obtido êxito, no seguinte domínio
````
http://seventh
````
<hr>

<h3>Configurando o sistema:</h3>

Com os containers já rodando, abra a CLI do Apache2 do Laradock
```
cd laradock
docker-compose exec workspace bash
```


**1º.:** Abrir a pasta raíz do projeto
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
touch database.sqlite
````
**5º.:** Renomear o arquivo .env.example na pasta raíz do projeto para .env

**6°.:** Gerar a chave do JWT
````
php artisan jwt:secret
````
**7º.:** Migrar as migrations
````
php artisan migrate
````
**8º.:** Gerar a chave da aplicação
````
php artisan key:generate
````

**9º.:** Por último, execute o script do package.json para gerar a Build da aplicação
````
npm run prod
```` 
