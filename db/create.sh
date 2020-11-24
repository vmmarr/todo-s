#!/bin/sh

if [ "$1" = "travis" ]; then
    psql -U postgres -c "CREATE DATABASE todo_test;"
    psql -U postgres -c "CREATE USER todo PASSWORD 'todo' SUPERUSER;"
else
    sudo -u postgres dropdb --if-exists todo
    sudo -u postgres dropdb --if-exists todo_test
    sudo -u postgres dropuser --if-exists todo
    sudo -u postgres psql -c "CREATE USER todo PASSWORD 'todo' SUPERUSER;"
    sudo -u postgres createdb -O todo todo
    sudo -u postgres psql -d todo -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    sudo -u postgres createdb -O todo todo_test
    sudo -u postgres psql -d todo_test -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    LINE="localhost:5432:*:todo:todo"
    FILE=~/.pgpass
    if [ ! -f $FILE ]; then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE; then
        echo "$LINE" >> $FILE
    fi
fi
