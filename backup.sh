# FAZ BACKUP DO BANCO DE DADOS
docker exec eclasse_database /usr/bin/mysqldump -u root --password=guitar24 eclasse_bd > backup.sql