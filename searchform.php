<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
    <div class="metalbook-form-group">
            <label class="metalbook-label" for="s"><?php _e('Search for:','metalbook'); ?></label>
        <input class="metalbook-input metalbook-!-width-two-thirds" type="search" id="s" name="s" value="" />
        <button class="metalbook-button metalbook-button--secondary metalbook-!-static-margin-bottom-0" data-module="metalbook-button" type="submit" id="searchsubmit" ><?php _e('Search','metalbook'); ?></button>
</form>