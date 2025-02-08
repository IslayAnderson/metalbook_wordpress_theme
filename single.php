<?php get_header(); ?>
<div class="metalbook-width-container">
<a href="/" class="metalbook-back-link">Back</a>
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
				<h2 class="metalbook-heading-m">Comments:</h2>
				<?php
				$args = array(
					'post_id' => get_the_ID(),
					'orderby' => array(
						'comment_date' => 'ASC'
					),
				);

				// The comment Query
				$comments_query = new WP_Comment_Query();
				$comments       = $comments_query->query( $args );

				// Comment Loop
				if ( $comments ) {
					foreach ( $comments as $comment ) {
						metalbook_comments($comment);
					}
				} else {
					metalbook_error('No comments found.');
				}
				
				?>

				<div id="respond" class="comment-respond">
					<h3 id="reply-title" class="comment-reply-title">Leave a Reply 
						<small>
							<a rel="nofollow" id="cancel-comment-reply-link" href="/socialchaff-an-exercise-in-obfuscation-by-hiding-in-plain-sight/#respond" style="display:none;">Cancel reply</a>
						</small>
					</h3>
					<form action="/wp-comments-post.php" method="post" id="commentform" class="comment-form">
						<div class="metalbook-form-group">
							<label class="metalbook-label" for="more-detail">Comment</label>
							<textarea class="metalbook-textarea" id="comment" name="comment" rows="5" aria-describedby="more-detail-hint"></textarea>
						</div> 
						<div class="metalbook-form-group">
							<label class="metalbook-label" for="full-name">User name</label>
							<input class="metalbook-input" id="author" name="author" type="text" spellcheck="false" autocomplete="name">
						</div>
						<div class="metalbook-form-group">
							<label class="metalbook-label" for="email">Email address</label>
							<input class="metalbook-input" id="email" name="email" type="email" spellcheck="false" aria-describedby="email-hint" autocomplete="email">
						</div>
						<div class="metalbook-form-group">
							<label class="metalbook-label" for="email">Website</label>
							<input class="metalbook-input" id="url" name="url" type="text" spellcheck="false" autocomplete="url">
						</div>
						<input name="submit" type="submit" id="submit" class="metalbook-button" data-module="metalbook-button" value="Post Comment">
						<input type="hidden" name="comment_post_ID" value="<?= get_the_ID() ?>" id="comment_post_ID">
						<input type="hidden" name="comment_parent" id="comment_parent" value="0">
						</p>
					</form>	
				</div>

				<?php endwhile; ?>

					<?php metalbook_page_navi(); ?>

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
