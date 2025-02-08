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
