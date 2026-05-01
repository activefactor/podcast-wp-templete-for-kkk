<?php
defined( 'ABSPATH' ) || exit;

$img_uri = get_template_directory_uri() . '/assets/img/';

$platforms = array(
	array(
		'key'   => 'apple_podcasts_url',
		'label' => 'Apple Podcasts',
		'icon'  => 'platform-placeholder.svg',
	),
	array(
		'key'   => 'spotify_url',
		'label' => 'Spotify',
		'icon'  => 'platform-placeholder.svg',
	),
	array(
		'key'   => 'youtube_url',
		'label' => 'YouTube',
		'icon'  => 'platform-placeholder.svg',
	),
	array(
		'key'   => 'amazon_music_url',
		'label' => 'Amazon Music',
		'icon'  => 'platform-placeholder.svg',
	),
	array(
		'key'   => 'rss_url',
		'label' => 'RSS フィード',
		'icon'  => 'platform-placeholder.svg',
	),
);

$has_any = false;
foreach ( $platforms as $p ) {
	if ( get_theme_mod( 'kkk_podcast_' . $p['key'], 'rss_url' === $p['key'] ? 'https://podcast.kk-k.net/feed/' : '' ) ) {
		$has_any = true;
		break;
	}
}

if ( ! $has_any ) {
	return;
}
?>

<section class="kkk-listen" id="listen">
	<div class="kkk-container">
		<h2 class="kkk-section__heading">
			<?php esc_html_e( '聴く・購読する', 'kkk-podcast-template' ); ?>
		</h2>
		<p class="kkk-listen__sub">
			<?php esc_html_e( 'お好きなプラットフォームでフォローして、最新回を聴き逃さないようにしましょう。', 'kkk-podcast-template' ); ?>
		</p>
		<div class="kkk-listen__grid">
			<?php foreach ( $platforms as $p ) :
				$url = get_theme_mod( 'kkk_podcast_' . $p['key'], 'rss_url' === $p['key'] ? 'https://podcast.kk-k.net/feed/' : '' );
				if ( ! $url ) continue;
			?>
			<a class="kkk-listen-link"
				href="<?php echo esc_url( $url ); ?>"
				target="_blank"
				rel="noopener noreferrer">
				<img class="kkk-listen-link__icon"
					src="<?php echo esc_url( $img_uri . $p['icon'] ); ?>"
					alt=""
					width="32" height="32"
					loading="lazy"
					aria-hidden="true">
				<?php echo esc_html( $p['label'] ); ?>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
