# テスト結果報告書

作成日: 2026-04-30  
対象: `wp-content/themes/kkk-podcast-template/`  
仕様書: `docs/test-specification.md`

## 1. 結論

Claude Code が作成したテーマコードは、全体として WordPress テーマ構成、PowerPress 連携方針、危険関数不使用、秘密情報非混入、外部リンク安全属性について大きな問題は見つからなかった。

ただし、開発ルールおよびセキュリティポリシーの「出力はエスケープする」に対して、`the_title()`, `bloginfo()`, `the_archive_title()`, `the_archive_description()` の直接出力が残っている。即時のCritical脆弱性とは判断しないが、本番公開前に修正推奨。

## 2. 対象状態

- ブランチ: `main`
- 最新追跡コミット: `fb77f10 docs: add design base references`
- 作業ツリー状態:
  - `docs/development-log.md` に既存の未コミット変更あり
  - `wp-content/` は未追跡として存在
  - 本テストで `docs/test-specification.md` と `docs/test-report.md` を追加

## 3. 実施コマンド

```bash
rg --files
git status --short
sed -n '1,260p' docs/development-rules.md
sed -n '1,260p' docs/security-policy.md
sed -n '1,260p' wp-content/themes/kkk-podcast-template/functions.php
sed -n '1,300p' wp-content/themes/kkk-podcast-template/single.php
sed -n '1,260p' wp-content/themes/kkk-podcast-template/template-parts/*.php
for file in $(rg --files wp-content/themes/kkk-podcast-template -g '*.php'); do php -l "$file"; done
rg -n "\b(eval|exec|shell_exec|system|passthru|proc_open|popen|assert|base64_decode)\s*\(" wp-content/themes/kkk-podcast-template
rg -n "\$_(GET|POST|REQUEST|COOKIE|SERVER|FILES)|wpdb|SELECT |INSERT |UPDATE |DELETE |dbDelta" wp-content/themes/kkk-podcast-template
rg -n "target=\"_blank\"" wp-content/themes/kkk-podcast-template
rg -n "the_title\(|the_archive_title\(|the_archive_description\(|bloginfo\(" wp-content/themes/kkk-podcast-template -g '*.php'
rg -n "<script|javascript:|onload=|onerror=|href=\"https?://|xlink:href=\"https?://" wp-content/themes/kkk-podcast-template/assets/img design_base/assets/svg
rg --files --hidden -g '.env' -g '.env.*' -g 'wp-config.php' -g '*.sql' -g '*.sql.gz' -g 'secrets/**' -g 'node_modules/**' -g 'vendor/**' -g 'wp-content/uploads/**' -g 'wp-content/backups/**' -g '!.git/**'
```

## 4. テスト結果一覧

| ID | 結果 | 内容 |
| --- | --- | --- |
| T-01 | Pass | テーマ構成は `docs/basic-design.md` の想定に概ね一致。 |
| T-02 | Not Run | `php` コマンドがローカルに存在しないため `php -l` は未実施。 |
| T-03 | Pass | 全PHPファイルに `defined( 'ABSPATH' ) || exit;` を確認。 |
| T-04 | Pass | 独自関数は `kkk_podcast_` prefix を使用。 |
| T-05 | Warning | 一部テンプレートタグの直接出力が残る。詳細は指摘事項 F-01, F-02, F-03。 |
| T-06 | Pass | `$_GET`, `$_POST`, `$_REQUEST`, `$_COOKIE` の直接利用なし。 |
| T-07 | Pass | 生SQL、`$wpdb`、文字列連結SQLなし。 |
| T-08 | Pass | `eval`, `exec`, `shell_exec`, `system`, `passthru` 等の危険関数なし。 |
| T-09 | Pass | CSS/JS は `wp_enqueue_scripts` で読み込み。 |
| T-10 | Pass | `WP_Query` 後に `wp_reset_postdata()` を確認。 |
| T-11 | Pass | `[powerpress]` 実行前に `shortcode_exists( 'powerpress' )` を確認。 |
| T-12 | Pass | PowerPress プレイヤー本体の自作なし。 |
| T-13 | Pass | `target="_blank"` には `rel="noopener noreferrer"` を確認。 |
| T-14 | Pass | 秘密情報らしき実値なし。ドキュメント内の説明語のみ検出。 |
| T-15 | Pass | `.env`, `wp-config.php`, DB dump, uploads 実体などは禁止ファイルなし。 |
| T-16 | Pass | JS は対象要素がない場合に return し、DOM未存在で落ちない。 |
| T-17 | Pass | `innerHTML`, `eval`, 外部通信APIなどの危険APIなし。 |
| T-18 | Warning | 設計トークンは使用されているが、`letter-spacing: -0.01em` など `DESIGN.md` との軽微なズレあり。 |
| T-19 | Pass | skip link, `:focus-visible`, `prefers-reduced-motion`, 44px以上のタップ領域を確認。 |
| T-20 | Pass | テーマ内SVGと `design_base/assets/svg` に `<script>` や外部参照なし。 |
| T-21 | Pass | 本検査の実施内容を `docs/development-log.md` に追記済み。 |

