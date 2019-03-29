# gitblog 

## overview
markdownで書かれたblog記事をGitで管理する

## description
有用なブログサービスがたくさんある中、独自のブログサービスを構築、運用しようと考えました。
気軽に記事を書くために、Markdown記法を用ることにし、その管理にGitを利用します。
gitblogでは記事データを一時的に保存するだけで、永続的な保存にはリモートリポジトリ(githubなど)を利用します。これは、gitblogの運用が続けられないような状況に陥った場合でも記事データを容易に守れるようにするためです。

## requirement
- php7
- composer

## Usage
リポジトリをクローンし、パッケージのインストール、設定ファイルの編集、API KEYの生成、マイグレーションを行い使用することができます。
```
$ git clone https://github.com/ophum/gitblog
$ cd gitblog
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate
```

### Built in web server (test)
開発においてビルトインウェブサーバを使用するとよいかもしれません。本番環境で使用することは非推奨です。
```
$ php artisan serve
```

## contributing
### 手順
1. Fork
2. branchを切る (git checkout -b my-new-feature)
3. commitする (git commit -am 'Add some feature')
4. branchをpushする (git push origin my-new-feature)
5. pull requestを作成する 

## Author
[hum_op](https://github.com/ophum)