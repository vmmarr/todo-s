#!/bin/sh

BASE_DIR=$(dirname "$(readlink -f "$0")")
if [ "$1" != "test" ]; then
    psql -h localhost -U todos -d todos < $BASE_DIR/todos.sql
fi
psql -h localhost -U todos -d todos_test < $BASE_DIR/todos.sql
