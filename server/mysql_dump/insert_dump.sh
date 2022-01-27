#!/bin/bash
docker exec server_mysql_1 mysqldump -u root --password=12345 test_db < test_db_dump.sql
