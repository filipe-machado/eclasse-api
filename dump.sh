# RESTAURA O BANCO DE DADOS
cat dump_19-05-2020_19_10_45.sql | docker exec -i eclasse_database psql postgres
