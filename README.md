# INSTRUÇÕES

## INSTUÇÕES COM APACHE E MYSQL

### Instalar o banco de dados
Para instalar o banco de dados no container docker, instale o Docker com `# apt install docker docker-compose`, e execute `$ docker-compose up -d`

### Criar banco e tabelas de dados
Para criar o banco com as tabelas limpas, execute o SQL contido em `eclasse.sql` criando uma tabela por vez ou então `$ cat <dump_desejado>.sql | docker exec -i eclasse_database psql postgres`, caso queira fazer o mesmo, porém com dump de dados já cadastrados, ou então apenas execute `$ ./dump.sh`.

### Realizando backup do banco de dados
Para fazer backup do banco, execute o arquivo de backup `$ ./backup.sh` ou execute o comando `$ docker exec eclasse_database pg_dumpall > dump_`date +%d-%m-%Y"_"%H_%M_%S`.sql`

### Nginx
Instale `# apt install nginx` e `# systemctl restart nginx`. Deixe o arquivo `/etc/nginx/nginx.conf` da seguinte forma
```
server_name localhost;
    location / {
        root /usr/share/nginx/html;
        index index.html index.htm index.php;
}
location ~ \.php$ {
    fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
    fastcgi_index index.php;
    root /usr/share/nginx/html;
    include fastcgi.conf;
}
```

### Apache
Para utilizar com apache, instale a lib `# apt install libapache2-mod-php` e adicione o diretório à pasta `/var/www/html` com o comando `# ln -s /pasta/para/eclasse-api /var/www/html`, depois adicione ao virtual host com `sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/eclasse.io.conf` e disponibilize o host com `# a2ensite eclasse.io`.
No arquivo `/etc/apache2/mods-enabled/dir.conf` lembre-se de colocar arquivos php para serem carregados primeiro.


*  O arquivo /etc/apache2/sites-available/eclasse.io.conf deve ficar assim:

<VirtualHost *:80>
	ServerAdmin email@email.com
	DocumentRoot /var/www/html/eclasse.io
	ServerAlias *.eclasse.io
	ServerName eclasse.io

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
# vim: syntax=apache ts=4 sw=4 sts=4 sr noet

Adicione o mod_rewrite com `sudo a2enmod rewrite`. Assegure-se de que na configuração de diretórios, o método `AllowOverride` esteja em `All`, adicione as regras ao firewall com o ufw (caso ele esteja inativo, execute `# ufw enable`) `# ufw allow 'Apache Full'` e verifique se os planos já estão rodando com `# ufw status`. Finalize executando `# systemctl restart apache2`.
