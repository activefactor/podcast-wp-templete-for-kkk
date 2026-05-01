<?php
/*
Template Name: About ページ
Template Post Type: page
*/
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main id="main" role="main">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="kkk-about-page">

		<header class="kkk-about-page__header">
			<div class="kkk-container">
				<h1 class="kkk-about-page__title">
					<?php echo esc_html( get_the_title() ); ?>
				</h1>
			</div>
		</header>

		<div class="kkk-about-page__content-wrap">
			<div class="kkk-container">
				<div class="kkk-about-page__content kkk-post-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>

	</div>

	<?php endwhile; endif; ?>

	<?php get_template_part( 'template-parts/topic-list' ); ?>

	<?php get_template_part( 'template-parts/listen-links' ); ?>

</main>

<?php get_footer(); ?>
