<?php
defined( 'ABSPATH' ) || exit;

/**
 * エピソードカード
 * setup_postdata() 済みのグローバル $post を前提とする。
 * 個別 WP_Post を渡す場合は呼び元で setup_postdata() すること。
 */

$post_id   = get_the_ID();
$permalink = get_permalink();
$title     = get_the_title();
$date      = get_the_date( 'Y年n月j日' );
$excerpt   = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 60 );
$img_uri   = get_template_directory_uri() . '/assets/img/';

$categories = get_the_category();
$cat_name   = ! empty( $categories ) ? esc_html( $categories[0]->name ) : '';
$cat_url    = ! empty( $categories ) ? esc_url( get_category_link( $categories[0]->term_id ) ) : '';
?>

<article class="kkk-episode-card">
	<a class="kkk-episode-card__link" href="<?php echo esc_url( $permalink ); ?>"
		aria-label="<?php echo esc_attr( $title ); ?>">

		<div class="kkk-episode-card__thumb">
			<?php if ( has_post_thumbnail( $post_id ) ) : ?>
				<?php the_post_thumbnail( 'kkk-card', array( 'alt' => esc_attr( $title ), 'loading' => 'lazy' ) ); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( kkk_podcast_get_fallback_thumb_url( $post_id ) ); ?>"
					alt=""
					width="400" height="240"
					loading="lazy">
			<?php endif; ?>
			<img class="kkk-episode-card__play"
				src="<?php echo esc_url( $img_uri . 'play-button.svg' ); ?>"
				alt=""
				aria-hidden="true"
				width="36" height="36">
		</div>

		<div class="kkk-episode-card__body">
			<div class="kkk-episode-card__meta">
				<?php if ( $cat_name ) : ?>
				<span class="kkk-episode-card__cat"><?php echo $cat_name; ?></span>
				<?php endif; ?>
				<time class="kkk-episode-card__date"
					datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
					<?php echo esc_html( $date ); ?>
				</time>
			</div>
			<h2 class="kkk-episode-card__title"><?php echo esc_html( $title ); ?></h2>
			<?php if ( $excerpt ) : ?>
			<p class="kkk-episode-card__excerpt"><?php echo esc_html( wp_strip_all_tags( $excerpt ) ); ?></p>
			<?php endif; ?>
		</div>

	</a>
</article>
