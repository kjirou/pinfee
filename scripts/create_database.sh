#!/bin/sh
DATABASE_NAME='pinfee_dev.db'


SCRIPT_ROOT=$(cd $(dirname $0) && pwd)
ROOT=$SCRIPT_ROOT/..
DB_ROOT=$ROOT/db


sqlite3 $DB_ROOT/$DATABASE_NAME << _EOT_
CREATE TABLE products (
  id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  created_at DATETIME NOT NULL,
  url TEXT NOT NULL,
  title TEXT,
  description TEXT
);
_EOT_
