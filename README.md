pinfee
======


## 開発する

### 開発環境を用意する

- `PHP >= 5.4`
- `sqlite3`
- `Apache >= 2.2`

### 開発環境を動かす

```
git clone git@github.com:kjirou/pinfee.git
cd pinfee
./scripts/manage.sh init
cp config/environments.example.php config/environments.php
./scripts/manage.sh server
open http://localhost:8000  # Mac のみ、ブラウザでこのURLを開くのと同じ
```


### コマンドを使う

開発サーバを起動する:

```
./scripts/manage.sh server
```

アプリケーションを初期化する:

```
./scripts/manage.sh init
```

アプリケーションをリセットする:

```
./scripts/manage.sh reset
```

データベースを作る:

```
./scripts/manage.sh createdb
```

データベースを削除する:

```
./scripts/manage.sh purgedb
```
