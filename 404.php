<?php get_header(); ?>
<div class="metalbook-width-container">
	<?php if(!is_front_page()): ?>
	<a href="/" class="metalbook-back-link">Back</a>
	<?php endif; ?>
	<main class="metalbook-main-wrapper ">
		<div class="metalbook-grid-row metalbook-width-container">
			<div class="metalbook-grid-column-full-width">
				<div class="metalbook-error-summary" data-module="metalbook-error-summary">
					<div role="alert">
						<h2 class="metalbook-error-summary__title">There is a problem</h2>
						<div class="metalbook-error-summary__body">
							<ul class="metalbook-list metalbook-error-summary__list">
								<li>
									<a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/404" target="_blank">
										<?php _e( 'Sorry 404 - Article Not Found', 'metalbook' ); ?></br>
										<?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'metalbook' ); ?>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			<?php get_search_form(); ?>
		</div>
	</main>
</div>

<?php get_footer(); ?>
