#!/bin/sh

if [ "$1" = "travis" ]; then
    psql -U postgres -c "CREATE DATABASE todos_test;"
    psql -U postgres -c "CREATE USER todos PASSWORD 'todos' SUPERUSER;"
else
    sudo -u postgres dropdb --if-exists todos
    sudo -u postgres dropdb --if-exists todos_test
    sudo -u postgres dropuser --if-exists todos
    sudo -u postgres psql -c "CREATE USER todos PASSWORD 'todos' SUPERUSER;"
    sudo -u postgres createdb -O todos todos
    sudo -u postgres psql -d todos -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    sudo -u postgres createdb -O todos todos_test
    sudo -u postgres psql -d todos_test -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    LINE="localhost:5432:*:todos:todos"
    FILE=~/.pgpass
    if [ ! -f $FILE ]; then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE; then
        echo "$LINE" >> $FILE
    fi
fi
