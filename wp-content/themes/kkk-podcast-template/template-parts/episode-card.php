<?php
defined( 'ABSPATH' ) || exit;

$post_id    = get_the_ID();
$permalink  = get_permalink();
$title      = get_the_title();
$date       = get_the_date( 'Y年n月j日' );
$excerpt    = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 60 );

$categories = get_the_category();
$cat_name   = ! empty( $categories ) ? esc_html( $categories[0]->name ) : '';
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
			<!-- マイクアイコン（ラジオマイクシルエット） -->
			<span class="kkk-episode-card__mic" aria-hidden="true">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm5.91-3c-.49 0-.9.36-.98.85C16.52 14.2 14.47 16 12 16s-4.52-1.8-4.93-4.15c-.08-.49-.49-.85-.98-.85-.61 0-1.09.54-1 1.14.49 3 2.89 5.35 5.91 5.78V20c0 .55.45 1 1 1s1-.45 1-1v-2.08c3.02-.43 5.42-2.78 5.91-5.78.1-.6-.39-1.14-1-1.14z"/>
				</svg>
			</span>
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
