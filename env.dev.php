<?php

putenv('DISPLAY_ERRORS_DETAILS=' . true);

/**
 * Se utilizar o docker para o banco, execute:
 * docker inspect -f '{{.Name}} - {{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $(docker ps -aq)
 * para a porta do host
 */

putenv('ECLASSE_DB_DRIVE=pgsql');
putenv('ECLASSE_DB_HOST=172.18.0.2');
putenv('ECLASSE_DB_DBNAME=eclasse_bd');
putenv('ECLASSE_DB_USER=root');
putenv('ECLASSE_DB_PASSWORD=guitar24');
putenv('ECLASSE_DB_PORT=5432');

putenv('JWT_SECRET_KEY=$argon2i$v=19$m=65536,t=4,p=1$M0U2alFpWHJCUURFMXBNRg$5DVbdoYrEYKFHQGHXCGcFOHrS7EP7/Fm8VCvdbtYxwo');
