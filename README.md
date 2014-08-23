pinfee
======


## 開発する

### 開発環境を動かす

```
git clone git@github.com:kjirou/pinfee.git
cd pinfee
./scripts/manage.sh init
cp config/environments.example.php config/environments.php
```


### コマンドを使う

アプリケーションを初期化する:

```
./scripts/manage.sh init
```

データベースを作る:

```
./scripts/manage.sh createdb
```

データベースを削除する:

```
./scripts/manage.sh purgedb
```
