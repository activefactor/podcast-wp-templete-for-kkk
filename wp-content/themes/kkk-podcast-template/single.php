<?php
defined( 'ABSPATH' ) || exit;
get_header();

$categories  = get_the_category();
$date        = get_the_date( 'Y年n月j日' );
$prev_post   = get_previous_post();
$next_post   = get_next_post();
?>

<main id="main" role="main">
	<div class="kkk-single">
		<div class="kkk-container">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<header class="kkk-single__header">
				<div class="kkk-single__eyebrow">
					<?php if ( $categories ) : ?>
					<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"
						class="kkk-episode-card__cat">
						<?php echo esc_html( $categories[0]->name ); ?>
					</a>
					<?php endif; ?>
					<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
						<?php echo esc_html( $date ); ?>
					</time>
				</div>
				<h1 class="kkk-single__title">
					<?php echo esc_html( get_the_title() ); ?>
				</h1>
			</header>

			<?php if ( ! has_shortcode( get_the_content(), 'powerpress' ) ) : ?>
			<div class="kkk-single__player">
				<?php get_template_part( 'template-parts/powerpress-player' ); ?>
			</div>
			<?php endif; ?>

			<div class="kkk-single__content kkk-post-content">
				<?php the_content(); ?>
			</div>

			<?php endwhile; endif; ?>

			<?php if ( $prev_post || $next_post ) : ?>
			<nav class="kkk-single__nav" aria-label="<?php esc_attr_e( '前後のエピソード', 'kkk-podcast-template' ); ?>">
				<div class="kkk-single__nav-item">
					<?php if ( $prev_post ) : ?>
					<span class="kkk-single__nav-label">
						<?php esc_html_e( '&#8592; 前のエピソード', 'kkk-podcast-template' ); ?>
					</span>
					<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
						<span class="kkk-single__nav-title">
							<?php echo esc_html( get_the_title( $prev_post ) ); ?>
						</span>
					</a>
					<?php endif; ?>
				</div>
				<div class="kkk-single__nav-item kkk-single__nav-item--next">
					<?php if ( $next_post ) : ?>
					<span class="kkk-single__nav-label">
						<?php esc_html_e( '次のエピソード &#8594;', 'kkk-podcast-template' ); ?>
					</span>
					<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
						<span class="kkk-single__nav-title">
							<?php echo esc_html( get_the_title( $next_post ) ); ?>
						</span>
					</a>
					<?php endif; ?>
				</div>
			</nav>
			<?php endif; ?>

		</div>
	</div>
</main>

<?php get_footer(); ?>
