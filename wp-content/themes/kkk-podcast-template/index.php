<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main id="main" role="main">
	<div class="kkk-archive">
		<div class="kkk-container">

			<div class="kkk-archive__header">
				<h1 class="kkk-archive__title">
					<?php
					if ( is_home() && ! is_front_page() ) {
						echo esc_html( single_post_title( '', false ) );
					} elseif ( is_archive() ) {
						echo esc_html( get_the_archive_title() );
					} elseif ( is_search() ) {
						printf(
							esc_html__( '「%s」の検索結果', 'kkk-podcast-template' ),
							esc_html( get_search_query() )
						);
					} else {
						esc_html_e( 'エピソード一覧', 'kkk-podcast-template' );
					}
					?>
				</h1>
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
					<?php esc_html_e( 'コンテンツが見つかりません', 'kkk-podcast-template' ); ?>
				</h2>
				<p><?php esc_html_e( '別のキーワードや条件でお試しください。', 'kkk-podcast-template' ); ?></p>
			</div>
			<?php endif; ?>

		</div>
	</div>
</main>

<?php get_footer(); ?>
