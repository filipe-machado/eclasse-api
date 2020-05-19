# FAZ BACKUP DO BANCO DE DADOS
docker exec eclasse_database pg_dumpall > dump_`date +%d-%m-%Y"_"%H_%M_%S`.sql
