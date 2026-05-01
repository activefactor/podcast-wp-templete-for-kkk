<?php
defined( 'ABSPATH' ) || exit;

$about_url = kkk_podcast_get_about_url();
if ( ! $about_url ) {
	return;
}
?>

<section class="kkk-about-cta kkk-section" id="about">
	<div class="kkk-container">
		<div class="kkk-about-cta__inner">
			<div class="kkk-about-cta__content">
				<p class="kkk-about-cta__eyebrow">
					<?php esc_html_e( 'ABOUT', 'kkk-podcast-template' ); ?>
				</p>
				<h2 class="kkk-about-cta__title">
					<?php esc_html_e( 'K and K Knight Podcast について', 'kkk-podcast-template' ); ?>
				</h2>
				<p class="kkk-about-cta__text">
					<?php esc_html_e( 'デジタルハリウッド講師 K と K による Podcast 番組。Web制作・ガジェット・教育ICT・AI など、制作と教育の現場から毎週木曜日にお届けしています。', 'kkk-podcast-template' ); ?>
				</p>
				<a class="kkk-btn kkk-btn--secondary"
					href="<?php echo esc_url( $about_url ); ?>">
					<?php esc_html_e( '番組について詳しく見る', 'kkk-podcast-template' ); ?>
				</a>
			</div>
			<div class="kkk-about-cta__visual" aria-hidden="true">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/speech-bubble.svg' ); ?>"
					alt=""
					width="180" height="150"
					loading="lazy">
			</div>
		</div>
	</div>
</section>
