#!/bin/sh
USAGE="usage: $0 {createdb|purgedb|devdata}"


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
TMP_ROOT=$ROOT/tmp
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
  # ファイルとディレクトリ両方に書き込み権限を設定しないと Apache から更新できない
  chmod 0777 $DATABASE_FILE_PATH
elif [ "$SUB_COMMAND" = "purgedb" ]; then
  rm $DATABASE_FILE_PATH
elif [ "$SUB_COMMAND" = "devdata" ]; then
  sqlite3 $DATABASE_FILE_PATH << _EOT_
    INSERT INTO products VALUES (
      1,
      datetime("now"),
      "http://google.com/",
      "Google",
      "This is the Google."
    );
    INSERT INTO products VALUES (
      2,
      datetime("now"),
      "http://yahoo.com/",
      "Yahoo!",
      "This is the Yahoo!."
    );
_EOT_
elif [ "$SUB_COMMAND" = "initperm" ]; then
  chmod 0777 $DB_ROOT
  chmod 0777 $TMP_ROOT
elif [ "$SUB_COMMAND" = "init" ]; then
  $0 initperm
  $0 createdb
fi