## 5. 指摘事項

### F-01: 投稿/固定ページタイトルの直接出力

重大度: Medium  
対象:

- `wp-content/themes/kkk-podcast-template/page.php:14`
- `wp-content/themes/kkk-podcast-template/single.php:30`

内容:

`the_title()` が直接出力されている。WordPress の通常運用では投稿タイトルは管理権限のあるユーザーが扱うため即時Criticalではないが、プロジェクトのセキュリティポリシーでは「出力はエスケープする」と定義されている。

推奨修正:

```php
<?php echo esc_html( get_the_title() ); ?>
```

### F-02: サイト名の直接出力

重大度: Medium  
対象:

- `wp-content/themes/kkk-podcast-template/header.php:26`
- `wp-content/themes/kkk-podcast-template/footer.php:26`
- `wp-content/themes/kkk-podcast-template/footer.php:72`

内容:

`bloginfo( 'name' )` が属性値またはHTML本文へ直接出力されている。管理画面から変更できる値のため、コンテキストに応じて `esc_attr()` または `esc_html()` を使うべき。

推奨修正:

```php
alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
```

### F-03: アーカイブタイトル/説明の直接出力

重大度: Low-Medium  
対象:

- `wp-content/themes/kkk-podcast-template/archive.php:12`
- `wp-content/themes/kkk-podcast-template/archive.php:14`

内容:

`the_archive_title()` と `the_archive_description()` が直接出力されている。WordPress標準の表示関数ではあるが、プロジェクト方針としては表示コンテキストに応じた明示的なエスケープまたは `wp_kses_post()` を使う方が安全。

推奨修正:

- タイトルは `echo esc_html( get_the_archive_title() );`
- 説明文は許可HTMLが必要なら `wp_kses_post( get_the_archive_description() )`

### F-04: PHP構文チェック未実施

重大度: Medium  
対象: 全PHPファイル

内容:

ローカル環境に `php` コマンドが存在しないため、`php -l` による構文チェックを実施できなかった。

推奨対応:

- PHP CLI を利用できる環境で `php -l` を実行する。
- 可能なら WordPress Coding Standards / PHP_CodeSniffer も導入する。

### F-05: デザインルールとの軽微なズレ

重大度: Low  
対象:

- `wp-content/themes/kkk-podcast-template/assets/css/global.css`
- `wp-content/themes/kkk-podcast-template/assets/css/templates.css`

内容:

`DESIGN.md` では文字間隔は原則 `0` としているが、見出し等に `letter-spacing: -0.01em` が設定されている。また、参考ビジュアルは白基調のファーストビューだが、実装Heroは濃紺背景で、ビジュアル方向性にやや差がある。

推奨対応:

- `letter-spacing` を `0` に統一する。
- Hero背景の方向性はデザイン判断として採用するか、`DESIGN.md` に例外として記録する。

## 6. セキュリティ評価

現時点で以下は問題なし。

- 秘密情報の混入なし。
- `.env`, `wp-config.php`, DB dump, uploads 実体なし。
- 危険関数なし。
- 生SQLなし。
- ユーザー入力スーパーグローバルの直接利用なし。
- 外部通信JSなし。
- SVG内スクリプトなし。
- PowerPress は存在確認後にショートコード実行しており、無効時にも fatal error にならない。

注意点:

- `do_shortcode( '[powerpress]' )` の出力はPowerPressプラグインに委ねるため、テーマ側でHTMLエスケープするとプレイヤーが壊れる。PowerPress公式プラグインを最新版で使う運用が前提。
- `the_content()` は投稿本文を表示するWordPress標準導線として許容。ただし投稿編集権限を持つユーザー管理はWordPress側の運用で担保する。

## 7. 開発ルール準拠評価

概ね準拠:

- テーマ配置は `wp-content/themes/kkk-podcast-template/`。
- 独自関数prefixは `kkk_podcast_`。
- CSS class prefixは `kkk-`。
- `get_template_part()` でテンプレートパーツ化。
- PowerPress のプレイヤー本体は再実装していない。
- `design_base/assets/svg/` 由来の素材をテーマ配下に取り込んでいる。

要改善:

- 一部出力の明示的エスケープ。
- `DESIGN.md` の `letter-spacing: 0` ルールとの整合。
- 構文チェック環境の整備。

## 8. 未実施項目と残リスク

- PHP CLI がないため `php -l` 未実施。
- WordPress 実行環境がないため、テーマ有効化時の fatal error 確認は未実施。
- PowerPress 実プラグイン有効状態での表示確認は未実施。
- ブラウザでのレスポンシブ確認、Lighthouse確認は未実施。
- WordPress Coding Standards による自動検査は未実施。

## 9. 次の推奨アクション

1. F-01からF-03の出力エスケープを修正する。
2. PHP CLI またはDocker/Local環境で `php -l` を実行する。
3. WordPress + PowerPress のローカル環境でテーマ有効化、トップ、一覧、個別回を確認する。
4. `DESIGN.md` と実装Heroの方向性差分を、デザイン判断として維持するか修正するか決める。
