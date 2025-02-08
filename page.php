<?php get_header(); ?>
<div class="metalbook-width-container">
	<?php if(!is_front_page()): ?>
	<a href="/" class="metalbook-back-link">Back</a>
	<?php endif; ?>
	<main class="metalbook-main-wrapper ">
		<div class="metalbook-grid-row metalbook-width-container">
			<div class="metalbook-grid-column-full-width">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
					
					<h1 class="metalbook-heading-l"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<div class="metalbook-inset-text">
					<?php printf( __
							( 'Posted', 'metalbook' ).' %1$s %2$s',
							'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
							'<span class="by">'.__( 'by', 'metalbook').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
						); ?>	
					</div>
					<?php if(has_post_thumbnail()):?>
						<div class="featured">
							<?php the_post_thumbnail('large'); ?>
						</div>
					<?php endif; ?>
					<section>
						<?php the_content(); ?>
					</section>

				</article>

				<?php endwhile; ?>



				<?php else : ?>

				<article id="post-not-found" class="metalbook-grid-column-full">
					<?php metalbook_error('Post not found'); ?>
				</article>

				<?php endif; ?>
			</div>
		</div>
	</main>
</div>

<?php get_footer(); ?>
