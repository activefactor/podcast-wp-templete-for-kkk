<?php
defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="kkk-skip-link" href="#main"><?php esc_html_e( 'メインコンテンツへスキップ', 'kkk-podcast-template' ); ?></a>

<header class="kkk-site-header" role="banner">
	<div class="kkk-site-header__inner kkk-container">

		<div class="kkk-site-header__brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="kkk-site-header__logo-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-lockup.svg' ); ?>"
						alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
						width="210" height="32"
						loading="lazy">
				</a>
			<?php endif; ?>
		</div>

		<nav class="kkk-site-nav" aria-label="<?php esc_attr_e( 'プライマリナビゲーション', 'kkk-podcast-template' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'kkk-nav-list',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

		<?php
		$apple_url = get_theme_mod( 'kkk_podcast_apple_podcasts_url', '' );
		$spotify_url = get_theme_mod( 'kkk_podcast_spotify_url', '' );
		$follow_url = $apple_url ? $apple_url : $spotify_url;
		if ( $follow_url ) :
		?>
		<a class="kkk-btn kkk-btn--outline kkk-site-header__cta"
			href="<?php echo esc_url( $follow_url ); ?>"
			target="_blank"
			rel="noopener noreferrer">
			<?php esc_html_e( 'フォローする', 'kkk-podcast-template' ); ?>
		</a>
		<?php endif; ?>

		<button class="kkk-nav-toggle" aria-controls="kkk-mobile-nav" aria-expanded="false"
			aria-label="<?php esc_attr_e( 'メニューを開く', 'kkk-podcast-template' ); ?>">
			<span class="kkk-nav-toggle__bar"></span>
			<span class="kkk-nav-toggle__bar"></span>
			<span class="kkk-nav-toggle__bar"></span>
		</button>

	</div>

	<div class="kkk-mobile-nav" id="kkk-mobile-nav" hidden>
		<nav aria-label="<?php esc_attr_e( 'モバイルナビゲーション', 'kkk-podcast-template' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'kkk-mobile-nav-list',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
	</div>
</header>
