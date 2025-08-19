<?php
	if (!empty($_GET['s'])){
		$title = get_search_query();
	}else{
		$title = "すべての記事";
	}
?>

<?php get_header(); ?>

<main id="main" class="l-main">
	<?php
	//MV
	get_template_part('inc/hero');

	//パンクズリスト
	get_template_part('inc/breadcrumb');
	?>

	<div class="p-archive">
		<div class="c-inner">
		<h1 class="c-head01"><?php echo $title; ?></h1>
			<?php if (have_posts()): ?>
				<div class="p-archive__wrap">
					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part("inc/c-archive01__item") ?>
					<?php endwhile; ?>
				</div>

				<?php get_template_part("inc/c-pager01") ?>
				<?php else: ?>
				<p>該当記事がありません。</p>
			<?php endif; ?>

		</div>
	</div>
</main>

<?php get_footer() ?>