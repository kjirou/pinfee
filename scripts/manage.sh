#!/bin/sh
USAGE="usage: $0 {createdb|purgedb}"


DATABASE_NAME='pinfee_dev.db'

while getopts "" flag; do
  case $flag in
    \?)
      OPT_ERROR=1;
      break
      ;;
  esac
done
shift `expr $OPTIND - 1`
if [ $OPT_ERROR ]; then
  echo >&2 'Invalid option(s)'
  echo >&2 $USAGE
  exit 1
fi


SUB_COMMAND=$1
if [ "$SUB_COMMAND" = "" ]; then
  echo >&2 'Invalid argument(s)'
  echo >&2 $USAGE
  exit 1
fi


SCRIPT_ROOT=$(cd $(dirname $0) && pwd)
ROOT=$SCRIPT_ROOT/..
DB_ROOT=$ROOT/db
DATABASE_FILE_PATH=$DB_ROOT/$DATABASE_NAME


if [ "$SUB_COMMAND" = "createdb" ]; then
  sqlite3 $DATABASE_FILE_PATH << _EOT_
  CREATE TABLE products (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    created_at DATETIME NOT NULL,
    url TEXT NOT NULL,
    title TEXT,
    description TEXT
  );
_EOT_
elif [ "$SUB_COMMAND" = "purgedb" ]; then
  rm $DATABASE_FILE_PATH
fi
