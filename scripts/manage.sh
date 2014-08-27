#!/bin/sh
USAGE="usage: $0 {createdb|purgedb|initperm|init}"


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
  CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    created_at DATETIME NOT NULL,
    url TEXT NOT NULL,
    title TEXT,
    description TEXT,
    like_count INTEGER NOT NULL DEFAULT 0,
    comment_count INTEGER NOT NULL DEFAULT 0
  );
  CREATE TABLE IF NOT EXISTS comments (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    created_at DATETIME NOT NULL,
    product_id INTEGER NOT NULL,
    body TEXT,
    FOREIGN KEY(product_id) REFERENCES products(id)
  );
  CREATE TABLE IF NOT EXISTS recipients (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    created_at DATETIME NOT NULL,
    email TEXT NOT NULL,
    canceled_at DATETIME
  );
_EOT_
  # ファイルとディレクトリ両方に書き込み権限を設定しないと Apache から更新できない
  chmod 0777 $DATABASE_FILE_PATH
elif [ "$SUB_COMMAND" = "purgedb" ]; then
  rm $DATABASE_FILE_PATH
elif [ "$SUB_COMMAND" = "initperm" ]; then
  chmod 0777 $DB_ROOT
  chmod 0777 $TMP_ROOT
elif [ "$SUB_COMMAND" = "init" ]; then
  $0 initperm
  $0 createdb
elif [ "$SUB_COMMAND" = "reset" ]; then
  echo 'Reset application? [y/n]'
  read answer
  case $answer in
    'y' | 'Y')
      $0 purgedb
      $0 init
      break
      ;;
  esac
fi
