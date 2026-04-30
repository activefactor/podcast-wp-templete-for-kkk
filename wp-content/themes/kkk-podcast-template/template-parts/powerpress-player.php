<?php
defined( 'ABSPATH' ) || exit;
?>

<div class="kkk-player-wrapper">
	<p class="kkk-player-wrapper__label">
		<?php esc_html_e( '▶ 今すぐ聴く', 'kkk-podcast-template' ); ?>
	</p>
	<?php kkk_podcast_render_player(); ?>
</div>
