<?php
defined( 'ABSPATH' ) || exit;

/**
 * エピソードリスト行（home/archive の一覧用）
 * setup_postdata() 済みのグローバル $post を前提とする。
 */

$post_id    = get_the_ID();
$permalink  = get_permalink();
$title      = get_the_title();
$date_fmt   = get_the_date( 'Y/m/d' );
$date_attr  = get_the_date( 'Y-m-d' );
$excerpt    = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 40 );
$duration   = kkk_podcast_get_duration( $post_id );

$categories = get_the_category();
$cat_name   = ! empty( $categories ) ? $categories[0]->name : '';

$cat_slugs = array_map( function( $c ) {
	return $c->slug;
}, get_the_category() );
?>

<article class="kkk-list-item"
	data-categories="<?php echo esc_attr( implode( ' ', $cat_slugs ) ); ?>"
	data-text="<?php echo esc_attr( mb_strtolower( $title . ' ' . wp_strip_all_tags( $excerpt ) ) ); ?>">

	<div class="kkk-list-item__date">
		<time datetime="<?php echo esc_attr( $date_attr ); ?>">
			<?php echo esc_html( $date_fmt ); ?>
		</time>
	</div>

	<div class="kkk-list-item__main">
		<a class="kkk-list-item__title-link" href="<?php echo esc_url( $permalink ); ?>">
			<?php echo esc_html( $title ); ?>
		</a>
		<?php if ( $excerpt ) : ?>
		<p class="kkk-list-item__excerpt">
			<?php echo esc_html( wp_strip_all_tags( $excerpt ) ); ?>
		</p>
		<?php endif; ?>
	</div>

	<div class="kkk-list-item__meta">
		<?php if ( $cat_name ) : ?>
		<span class="kkk-episode-card__cat"><?php echo esc_html( $cat_name ); ?></span>
		<?php endif; ?>
		<?php if ( $duration ) : ?>
		<span class="kkk-list-item__duration">
			<svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
				<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/>
			</svg>
			<?php echo esc_html( $duration ); ?>
		</span>
		<?php endif; ?>
	</div>

</article>
