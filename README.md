pinfee
======


## 開発する

### 開発環境を動かす

```
git clone git@github.com:kjirou/pinfee.git
cd ./pinfee
cp config/environments.example.php config/environments.php
```


### コマンドを使う

データベースを作る:

```
./scripts/manage.sh createdb
```

データベースを削除する:

```
./scripts/manage.sh purgedb
```
