#!/bin/sh

BASE_DIR=$(dirname "$(readlink -f "$0")")
if [ "$1" != "test" ]; then
    psql -h localhost -U todo -d todo < $BASE_DIR/todo.sql
fi
psql -h localhost -U todo -d todo_test < $BASE_DIR/todo.sql
