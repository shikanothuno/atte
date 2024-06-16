# プリケーション名：Atte  
勤怠管理アプリ  
* 勤務開始、勤務終了、休憩開始、休憩終了の時間を保存できる。  
* 勤務時間、休憩時間を計算できる。  
* 一日に何度も休憩できる。  
* 退勤中、休憩中に日をまたいでも問題ない。  
* 個人の勤怠記録の一覧が確認できる。  
* 日付ごとの全員の勤怠記録の一覧が確認できる。  
* カレンダーからどの日付の勤怠記録を確認するか選択できる。  
* ユーザー名一覧からどの個人の勤怠記録を確認するか選択できる。  

トップ画面の画像
![[トップ画面]top-view.png](/images/top-view.png)

## 作成した目的  
ある企業が人事評価向上のために勤怠管理システムの導入を希望したため。  

## アプリケーションURL  
http://localhost/  
未ログインだとログイン画面に遷移する。  

## 機能一覧  
* ログイン機能  
* 新規登録機能  
* ログアウト機能  
* 勤怠管理機能  
* 日にち別に全員の勤怠状況を表示する機能  
* ユーザー別にひと月ごとの勤怠状況を表示する機能  
* 勤務中や休憩中に日をまたいでも正確に勤務時間、休憩時間を計算する機能  

## 使用技術  
|アプリケーション名|バージョン|
|:---------------|:--------|
|PHP|8.2.12|
|Mysql|8.0.26|
|nginx|1.21.1|
|laravel|11.70|

## 設計したテーブル  

![[データベース設計の画像]database.png](/images/databese.png)  

## 作成したER図  

![[作成したER図]er.png](/images/er.png)  
 
# 環境構築  
Dockerで環境構築を行っている  

## 環境構築手順  
1.環境構築用のディレクトリを用意する  
2.Gitをダウンロードする  
3.以下のコマンドをコマンドプロンプトに入力する  
```
git clone https://github.com/shikanothuno/atte
```
4.Dockerをインストールし、起動する  
5.atteフォルダの中でコマンドプロンプトを開いて以下のコマンドを入力する  
```
docker compose build
```
6.srcファイルの中の.env.exampleを.envファイルとしてコピーする  
コピーには以下のコマンドを使用する  
```
cd ./src
cp .env.example .env
```
7.コピーした.envファイルの内容を以下のように書き換える  

before　　
```before
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525

```

after　　

```after
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
```

8.以下のコマンドでPHPサーバーに入る  
```
cd ../
docker compose up -d
docker compose exec php bash
```

9.以下のコマンドで必要なファイルをインストールする  
```
composer install
```

10.以下のコマンドでAPI Keyを生成する
```
php artisan key:generate
```

11.localhostにアクセスすると以下のURLに遷移する
http://localhost/login

12.以下のユーザメールとパスワードを使ってログインする
```
email:test0example.com
password:password
```

13.アプリの機能を確認する  

## ユーザー登録手順
1.新規登録画面からユーザー名、メールアドレス、パスワードを登録する  
2.確認メールの送信確認画面に遷移するので、loalhost:8025のMailHogの画面で、  
メールが届いているのを確認する  
3.メールのリンクをクリックし、メール認証を完了する  

## 開発環境と本番環境の切り分け  
### 開発環境の場合  
以下のコマンドで起動する  
```
docker compose --env-file .env.testing up -d --build
```  
また、以下のファイルに開発環境の環境設定を記述する
```
.env.testing
```
### 本番環境の場合
以下のコマンドで実行する  
```
docker compose --env-file .env.production up -d --build
```
また、以下のファイルに本番環境の環境設定を記述する  
```
.env.production
```  