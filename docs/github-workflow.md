# GitHub運用

作成日: 2026-04-30  
対象リポジトリ: `activefactor/podcast-wp-templete-for-kkk`

## 1. 現状

GitHub 上の対象リポジトリは存在する。2026-04-30 時点の確認では、現在の接続権限は pull のみで、push 権限は確認できていない。

## 2. 初期登録方針

ローカル側:

```bash
git init
git branch -M main
git remote add origin https://github.com/activefactor/podcast-wp-templete-for-kkk.git
git add .
git commit -m "docs: add initial project documentation"
git push -u origin main
```

push が拒否された場合:

- GitHub 側で `activefactor/podcast-wp-templete-for-kkk` への write 権限を付与する。
- または、書き込み可能な fork に push して Pull Request を作成する。
- 既存リポジトリが空でない場合は、先に `git pull --rebase origin main` を検討する。

## 3. ブランチ運用

- `main`: 安定版
- `docs/*`: ドキュメント作業
- `feature/*`: 実装作業
- `fix/*`: 不具合修正

## 4. コミット粒度

推奨:

- ドキュメント追加
- テーマ土台追加
- トップページ追加
- PowerPress 連携追加
- スタイル調整
- セキュリティ修正

避ける:

- 大量の無関係変更を1コミットにまとめる
- 生成物と手書きコードを理由なく混在させる
- 秘密情報を含むファイルを含める

## 5. PR方針

PR本文には以下を記載する。

- 目的
- 変更内容
- 確認したこと
- 未確認事項
- スクリーンショットまたは確認URL

## 6. Issue方針

Issue化するもの:

- 未決事項
- 仕様変更
- バグ
- デザイン確認
- PowerPress 連携の検証事項

## 7. 初回登録チェックリスト

- [ ] `.gitignore` がある。
- [ ] 秘密情報が含まれていない。
- [ ] `README.md` がある。
- [ ] ドキュメントが揃っている。
- [ ] remote URL が正しい。
- [ ] push 権限がある。

