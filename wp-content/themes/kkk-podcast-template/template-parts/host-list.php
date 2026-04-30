<?php
defined( 'ABSPATH' ) || exit;

$img_uri = get_template_directory_uri() . '/assets/img/';

$hosts = array(
	array(
		'avatar' => 'host-avatar-1.svg',
		'name'   => 'K（ケイ）',
		'role'   => 'デジタルハリウッド講師 / Web制作',
		'bio'    => 'Webデザイン・フロントエンド開発を中心に、制作現場の最前線からリアルな話をお届けします。',
	),
	array(
		'avatar' => 'host-avatar-2.svg',
		'name'   => 'K（ケイ）',
		'role'   => 'デジタルハリウッド講師 / 教育ICT',
		'bio'    => '教育現場でのICT活用・AI教育を専門に、先生・学生・学習者に役立つ情報を発信します。',
	),
);
?>

<section class="kkk-hosts kkk-section kkk-section--alt" id="hosts">
	<div class="kkk-container">
		<h2 class="kkk-section__heading">
			<?php esc_html_e( 'ホスト紹介', 'kkk-podcast-template' ); ?>
		</h2>
		<div class="kkk-hosts__grid">
			<?php foreach ( $hosts as $host ) : ?>
			<div class="kkk-host-card">
				<div class="kkk-host-card__avatar">
					<img src="<?php echo esc_url( $img_uri . $host['avatar'] ); ?>"
						alt=""
						width="100" height="100"
						loading="lazy">
				</div>
				<div class="kkk-host-card__info">
					<p class="kkk-host-card__name"><?php echo esc_html( $host['name'] ); ?></p>
					<p class="kkk-host-card__role"><?php echo esc_html( $host['role'] ); ?></p>
					<p class="kkk-host-card__bio"><?php echo esc_html( $host['bio'] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
