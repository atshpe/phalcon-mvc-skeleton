#!/bin/bash
docker exec phalcon_1_mysql_1 mysqldump -u root --password=12345 phalcon > phalcon_dump.sql
