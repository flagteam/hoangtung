<?php
 
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) : ?>
	<p class="nocomment"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'Maxshop' ); ?></p>

<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
<!-- You can start editing here. -->
 
<?php if ( have_comments() ) : ?>
<h3>Comments</h3>
 

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<div class="navigation">
		<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Maxshop' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Maxshop' ) ); ?></div>
	</div> <!-- .navigation -->
<?php endif; ?>
 
<ul class="comments">
	<?php wp_list_comments('callback=Maxshop_comment'); ?>
</ul>
 
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Maxshop' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Maxshop' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>
<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
 
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"><?php _e( 'Comments are closed.', 'Maxshop' ); ?></p>
 
<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
 
<div id="respond" class="contact-form">
    <h3><?php comment_form_title( 'Leave a Comment', 'Leave a Reply to %s' ); ?></h3>
    <div class="cancel-comment-reply bottom10">
        <?php cancel_comment_reply_link(); ?>
    </div>
 
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p class="bottom20">
            You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> 
            to post a comment.
        </p>
    <?php else : ?> 
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">  
            <?php if ( $user_ID ) : ?>
            <div class="row">
                <div class="span9">
                    <p class="com_logined_text">
                        <?php _e('Logged in as', 'Maxshop')?> 
                        <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. 
                        <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out', 'Maxshop')?> &raquo;</a>
                    </p>
                </div>
            </div> 
            
            <?php else : ?>
           
                <fieldset>
                    <input type="text" name="author" id="author" placeholder="Name" title="<?php _e('Name', 'Maxshop')?>" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                    <input type="text" name="website" id="website" placeholder="Website" title="<?php _e('Website', 'Maxshop')?>" value="<?php echo isset( $comment_author_website) ? $comment_author_website : ''; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                    <input type="text" name="email" id="email" placeholder="Email" title="<?php _e('Email', 'Maxshop')?>" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                </fieldset>
                 
                <?php endif; ?>
            <textarea name="comment" title="<?php _e('Comment', 'Maxshop')?>" id="comment" cols="30" rows="10" tabindex="4"></textarea><br>
            <input type="submit" value="Add a comment">

                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>

        </form>
 
	<?php endif; // If registration required and not logged in ?>
</div>
 
<?php endif;  ?>
