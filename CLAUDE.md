# CLAUDE.md

このプロジェクトは、K and K Knight Podcast の WordPress デザインテンプレートを制作するためのリポジトリです。

## 最初に読むファイル

1. `README.md`
2. `docs/requirements.md`
3. `docs/basic-design.md`
4. `DESIGN.md`
5. `docs/development-rules.md`
6. `docs/security-policy.md`

## 守ること

- WordPress と Blubrry PowerPress の標準機能を尊重する。
- PowerPress プレイヤーを自作しない。
- テーマ側ではプレイヤーのラッパーと見た目の調整に留める。
- PHP 出力は必ずエスケープする。
- `.env`、`wp-config.php`、秘密情報を読まない、編集しない、コミットしない。
- 実装判断や未確認事項は `docs/development-log.md` に残す。
- 画像生成やプロンプト変更を行った場合は `docs/prompt-log.md` に残す。

## 実装時の想定場所

```text
wp-content/themes/kkk-podcast-template/
```

## デザイン方針

- 白基調、濃紺、シアン、ライムの配色を使う。
- マイク、波形、ガジェット、コードのモチーフを使う。
- 実在人物の顔写真風イラストは使わない。
- Hero は番組名、最新回、視聴CTAがすぐ分かる構成にする。

## PowerPress 方針

- 投稿本文内の PowerPress Player ブロックまたは `[powerpress]` を優先する。
- テンプレートから表示する場合は `shortcode_exists( 'powerpress' )` を確認する。
- PowerPress が無効でもテーマが落ちないようにする。

## 報告形式

作業後は以下を簡潔に報告する。

- 変更内容
- 変更ファイル
- 確認したこと
- 未確認事項

必要に応じて `docs/development-log.md` に追記する。

