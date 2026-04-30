<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main id="main" role="main">
	<div class="kkk-page">
		<div class="kkk-container">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<header class="kkk-page__header">
				<h1 class="kkk-page__title">
					<?php echo esc_html( get_the_title() ); ?>
				</h1>
			</header>

			<div class="kkk-page__content kkk-post-content">
				<?php the_content(); ?>
			</div>

			<?php endwhile; endif; ?>

		</div>
	</div>
</main>

<?php get_footer(); ?>
