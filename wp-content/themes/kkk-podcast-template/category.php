<?php
defined( 'ABSPATH' ) || exit;
get_header();

$current_cat = get_queried_object();
$all_cats    = get_categories( array( 'hide_empty' => true ) );
?>

<main id="main" role="main">
	<div class="kkk-archive">
		<div class="kkk-container">

			<div class="kkk-archive__header">
				<h1 class="kkk-archive__title">
					<?php echo esc_html( single_cat_title( '', false ) ); ?>
				</h1>

				<?php if ( $all_cats ) : ?>
				<nav class="kkk-cat-nav" aria-label="<?php esc_attr_e( 'カテゴリ絞り込み', 'kkk-podcast-template' ); ?>">
					<a class="kkk-cat-nav__item"
						href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php esc_html_e( 'すべて', 'kkk-podcast-template' ); ?>
					</a>
					<?php foreach ( $all_cats as $cat ) : ?>
					<a class="kkk-cat-nav__item<?php echo ( $current_cat && (int) $current_cat->term_id === (int) $cat->term_id ) ? ' kkk-cat-nav__item--active' : ''; ?>"
						href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
						<?php echo esc_html( $cat->name ); ?>
					</a>
					<?php endforeach; ?>
				</nav>
				<?php endif; ?>
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
					<?php esc_html_e( 'このカテゴリにはエピソードがありません', 'kkk-podcast-template' ); ?>
				</h2>
			</div>
			<?php endif; ?>

		</div>
	</div>
</main>

<?php get_footer(); ?>
