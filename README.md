# INSTRUÇÕES

## Instalar o banco de dados  
Para instalar o banco de dados no container docker, instale o Docker com `# apt install docker docker-compose`, e execute `$ docker-compose up -d`

## Criar banco e tabelas de dados  
Para criar o banco com as tabelas limpas, execute o SQL contido em `eclasse.sql` criando uma tabela por vez ou então `$ cat eclasse.sql | docker exec -i nome_do_container /usr/bin/mysql -u root --password=senha nome_do_banco_dados`, caso queira fazer o mesmo, porém com dump de dados já cadastrados execute `$ cat backup.sql | docker exec -i nome_do_container /usr/bin/mysql -u root --password=senha nome_do_banco_dados`, ou então `$ ./dump.sh`.

## Realizando backup do banco de dados  
Para fazer backup do banco, execute o arquivo de backup `$ ./backup.sh` ou execute o comando `$ docker exec nome_do_container /usr/bin/mysqldump -u root --password=senha nome_do_banco_dados > backup.sql`

## Apache
Para utilizar com apache, instale a lib `# apt install libapache2-mod-php` e adicione o diretório à pasta `/var/www/html` com o comando `# ln -s /pasta/para/eclasse-api /var/www/html`, depois adicione ao virtual host com `sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/eclasse.io.conf` e disponibilize o host com `# a2ensite eclasse.io`. 

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

