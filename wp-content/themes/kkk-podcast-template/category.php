<?php
defined( 'ABSPATH' ) || exit;
get_header();

$current_cat = get_queried_object();
$all_cats    = get_categories( array( 'hide_empty' => true ) );
$initial_cat = $current_cat ? $current_cat->slug : '';

$all_args = array(
	'post_type'      => 'post',
	'posts_per_page' => 200,
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'cat'            => $current_cat ? $current_cat->term_id : 0,
);
$all_query = new WP_Query( $all_args );
?>

<main id="main" role="main">
	<div class="kkk-archive">
		<div class="kkk-container">

			<div class="kkk-archive__header">
				<h1 class="kkk-archive__title">
					<?php echo esc_html( single_cat_title( '', false ) ); ?>
				</h1>

				<div class="kkk-filter-box" id="kkk-filter-box"
					data-initial-cat="<?php echo esc_attr( $initial_cat ); ?>"
					data-initial-search="">

					<div class="kkk-filter-box__search">
						<label for="kkk-search-input" class="kkk-visually-hidden">
							<?php esc_html_e( 'エピソードを検索', 'kkk-podcast-template' ); ?>
						</label>
						<input
							type="search"
							id="kkk-search-input"
							class="kkk-search-input"
							placeholder="<?php esc_attr_e( 'タイトル・内容で検索…', 'kkk-podcast-template' ); ?>"
							autocomplete="off">
						<svg class="kkk-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
						</svg>
					</div>

					<?php if ( $all_cats ) : ?>
					<fieldset class="kkk-filter-box__cats">
						<legend class="kkk-filter-box__cats-label">
							<?php esc_html_e( 'カテゴリで絞り込む', 'kkk-podcast-template' ); ?>
						</legend>
						<div class="kkk-filter-box__cats-list">
							<?php foreach ( $all_cats as $cat ) : ?>
							<label class="kkk-cat-checkbox">
								<input
									type="checkbox"
									name="cat_filter[]"
									value="<?php echo esc_attr( $cat->slug ); ?>"
									class="kkk-cat-checkbox__input"
									<?php checked( $initial_cat === $cat->slug ); ?>>
								<span class="kkk-cat-checkbox__label">
									<?php echo esc_html( $cat->name ); ?>
								</span>
							</label>
							<?php endforeach; ?>
						</div>
					</fieldset>
					<?php endif; ?>

					<p class="kkk-filter-result" id="kkk-filter-result" aria-live="polite"></p>
				</div>
			</div>

			<?php if ( $all_query->have_posts() ) : ?>
			<div class="kkk-episode-list" id="kkk-episode-list">
				<?php while ( $all_query->have_posts() ) :
					$all_query->the_post();
					get_template_part( 'template-parts/episode-list-item' );
				endwhile; ?>
			</div>
			<?php
				wp_reset_postdata();
			else : ?>
			<div class="kkk-no-posts">
				<h2 class="kkk-no-posts__title">
					<?php esc_html_e( 'このカテゴリにはエピソードがありません', 'kkk-podcast-template' ); ?>
				</h2>
			</div>
			<?php
				wp_reset_postdata();
			endif;
			?>

		</div>
	</div>
</main>

<?php get_footer(); ?>
