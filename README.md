<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# LaraNext-server バックエンド

LaraNextとは`Laravel`の学習用プロジェクトになります。  
このプロジェクトの立ち上げ方法、バージョン等を以下記載しますので参考程度にご覧ください。  

## 環境

### 事前準備

- PC (OSはWindows、Mac、Linuxどれでも良い)
※ Windowsの場合`WSL2`を導入してください。  

- Git
- Githubのアカウント
- VSCode（PHPStormやWebStorm等でも良いが今回はサポートはしません。）
- Docker

### 開発

インフラ    : `Docker`、`MySQL`、`NGINX`  
使用FW      : `Laravel 8`  
使用言語    : `PHP 8`

## プロジェクト構成

LaraNext-server
- app
    - Console
    自分で`Artisan commands`をつくれるところ

    - Exceptions
    例外処理を置いておくところ。
    「どうやってログを吐くか、レンダリングをするか」といったことをカスタマイズしたいのであればこのクラスの`Handle`クラスをいじればいい

    - Http
    コントローラ、ミドルウェア、フォームリクエストなどをおくところ。
    アプリケーションへのリクエスト処理に関するほとんどのロジックがこのディレクトリに含まれる。

    - Models
    モデルを定義したファイルを置くところ。

    - Providers
    アプリケーションの中の全てのサービスプロバイダがここにくる。
    サービスコンテナ、登録したイベント、リクエストに対するタスクをbindingして実行してくれる

- bootstrap
    - chache
    - app.php
- config
    - 各種設定
- database
    - データベース回り
- public
    - web設定
- resources
    - 見た目回り
- routes
    - ルーティング
- storage
    - セッション等のストレージ
- tests
    - テスト
- vender
    - パッケージ等
README.md

### app
アプリケーション根幹部分の処理群    
  
### bootstrap
フレームワークの初期化を行い、autoloadingを設定するファイル群が配置される。
また、フレームワークが作り出すキャッシュファイルを貯めたりもする。

### config

アプリケーションの設定ファイルをおくディレクトリ。

### database

データベースのマイグレーションやシードを配置するディレクトリ。

### public

アプリケーションに送られる、全てのリクエストのエントリーポイントとなる`index.php`ファイルが配置されているディレクトリ。
ここには他に画像、JS、CSSといったものを置いたりする。

### resources

見た目に関するいわゆるViewに当たるものを配置するディレクトリ。
他にもi18nで用いられる言語ファイル等も配置する。

### routes

アプリケーションの全てのルートを定義するディレクトリ。
デフォルトでは 

- web.php
- api.php
- console.php
- channels.php

といったルートファイルを用意してある。

### storage

Bladeテンプレートをコンパイルしたものやセッションのファイル、キャッシュファイル、その他フレームワークが作り出したファイル等が配置されるディレクトリ。

ディレクトリは

- app
- framework
- logs

の３つに分かれている。

### tests

PHPUnit みたいな自動テストを置くためのディレクトリ。
全てのクラスには`Test`を接尾辞につけないといけない。

テストを走らせるには`phpunit`コマンドか`php vendor/bin/phpunit`かを使う。

### vender

`Composer`の依存内容をおくところ。

## プロジェクト立ち上げ方法

※ Windowsの場合は必ず`WSL2`からコマンド実行してください。
PowerShellやCMDではLinuxコマンドがまともに使えない為一部実行できなかったりします。

### 最初の一回だけ行う

Laravel Sailコマンドをエイリアスに登録することをLaravelで推奨されているので登録する

1. vimでbashの設定ファイルを開く
```bash
$ vim ~/.bashrc
```

![openBashrc](Docs\img\openBashrc.png "openBashrc")

2. このように開いたら`alias`と記載の場所までスクロールを行う。
3. 見つけたらキーボードの`i`を押す。

![vimInsertMode](Docs\img\vimInsertMode.png "vimInsertMode")

3. Insertと表示されることで入力モードになるので

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

と追記する。

4. キーボードの`esc`を押して入力モードを解除する。

![vimEsc](Docs\img\vimEsc.png "vimEsc")

このように追記したものがある、かつInsertが消えていることを確認する

5. キーボードの`:`を押す

![coronVim](Docs\img\coronVim.png "coronVim")

6. `wq`と入力しキーボードの`Enter`を押す

元の画面に戻っているのを確認。

7. 先ほどの設定を適用する

```bash
$ source ~/.bashrc
```

これで完了です。

### 実行する

Git Cloneする

```bash
$ git clone https://github.com/RimlTempest/LaraNext-server
```

作業スペースに移動する
```bash
$ cd LaraNext-server/
```

起動する
```bash
$ sail up
```

バックグラウンド起動する
```bash
$ sail up -d
```

終了する  
`ctrl + c`


## コマンド一覧

sailを起動する
```bash
sail up	
```

バックグラウンドでsailを起動する
```bash
sail up -d	
```

sailをシャットダウンする
```bash
sail down	
```

sailを停止する
```bash
sail stop	
```

PHP実行コンテナにsailユーザーでログインする
```bash
sail shell	
```

PHP実行コンテナにrootでログインする
```bash
sail root-shell	
```

composerコマンドを実行する
```bash
sail composer	
```

artisanコマンドを実行する
```bash
sail artisan	
```

npmコマンドを実行する
```bash
sail npm	
```

nodeコマンドを実行する
```bash
sail node	
```

PHPUnitのテスト実行
```bash
sail test	
```

PHPUnitのテストのオプションも指定できる
```bash
sail test --group orders	
```

## デバックURL

Laravelアプリケーション  
http://localhost  
  
phpMyAdmin  
http://localhost:8080  
  
MailHog	 
http://localhost:8025  
  
RedisInsight  
http://localhost:8001  
  

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 参考
[Laravelとは](https://www.acrovision.jp/career/?p=2776)  
[Laravel Sail](https://readouble.com/laravel/8.x/ja/sail.html)  
[Laravelのディレクトリ構造](https://qiita.com/shosho/items/93cbff79376c41c3a30b)  
[Laravel Sail使い方](https://monmon.jp/483/using-a-built-in-sail-docker-container-to-install-larva8-the-development-environment-can-be-created-in-a-flash/#phpMyAdmin)  
[Laravel SailでDocker環境構築](https://zenn.dev/yamabiko/articles/laravel-sail-docker#%E3%81%BE%E3%81%A8%E3%82%81)  
[Laravel なんちゃってクリーンアーキテクチャ](https://zenn.dev/mpyw/articles/ce7d09eb6d8117)  