<?php
defined( 'ABSPATH' ) || exit;

$apple_url   = get_theme_mod( 'kkk_podcast_apple_podcasts_url', '' );
$spotify_url = get_theme_mod( 'kkk_podcast_spotify_url', '' );
$youtube_url = get_theme_mod( 'kkk_podcast_youtube_url', '' );
$amazon_url  = get_theme_mod( 'kkk_podcast_amazon_music_url', '' );
$rss_url     = get_theme_mod( 'kkk_podcast_rss_url', '' );
$contact_url = get_theme_mod( 'kkk_podcast_contact_url', '' );

$platforms = array(
	array( 'url' => $apple_url,   'label' => 'Apple Podcasts' ),
	array( 'url' => $spotify_url, 'label' => 'Spotify' ),
	array( 'url' => $youtube_url, 'label' => 'YouTube' ),
	array( 'url' => $amazon_url,  'label' => 'Amazon Music' ),
	array( 'url' => $rss_url,     'label' => 'RSS' ),
);
?>

<footer class="kkk-site-footer" role="contentinfo">
	<div class="kkk-container">

		<div class="kkk-site-footer__top">
			<div class="kkk-site-footer__brand">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-lockup.svg' ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
					width="210" height="32"
					loading="lazy">
				<p class="kkk-site-footer__tagline">
					<?php esc_html_e( 'Web・ガジェット・教育ICT・AI——毎週木曜配信。', 'kkk-podcast-template' ); ?>
				</p>
			</div>

			<nav class="kkk-site-footer__nav" aria-label="<?php esc_attr_e( 'フッターナビゲーション', 'kkk-podcast-template' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_class'     => 'kkk-footer-nav-list',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<?php
			$active_platforms = array_filter( $platforms, function ( $p ) {
				return ! empty( $p['url'] );
			} );
			if ( $active_platforms ) :
			?>
			<div class="kkk-site-footer__listen">
				<p class="kkk-site-footer__listen-label"><?php esc_html_e( '聴く', 'kkk-podcast-template' ); ?></p>
				<ul class="kkk-site-footer__listen-list">
					<?php foreach ( $active_platforms as $p ) : ?>
					<li>
						<a href="<?php echo esc_url( $p['url'] ); ?>" target="_blank" rel="noopener noreferrer">
							<?php echo esc_html( $p['label'] ); ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>

		<div class="kkk-site-footer__bottom">
			<small class="kkk-site-footer__copy">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</a>
			</small>
			<?php if ( $contact_url ) : ?>
			<a class="kkk-site-footer__contact"
				href="<?php echo esc_url( $contact_url ); ?>">
				<?php esc_html_e( 'お問い合わせ', 'kkk-podcast-template' ); ?>
			</a>
			<?php endif; ?>
		</div>

	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
