FROM mariadb:latest

ADD app/install/evote.sql /docker-entrypoint-initdb.d/evote.sql