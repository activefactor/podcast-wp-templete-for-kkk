<?php
defined( 'ABSPATH' ) || exit;

$img_uri      = get_template_directory_uri() . '/assets/img/';
$episodes_url = kkk_podcast_get_episodes_url();

$topics = array(
	array(
		'icon'     => 'topic-webdesign.svg',
		'label'    => 'Web',
		'alt'      => 'Webアイコン',
		'cat_slug' => 'web',
	),
	array(
		'icon'     => 'topic-edtech.svg',
		'label'    => '教育',
		'alt'      => '教育アイコン',
		'cat_slug' => 'education',
	),
	array(
		'icon'     => 'topic-gadget.svg',
		'label'    => 'ハード/ガジェット',
		'alt'      => 'ガジェットアイコン',
		'cat_slug' => 'gadget',
	),
	array(
		'icon'     => 'topic-chat.svg',
		'label'    => 'フリートーク',
		'alt'      => 'フリートークアイコン',
		'cat_slug' => 'freetalk',
	),
);
?>

<section class="kkk-topics kkk-section" id="topics">
	<div class="kkk-container">
		<h2 class="kkk-section__heading">
			<?php esc_html_e( '取り上げるトピック', 'kkk-podcast-template' ); ?>
		</h2>
		<div class="kkk-topics__grid">
			<?php foreach ( $topics as $topic ) :
				$filter_url = add_query_arg( 'cat_filter', $topic['cat_slug'], $episodes_url );
			?>
			<a class="kkk-topic-chip"
				href="<?php echo esc_url( $filter_url ); ?>"
				aria-label="<?php printf( esc_attr__( '%s のエピソード一覧', 'kkk-podcast-template' ), $topic['label'] ); ?>">
				<img class="kkk-topic-chip__icon"
					src="<?php echo esc_url( $img_uri . $topic['icon'] ); ?>"
					alt="<?php echo esc_attr( $topic['alt'] ); ?>"
					width="56" height="56"
					loading="lazy">
				<span class="kkk-topic-chip__label"><?php echo esc_html( $topic['label'] ); ?></span>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
