# RESTAURA O BANCO DE DADOS
cat backup.sql | docker exec -i eclasse_database /usr/bin/mysql -u root --password=guitar24 eclasse_bd