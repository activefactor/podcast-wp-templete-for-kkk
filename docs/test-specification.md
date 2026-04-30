# テスト仕様書

作成日: 2026-04-30  
対象: `wp-content/themes/kkk-podcast-template/`  
目的: Claude Code が作成した WordPress テーマコードについて、開発ルール準拠、セキュリティポリシー準拠、脆弱性リスクを確認する。

## 1. テスト範囲

### 対象

- WordPress テーマ PHP ファイル
- テンプレートパーツ
- CSS
- JavaScript
- テーマ内画像/SVG
- Claude Code 用設定
- 関連ドキュメントとの差分

### 対象外

- 本番 WordPress 管理画面での動作確認
- PowerPress 実プラグインを有効化したブラウザ確認
- 実音声ファイル再生確認
- Lighthouse 実測
- 配信プラットフォーム正式ロゴの利用規約確認

## 2. 前提

- ローカルに WordPress 実行環境はない前提で、静的検査を中心に行う。
- 実行可能なコマンドがある場合は `php -l` などの構文チェックを行う。
- 実行できない確認項目は、未実施理由と残リスクを報告書に残す。

## 3. テスト項目

| ID | 区分 | 観点 | 確認方法 | 合格基準 |
| --- | --- | --- | --- | --- |
| T-01 | 構成 | テーマファイル配置 | `rg --files` | `docs/basic-design.md` の想定構成に沿う |
| T-02 | PHP | 構文エラー | `php -l` | 全PHPファイルが syntax error なし |
| T-03 | PHP | 直接アクセス防止 | 静的確認 | PHPファイル冒頭で `defined( 'ABSPATH' ) || exit;` 相当を使用 |
| T-04 | PHP | 命名規約 | 静的確認 | 独自関数が `kkk_podcast_` prefix を使用 |
| T-05 | PHP | 出力エスケープ | 静的確認 | 動的テキスト/URL/属性が `esc_*` 等で処理される |
| T-06 | PHP | 入力サニタイズ | 静的確認 | `$_GET`, `$_POST`, `$_REQUEST`, `$_COOKIE` の直接利用がない、または sanitize 済み |
| T-07 | PHP | SQL安全性 | 静的確認 | 生SQLや文字列連結SQLがない |
| T-08 | PHP | 危険関数 | 静的確認 | `eval`, `shell_exec`, `exec`, `system`, `passthru` などを使わない |
| T-09 | WordPress | enqueue | 静的確認 | CSS/JS は `wp_enqueue_scripts` で読み込む |
| T-10 | WordPress | クエリ後処理 | 静的確認 | 独自 `WP_Query` 後に `wp_reset_postdata()` を呼ぶ |
| T-11 | PowerPress | 連携安全性 | 静的確認 | `[powerpress]` 利用前に `shortcode_exists()` 等で存在確認する |
| T-12 | PowerPress | 非再実装 | 静的確認 | プレイヤー本体をテーマ側で自作しない |
| T-13 | 外部リンク | noopener | 静的確認 | `target="_blank"` に `rel="noopener noreferrer"` を付ける |
| T-14 | 秘密情報 | secret混入 | `rg` | APIキー、token、password、`.env` 等が含まれない |
| T-15 | ファイル管理 | 禁止ファイル | `rg --files` | `.env`, `wp-config.php`, DB dump, uploads 実体などが含まれない |
| T-16 | JS | DOM安全性 | 静的確認 | DOM未存在でもエラーにならない |
| T-17 | JS | 危険API | 静的確認 | 不要な `innerHTML`、外部通信、eval系APIがない |
| T-18 | CSS | 設計トークン | 静的確認 | `DESIGN.md` / `design_base` の方向性から大きく外れない |
| T-19 | CSS | アクセシビリティ | 静的確認 | focus, responsive, reduced-motion 等に配慮がある |
| T-20 | SVG | スクリプト混入 | `rg` | SVG内に `<script>` や外部参照がない |
| T-21 | ドキュメント | 開発ログ | 静的確認 | 実装/検査内容が `docs/development-log.md` に追記される |

## 4. 重大度

- Critical: 直ちに修正が必要。認証情報漏えい、RCE、SQL injection、XSS 直結。
- High: 本番公開前に必ず修正。エスケープ漏れ、外部リンク安全属性漏れ、PowerPress fatal error 可能性。
- Medium: 修正推奨。規約逸脱、アクセシビリティ低下、保守性問題。
- Low: 影響は小さいが改善余地あり。

## 5. 報告形式

テスト後に `docs/test-report.md` を作成し、以下を記録する。

- 実施日
- 対象コミット/作業ツリー状態
- 実施コマンド
- テスト結果一覧
- 指摘事項
- セキュリティ評価
- 未実施項目と残リスク
- 次の推奨アクション

