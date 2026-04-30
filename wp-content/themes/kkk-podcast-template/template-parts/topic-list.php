<?php
defined( 'ABSPATH' ) || exit;

$img_uri = get_template_directory_uri() . '/assets/img/';

$topics = array(
	array(
		'icon'  => 'topic-webdesign.svg',
		'label' => 'Webデザイン',
		'alt'   => 'Webデザインアイコン',
	),
	array(
		'icon'  => 'topic-gadget.svg',
		'label' => 'ガジェット',
		'alt'   => 'ガジェットアイコン',
	),
	array(
		'icon'  => 'topic-edtech.svg',
		'label' => '教育テクノロジー',
		'alt'   => '教育テクノロジーアイコン',
	),
	array(
		'icon'  => 'topic-ai.svg',
		'label' => 'AI',
		'alt'   => 'AIアイコン',
	),
	array(
		'icon'  => 'topic-chat.svg',
		'label' => 'ゆるい雑談',
		'alt'   => 'ゆるい雑談アイコン',
	),
);
?>

<section class="kkk-topics kkk-section" id="topics">
	<div class="kkk-container">
		<h2 class="kkk-section__heading">
			<?php esc_html_e( '取り上げるトピック', 'kkk-podcast-template' ); ?>
		</h2>
		<div class="kkk-topics__grid">
			<?php foreach ( $topics as $topic ) : ?>
			<div class="kkk-topic-chip">
				<img class="kkk-topic-chip__icon"
					src="<?php echo esc_url( $img_uri . $topic['icon'] ); ?>"
					alt="<?php echo esc_attr( $topic['alt'] ); ?>"
					width="56" height="56"
					loading="lazy">
				<span class="kkk-topic-chip__label"><?php echo esc_html( $topic['label'] ); ?></span>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
