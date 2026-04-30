# 基本設計書

作成日: 2026-04-30  
対象: K and K Knight Podcast WordPress デザインテンプレート

## 1. 全体方針

既存の WordPress 投稿資産と Blubrry PowerPress を活かし、トップページを Podcast LP として再構成する。テーマ側は「番組を理解する」「最新回を聴く」「過去回を探す」「購読する」の4つの行動を支援する。

## 2. システム構成

```text
WordPress
  ├─ 投稿: Podcast エピソード
  ├─ カテゴリー: Web / Gadget / Education / FreeTalk など
  ├─ 固定ページ: About / Contact など
  ├─ Plugin: Blubrry PowerPress
  └─ Theme: kkk-podcast-template
```

## 3. 想定テーマ構成

```text
wp-content/themes/kkk-podcast-template/
  ├─ style.css
  ├─ functions.php
  ├─ front-page.php
  ├─ home.php
  ├─ single.php
  ├─ archive.php
  ├─ category.php
  ├─ page.php
  ├─ header.php
  ├─ footer.php
  ├─ template-parts/
  │  ├─ hero.php
  │  ├─ episode-card.php
  │  ├─ powerpress-player.php
  │  ├─ topic-list.php
  │  ├─ host-list.php
  │  └─ listen-links.php
  └─ assets/
     ├─ css/
     ├─ js/
     └─ images/
```

## 4. 画面設計

### 4.1 トップページ

構成:

1. Header
2. Hero
3. 最新エピソード
4. Topics
5. Hosts
6. Listen Platforms
7. Footer

Hero 要素:

- 番組名
- キャッチコピー
- 最新回を聴く CTA
- エピソード一覧 CTA
- マイク、波形、ガジェットのビジュアル
- 最新回プレイヤーまたは最新回カード

### 4.2 エピソード一覧

- 一覧タイトル
- カテゴリナビゲーション
- エピソードカードグリッド
- ページネーション

### 4.3 個別回

- タイトル
- メタ情報
- PowerPress プレイヤー
- 本文
- 参照リンク
- 前後回リンク
- 関連回

### 4.4 About

- 番組説明
- 主なテーマ
- ホスト紹介
- 継続配信の説明

## 5. データ設計

### 投稿

| 項目 | 利用方法 |
| --- | --- |
| post_title | エピソードタイトル |
| post_date | 公開日 |
| post_excerpt | カード概要。未入力時は本文抜粋 |
| post_content | 詳細本文、Show Notes |
| category | Topic 分類 |
| featured_image | カード画像。未設定時はカテゴリ別プレースホルダー |
| PowerPress metadata | 音声ファイル、再生時間、プレイヤー |

### テーマ設定候補

- Apple Podcasts URL
- Spotify URL
- RSS URL
- YouTube URL
- Amazon Music URL
- Contact URL
- Hero コピー
- ホスト紹介文

## 6. PowerPress 連携設計

PowerPress は WordPress.org の情報では PowerPress Player ブロックを提供し、投稿内では `[powerpress]` ショートコードでもプレイヤーを挿入できる。

設計方針:

- 投稿本文に PowerPress ブロックまたはショートコードがある場合はその出力を優先する。
- テンプレート側で明示表示する必要がある場合のみ、専用パーツ `template-parts/powerpress-player.php` で扱う。
- プレイヤー周辺の余白、角丸、背景はテーマ側で整えるが、再生 UI 自体は PowerPress の出力を壊さない。
- PowerPress が無効の状態でもテーマが fatal error にならないようにする。

テンプレート方針:

```php
if ( shortcode_exists( 'powerpress' ) ) {
    echo do_shortcode( '[powerpress]' );
}
```

実装時は出力コンテキストと WordPress Coding Standards に従って安全性を確認する。

## 7. CSS設計

- `assets/css/global.css`: リセット、ベース、トークン
- `assets/css/components.css`: ボタン、カード、プレイヤー枠、チップ
- `assets/css/templates.css`: Hero、一覧、個別回

設計トークンは `DESIGN.md` を正とする。

## 8. JavaScript設計

最小限にする。

想定機能:

- モバイルナビゲーション
- カテゴリフィルタの補助
- 音声波形の装飾アニメーション

PowerPress の再生機能はプラグインに委ねる。

## 9. WordPress実装方針

- `functions.php` で theme support を定義する。
- `wp_enqueue_scripts` で CSS/JS を読み込む。
- `WP_Query` は必要箇所に限定する。
- 出力は `esc_html()`, `esc_url()`, `esc_attr()`, `wp_kses_post()` を使い分ける。
- 管理画面カスタマイズは初期実装では最小限にする。

## 10. テスト観点

- テーマ有効化時の PHP エラーなし
- PowerPress 有効/無効の両状態
- 最新回が存在する/存在しない状態
- アイキャッチあり/なし
- 外部リンク設定あり/なし
- スマートフォン幅 390px
- デスクトップ幅 1440px

