<?php
defined( 'ABSPATH' ) || exit;
get_header();

$episodes_url = kkk_podcast_get_episodes_url();
?>

<main id="main" role="main">

	<?php get_template_part( 'template-parts/hero' ); ?>

	<?php
	$latest = kkk_podcast_get_latest_post();
	if ( $latest ) :
		setup_postdata( $GLOBALS['post'] = $latest );
	?>
	<section class="kkk-latest-episode" id="latest" aria-labelledby="latest-heading">
		<div class="kkk-container">
			<div class="kkk-latest-episode__inner">
				<div class="kkk-latest-episode__meta">
					<p class="kkk-latest-episode__eyebrow">
						<?php esc_html_e( 'LATEST EPISODE', 'kkk-podcast-template' ); ?>
					</p>
					<h2 class="kkk-latest-episode__title" id="latest-heading">
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php echo esc_html( get_the_title() ); ?>
						</a>
					</h2>
					<time class="kkk-latest-episode__date"
						datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
						<?php echo esc_html( get_the_date( 'Y年n月j日' ) ); ?>
					</time>
					<?php
					$excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 60 );
					if ( $excerpt ) :
					?>
					<p class="kkk-latest-episode__excerpt">
						<?php echo esc_html( wp_strip_all_tags( $excerpt ) ); ?>
					</p>
					<?php endif; ?>
					<a class="kkk-btn kkk-btn--primary kkk-latest-episode__link"
						href="<?php echo esc_url( get_permalink() ); ?>">
						<?php esc_html_e( '詳細・Show Notes を見る', 'kkk-podcast-template' ); ?>
					</a>
				</div>

				<div class="kkk-latest-episode__player">
					<?php get_template_part( 'template-parts/powerpress-player' ); ?>
				</div>
			</div>
		</div>
	</section>
	<?php
		wp_reset_postdata();
	endif;
	?>

	<?php
	$recent_args = array(
		'post_type'      => 'post',
		'posts_per_page' => 7,
		'post_status'    => 'publish',
	);
	$recent_query = new WP_Query( $recent_args );

	if ( $recent_query->have_posts() ) :
		$count = 0;
	?>
	<section class="kkk-section" aria-labelledby="episodes-heading">
		<div class="kkk-container">
			<h2 class="kkk-section__heading" id="episodes-heading">
				<?php esc_html_e( 'エピソード一覧', 'kkk-podcast-template' ); ?>
			</h2>
			<div class="kkk-episode-grid">
				<?php while ( $recent_query->have_posts() ) :
					$recent_query->the_post();
					$count++;
					if ( $count === 1 ) continue;
					if ( $count > 7 ) break;
					get_template_part( 'template-parts/episode-card' );
				endwhile; ?>
			</div>
			<div style="text-align:center; margin-top:var(--kkk-space-8);">
				<a class="kkk-btn kkk-btn--outline"
					href="<?php echo esc_url( $episodes_url ); ?>">
					<?php esc_html_e( 'すべてのエピソードを見る', 'kkk-podcast-template' ); ?>
				</a>
			</div>
		</div>
	</section>
	<?php
		wp_reset_postdata();
	endif;
	?>

	<?php get_template_part( 'template-parts/topic-list' ); ?>

	<?php get_template_part( 'template-parts/about-cta' ); ?>

	<?php get_template_part( 'template-parts/listen-links' ); ?>

</main>

<?php get_footer(); ?>
