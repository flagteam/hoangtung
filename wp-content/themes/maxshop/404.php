<?php get_header();?>
<div class="bar-wrap">
    <div class="container">
        <div class="row">
        <div class="span12">
            <div class="title-bar">
                   <h1 class="notfound_title"><?php _e('404', 'Maxshop')?></h1>
            </div>        
            </div>
        </div>
    </div>
</div>
<div class="product_wrap">
    <div class="container">
        <div class="row">
            <div class="span12" style="margin-bottom: 30px; text-align: center">
                    <h1 class="notfound_title"><?php _e('Page not found', 'Maxshop')?></h1>
                    <p class="notfound_description">
                        <?php _e('The page you are looking for seems to be missing.Go back, or return to yourcompany.com to choose a new direction.Please report any broken links to our team.', 'Maxshop')?>
                    </p>
            </div>
            <div class="span12" style="margin-bottom: 30px; text-align: center">
                    <a class="button notfound_button" href="javascript: history.go(-1)"><?php _e('Return to previous page', 'Maxshop')?></a>
            </div>
            <div class="span3"></div>
            </div> 
    </div>
</div>
<?php get_footer(); ?>
