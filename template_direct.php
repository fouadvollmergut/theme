<?php get_header(); /* Template Name: Direktausgabe */ ?>

	<?php if( have_posts() ): while( have_posts() ): the_post(); $postID = get_the_ID(); ?>

		<div class="gdymc_module">
			<div class="module modulePadding">
				<?php the_content(); ?>
			</div>
		</div>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>