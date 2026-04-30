# DESIGN.md

作成日: 2026-04-30  
対象: K and K Knight Podcast WordPress デザインテンプレート

## 1. デザインコンセプト

Web制作、ガジェット、教育ICT、AIを語る Podcast として、知的でクリーン、でも堅すぎない雰囲気を目指す。

参考ビジュアルの方向性:

- 白基調の明るい画面
- 濃紺の強いタイポグラフィ
- シアンとライムのアクセント
- マイク、ヘッドホン、PC、スマートフォン、コード、波形のモチーフ
- 最新回カード、トピック、ホスト、視聴方法が一画面で見える構成

## 2. ブランド印象

- 専門的
- 親しみやすい
- 継続感がある
- 教育と制作現場に近い
- ガジェット好きの軽やかさがある

## 3. カラートークン

```css
:root {
  --kkk-color-navy-900: #061747;
  --kkk-color-navy-800: #0a225f;
  --kkk-color-blue-500: #00a7e8;
  --kkk-color-cyan-400: #19d5e8;
  --kkk-color-lime-400: #c8ff2e;
  --kkk-color-white: #ffffff;
  --kkk-color-surface: #f7fbff;
  --kkk-color-border: #d8e4f2;
  --kkk-color-text: #071746;
  --kkk-color-muted: #61708f;
  --kkk-color-danger: #d92d20;
}
```

使用比率:

- White / Surface: 70%
- Navy: 20%
- Cyan / Blue: 7%
- Lime: 3%

## 4. タイポグラフィ

推奨:

```css
font-family:
  "Noto Sans JP",
  "Hiragino Kaku Gothic ProN",
  "Yu Gothic",
  system-ui,
  sans-serif;
```

サイズ目安:

| 用途 | Desktop | Mobile |
| --- | --- | --- |
| Hero title | 72px | 40px |
| Section title | 28px | 24px |
| Card title | 18px | 16px |
| Body | 16px | 16px |
| Caption | 13px | 12px |

注意:

- 文字間隔は原則 `0`。
- Hero 以外で過度に大きい文字を使わない。
- 日本語がボタン内で詰まる場合は改行を許容する。

## 5. レイアウト

最大幅:

```css
--kkk-layout-max: 1180px;
--kkk-layout-gutter: clamp(20px, 4vw, 48px);
```

ブレイクポイント:

```css
--kkk-bp-sm: 480px;
--kkk-bp-md: 768px;
--kkk-bp-lg: 1024px;
--kkk-bp-xl: 1280px;
```

## 6. 余白

```css
--kkk-space-1: 4px;
--kkk-space-2: 8px;
--kkk-space-3: 12px;
--kkk-space-4: 16px;
--kkk-space-5: 24px;
--kkk-space-6: 32px;
--kkk-space-7: 48px;
--kkk-space-8: 64px;
--kkk-space-9: 96px;
```

## 7. 角丸と影

```css
--kkk-radius-sm: 6px;
--kkk-radius-md: 8px;
--kkk-radius-lg: 16px;
--kkk-shadow-card: 0 14px 40px rgba(6, 23, 71, 0.10);
--kkk-shadow-button: 0 12px 24px rgba(6, 23, 71, 0.18);
```

カードは原則 8px まで。Hero のマイク画像や丸い再生ボタンなど、意味のある形状のみ大きな丸みを許容する。

## 8. コンポーネント

### Header

- 左にロゴ/番組名
- 右にナビゲーション
- 最後に「フォローする」CTA
- モバイルではメニューボタンに畳む

### Hero

- 左に番組名、コピー、CTA、波形
- 右にマイクとガジェットのビジュアル
- 下端に最新回カードが少し見える構成

### Episode Card

- アイキャッチまたはカテゴリ別ビジュアル
- 回数、タイトル、日付、再生時間
- 小さな再生アイコン
- カード全体をリンク化

### PowerPress Player

- プレイヤーは濃紺や白のコンテナ内に配置
- PowerPress の操作UIは上書きしすぎない
- 余白と見出しでページ内の意味を補助する

### Topic Chip

- Webデザイン
- ガジェット
- 教育テクノロジー
- AI
- ゆるい雑談

## 9. アイコン・画像

- マイク、再生、RSS、検索、メニュー、外部リンクはアイコン化する。
- 実在人物の顔写真風生成画像は使わない。
- ホストは抽象アイコン、イニシャル、または本人提供素材を使う。
- プラットフォームロゴは公式利用規約に沿う。未確認時はテキストリンクまたは汎用アイコンにする。

## 10. アクセシビリティ

- フォーカスリングを消さない。
- ボタンの最小タップ領域は 44px。
- CTA は色だけでなくテキストでも意味を伝える。
- 波形や装飾アニメーションは `aria-hidden="true"` にする。
- `prefers-reduced-motion` ではアニメーションを停止または簡略化する。

## 11. 禁止表現

- 汎用的な企業LPのような抽象グラデーションだけのHero
- 実在ホストに似せた顔画像生成
- 文字が重なる装飾
- 読めない日本語テキスト
- カードの中にカードを入れた過剰な構造
- PowerPress プレイヤーの操作部を壊すCSS

