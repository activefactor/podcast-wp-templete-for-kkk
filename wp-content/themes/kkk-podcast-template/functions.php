<?php
defined( 'ABSPATH' ) || exit;

/* -------------------------------------------------------
   Theme Setup
------------------------------------------------------- */

function kkk_podcast_setup() {
	load_theme_textdomain( 'kkk-podcast-template', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 64,
			'width'       => 420,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => esc_html__( 'プライマリメニュー', 'kkk-podcast-template' ),
			'footer'  => esc_html__( 'フッターメニュー', 'kkk-podcast-template' ),
		)
	);

	add_image_size( 'kkk-card', 400, 300, true );
	add_image_size( 'kkk-hero', 720, 480, true );
}
add_action( 'after_setup_theme', 'kkk_podcast_setup' );

/* -------------------------------------------------------
   Enqueue
------------------------------------------------------- */

function kkk_podcast_enqueue() {
	$ver = wp_get_theme()->get( 'Version' );
	$uri = get_template_directory_uri();

	wp_enqueue_style( 'kkk-global', $uri . '/assets/css/global.css', array(), $ver );
	wp_enqueue_style( 'kkk-components', $uri . '/assets/css/components.css', array( 'kkk-global' ), $ver );
	wp_enqueue_style( 'kkk-templates', $uri . '/assets/css/templates.css', array( 'kkk-components' ), $ver );

	wp_enqueue_script( 'kkk-navigation', $uri . '/assets/js/navigation.js', array(), $ver, true );
}
add_action( 'wp_enqueue_scripts', 'kkk_podcast_enqueue' );

/* -------------------------------------------------------
   Theme Options (wp_options ベース)
------------------------------------------------------- */

function kkk_podcast_get_option( string $key, string $default = '' ): string {
	return (string) get_option( 'kkk_podcast_' . $key, $default );
}

/* -------------------------------------------------------
   Customizer
------------------------------------------------------- */

function kkk_podcast_customize_register( WP_Customize_Manager $wp_customize ) {
	$wp_customize->add_section(
		'kkk_podcast_listen',
		array(
			'title'    => esc_html__( '視聴プラットフォーム URL', 'kkk-podcast-template' ),
			'priority' => 120,
		)
	);

	$fields = array(
		'apple_podcasts_url'  => 'Apple Podcasts URL',
		'spotify_url'         => 'Spotify URL',
		'youtube_url'         => 'YouTube URL',
		'amazon_music_url'    => 'Amazon Music URL',
		'rss_url'             => 'RSS フィード URL',
		'contact_url'         => 'お問い合わせ URL',
	);

	foreach ( $fields as $id => $label ) {
		$wp_customize->add_setting(
			'kkk_podcast_' . $id,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'kkk_podcast_' . $id,
			array(
				'label'   => $label,
				'section' => 'kkk_podcast_listen',
				'type'    => 'url',
			)
		);
	}

	// Hero コピー
	$wp_customize->add_section(
		'kkk_podcast_hero',
		array(
			'title'    => esc_html__( 'Hero テキスト', 'kkk-podcast-template' ),
			'priority' => 110,
		)
	);

	$wp_customize->add_setting(
		'kkk_podcast_hero_tagline',
		array(
			'default'           => 'Web・ガジェット・教育ICT・AI——毎週木曜、本音でお届け。',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'kkk_podcast_hero_tagline',
		array(
			'label'   => 'Hero キャッチコピー',
			'section' => 'kkk_podcast_hero',
			'type'    => 'text',
		)
	);
}
add_action( 'customize_register', 'kkk_podcast_customize_register' );

/* -------------------------------------------------------
   PowerPress ヘルパー
------------------------------------------------------- */

function kkk_podcast_render_player(): void {
	if ( shortcode_exists( 'powerpress' ) ) {
		echo do_shortcode( '[powerpress]' );
	} elseif ( current_user_can( 'manage_options' ) ) {
		echo '<p class="kkk-player-notice">' .
			esc_html__( '管理者へ: Blubrry PowerPress プラグインを有効化するとここにプレイヤーが表示されます。', 'kkk-podcast-template' ) .
			'</p>';
	}
}

/* -------------------------------------------------------
   Episode 取得ヘルパー
------------------------------------------------------- */

function kkk_podcast_get_latest_post(): ?WP_Post {
	$posts = get_posts(
		array(
			'post_type'      => 'post',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
		)
	);
	return ! empty( $posts ) ? $posts[0] : null;
}

/* -------------------------------------------------------
   アイキャッチ フォールバック
------------------------------------------------------- */

function kkk_podcast_get_fallback_thumb_url( int $post_id ): string {
	$categories = get_the_category( $post_id );
	$slug       = ! empty( $categories ) ? $categories[0]->slug : '';

	$map = array(
		'gadget'     => 'thumb-gadget.svg',
		'webdesign'  => 'thumb-webdesign.svg',
		'ai'         => 'thumb-ai.svg',
		'education'  => 'thumb-ai.svg',
	);

	$file = isset( $map[ $slug ] ) ? $map[ $slug ] : 'thumb-generic.svg';
	return get_template_directory_uri() . '/assets/img/' . $file;
}

/* -------------------------------------------------------
   Body class
------------------------------------------------------- */

function kkk_podcast_body_class( array $classes ): array {
	$classes[] = 'kkk-site';
	return $classes;
}
add_filter( 'body_class', 'kkk_podcast_body_class' );

/* -------------------------------------------------------
   Excerpt length
------------------------------------------------------- */

function kkk_podcast_excerpt_length(): int {
	return 60;
}
add_filter( 'excerpt_length', 'kkk_podcast_excerpt_length', 999 );
