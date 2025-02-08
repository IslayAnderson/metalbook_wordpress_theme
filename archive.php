<?php get_header(); ?>

<div class="metalbook-width-container">
	<main class="metalbook-main-wrapper">
		<div class="metalbook-grid-row metalbook-width-container">
			<div class="metalbook-grid-column-two-thirds">
				<?php
				the_archive_title( '<h1 class="metalbook-heading-xl page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</div>
		</div>
		<div class="metalbook-grid-row">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="metalbook-grid-column-one-half">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
					<h2 class="metalbook-heading-m"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
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
						<?php the_excerpt(); ?>
					</section>
				</article>
			</div>
			<?php endwhile; ?>

			<?php metalbook_page_navi(); ?>

			<?php else : ?>

			<article id="post-not-found" class="metalbook-grid-column-full">
				<?php metalbook_error('Post not found'); ?>
			</article>

			<?php endif; ?>
		</div>
	</main>
</div>

<?php get_footer(); ?>