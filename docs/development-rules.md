# 開発ルール

作成日: 2026-04-30

## 1. 基本方針

- 既存 WordPress と PowerPress の振る舞いを尊重する。
- テーマ側でプラグイン機能を再実装しない。
- 小さく実装し、小さく確認する。
- 実装判断はドキュメントに残す。
- 仕様変更が起きたら、コードより先に関連ドキュメントを更新する。

## 2. ディレクトリ方針

```text
docs/            設計、ルール、ログ
image/           参考画像、画像プロンプト
design_base/     デザインベースHTML、実装参考用画像素材、SVG/PNGアセット
.claude/         Claude Code 共有設定
wp-content/      実装時に作成する WordPress テーマ配置候補
```

実装コードを追加する場合は、原則として以下に作成する。

```text
wp-content/themes/kkk-podcast-template/
```

## 3. デザインベース参照ルール

`design_base/` は、コーディング時のデザイン再現と素材利用の基準資料として扱う。

- `design_base/index.html` は、画像パーツライブラリおよびデザインベース確認用HTMLとして参照する。
- `design_base/assets/svg/` は、編集可能なベクター素材の優先参照元とする。
- `design_base/assets/png/` は、SVGが使いづらい場面や確認用の等倍/高解像度参照として使う。
- 実装時にテーマへ素材を組み込む場合は、必要なものだけ `wp-content/themes/kkk-podcast-template/assets/` 配下へコピーする。
- `design_base/` の元データは参照用として保持し、テーマ実装の都合で直接書き換えない。
- 色、余白、パーツの雰囲気は `DESIGN.md` を正としつつ、具体的な見た目や素材名は `design_base/index.html` と `design_base/assets/` を確認する。
- 配信プラットフォームの実ロゴは `design_base` に含まれていないため、利用時は各公式ガイドラインを確認する。

## 4. 命名

- テーマディレクトリ: `kkk-podcast-template`
- PHP 関数 prefix: `kkk_podcast_`
- CSS custom properties prefix: `--kkk-`
- CSS class prefix: `kkk-`
- JavaScript global は原則作らない。

## 5. コーディング規約

### PHP

- WordPress Coding Standards に寄せる。
- 直接アクセス防止として各 PHP ファイル冒頭で `defined( 'ABSPATH' ) || exit;` を使う。
- 出力時は必ずエスケープする。
- 入力値は sanitize する。
- nonce が必要なフォームでは nonce を検証する。
- PowerPress 関連関数やショートコードは存在確認してから使う。

### CSS

- 色、余白、角丸、影は `DESIGN.md` の設計トークンを優先する。
- コンポーネント単位で責務を分ける。
- テキストがボタンやカードからはみ出さないようにする。
- モバイルから先に破綻を確認する。

### JavaScript

- 必要最小限にする。
- DOM 取得に失敗してもエラーにならないようにする。
- PowerPress のプレイヤー挙動に干渉しない。
- アニメーションは `prefers-reduced-motion` を尊重する。

## 6. WordPress 実装ルール

- `get_template_part()` でテンプレートパーツ化する。
- `WP_Query` を使ったら `wp_reset_postdata()` を呼ぶ。
- 外部リンクは `rel="noopener noreferrer"` を付ける。
- 管理画面で設定したURLが空の場合はリンクを表示しない。
- 投稿本文の表示には `the_content()` を基本とする。
- ショートコードを手動実行する場合は、重複表示に注意する。

## 7. PowerPress 実装ルール

- プレイヤー本体は PowerPress の出力に任せる。
- テーマ側はラッパー、余白、見出し、補助導線を提供する。
- `[powerpress]` を使う場合は `shortcode_exists( 'powerpress' )` を確認する。
- 1投稿に複数音声を持たせる設計にしない。
- プレイヤーが表示されない場合の確認観点を `docs/development-log.md` に記録する。

## 8. Gitルール

- `main` は常に安定状態にする。
- 作業ブランチ名は `docs/...` または `feature/...` を使う。
- コミットは意味のある単位で分ける。
- コミットメッセージ例:
  - `docs: add project requirements`
  - `docs: add design guidelines`
  - `feat: add podcast theme scaffold`
  - `fix: guard powerpress player rendering`

## 9. レビュー観点

- 要件にない表示や導線を追加していないか。
- `design_base/` のデザイン意図と大きくズレていないか。
- PowerPress の出力を壊していないか。
- スマートフォンで操作しやすいか。
- WordPress のエスケープが漏れていないか。
- 未設定のリンクが空リンクになっていないか。

## 10. 報告ルール

開発者または Claude Code は、まとまった作業ごとに `docs/development-log.md` に以下を残す。

- 日付
- 作業者
- 作業内容
- 変更ファイル
- 確認したこと
- 未確認または次回課題
