<?php get_header(); ?>
<main id="primary" class="site-main">
	<!-- <div class="container bg-white radius"> -->
	<?php
	if (have_posts()) :
		while (have_posts()) :
			the_post();
	?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php shop_theme_post_thumbnail(); ?>
				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__('Pages:', 'shop_theme'),
							'after'  => '</div>',
						)
					);
					?>
				</div>
			</article>
	<?php
		endwhile;
	else :
		get_template_part('template-parts/content', 'none');
	endif;
	?>
	<!-- </div> -->
</main>
<?php
get_footer();
