# Atte				
				
Atteは、企業向けの勤怠管理システムです。社員の勤務時間を効率的に管理し、人事評価に活用することを目的としています。				
				
## アプリケーションURL				
				
- 開発環境：http://localhost/				
- phpMyAdmin：http://localhost:8080/				
				
## 環境構築				
				
1. リポジトリをクローン				
```bash				
git clone <リポジトリのURL>				
cd <リポジトリ名>				
```				
2. Dockerコンテナのビルド				
```bash				
docker-compose up -d --build				
```				
3. コンテナに入る				
```bash				
docker-compose exec php bash				
```				
4. パッケージをインストール				
```bash				
composer install				
```				
5. 環境ファイルを設定				
```bash				
cp .env.example .env				
php artisan key:generate				
```				
※環境変数を必要に応じて変更してください				
6. データベースのマイグレーションとシーディング				
```bash				
php artisan migrate --seed				
```						
## 使用技術(実行環境)				
				
- PHP: 7.4.9				
- Nginx: 1.21.1				
- Laravel: 8.75				
- MySQL: 8.0.26				
				
## ER図				
				
<img width="645" alt="ER図" src="https://github.com/user-attachments/assets/ad70f65c-da6d-4e10-983e-8a0dc0e9389f">				
				
## テストアカウント
- mail ; k@gmail.com
- pass ; Kizuna2850

## 機能一覧				
				
1. 会員登録				
- Laravelの認証機能を利用				
				
2. ログイン/ログアウト				
				
3. 勤務管理				
- 勤務開始				
- 日を跨いだ時点で翌日の出勤操作に切り替える				
- 勤務終了				
- 休憩開始				
- 1日で何度も休憩が可能				
- 休憩終了				
				
4. 日付別勤怠情報取得				
- ページネーション（5件ずつ取得）				
				
## 主要ページ				
				
- `/` : 打刻ページ				
- `/register` : 会員登録ページ				
- `/login` : ログインページ				
- `/attendance` : 日付別勤怠ページ				
				
