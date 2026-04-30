<?php
defined( 'ABSPATH' ) || exit;

$tagline = get_theme_mod(
	'kkk_podcast_hero_tagline',
	'Web・ガジェット・教育ICT・AI——毎週木曜、本音でお届け。'
);

$latest = kkk_podcast_get_latest_post();
$img_uri = get_template_directory_uri() . '/assets/img/';
?>

<section class="kkk-hero" aria-label="<?php esc_attr_e( 'ヒーロー', 'kkk-podcast-template' ); ?>">
	<div class="kkk-container">
		<div class="kkk-hero__inner">

			<div class="kkk-hero__content">
				<span class="kkk-hero__eyebrow" aria-hidden="true">
					&#9654;&#9;Podcast
				</span>

				<h1 class="kkk-hero__title">
					K and K<br><mark>Knight</mark><br>Podcast
				</h1>

				<p class="kkk-hero__tagline">
					<?php echo esc_html( $tagline ); ?>
				</p>

				<img class="kkk-hero__waveform"
					src="<?php echo esc_url( $img_uri . 'decoration-waveform.svg' ); ?>"
					alt=""
					aria-hidden="true"
					width="420" height="42"
					loading="lazy">

				<div class="kkk-hero__actions">
					<?php if ( $latest ) : ?>
					<a class="kkk-btn kkk-btn--primary"
						href="<?php echo esc_url( get_permalink( $latest ) ); ?>">
						&#9654; 最新回を聴く
					</a>
					<?php endif; ?>
					<a class="kkk-btn kkk-btn--outline-white"
						href="<?php echo esc_url( home_url( '/' ) ); ?>">
						エピソード一覧
					</a>
				</div>
			</div>

			<div class="kkk-hero__visual" aria-hidden="true">
				<img src="<?php echo esc_url( $img_uri . 'hero-composite.svg' ); ?>"
					alt=""
					width="540" height="400"
					loading="eager">
			</div>

		</div>
	</div>
</section>
