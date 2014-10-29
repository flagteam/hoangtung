
	<form action="<?php echo site_url() ?>" method="get" id="search-global-form">   
                <input type="text" placeholder="<?php _e('Type and hit enter', 'Maxshop');?>" name="s" id="search" value="<?php the_search_query(); ?>" />
                <input type="submit" value="" name="search"  id="searchsubmit">
	</form>