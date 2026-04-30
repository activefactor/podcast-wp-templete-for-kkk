<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main id="main" role="main">
	<div class="kkk-archive">
		<div class="kkk-container">

			<div class="kkk-archive__header">
				<h1 class="kkk-archive__title">
					<?php echo esc_html( get_the_archive_title() ); ?>
				</h1>
				<?php
				$archive_desc = get_the_archive_description();
				if ( $archive_desc ) {
					echo '<p class="kkk-archive__desc">' . wp_kses_post( $archive_desc ) . '</p>';
				}
				?>
			</div>

			<?php if ( have_posts() ) : ?>
			<div class="kkk-episode-grid">
				<?php while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/episode-card' );
				endwhile; ?>
			</div>
			<div class="kkk-pagination">
				<?php
				the_posts_pagination(
					array(
						'prev_text' => '&#8592; 前へ',
						'next_text' => '次へ &#8594;',
					)
				);
				?>
			</div>
			<?php else : ?>
			<div class="kkk-no-posts">
				<h2 class="kkk-no-posts__title">
					<?php esc_html_e( 'エピソードが見つかりません', 'kkk-podcast-template' ); ?>
				</h2>
			</div>
			<?php endif; ?>

		</div>
	</div>
</main>

<?php get_footer(); ?>
