<?php /* Template Name: Contact Form */ ?>

<?php get_header(); ?>
<?php 
	$alc_options = get_option('alc_general_settings'); 
	$options = array(
		$alc_options['alc_contact_error_message'], 
		$alc_options['alc_contact_success_message'],
		$alc_options['alc_subject'],
		$alc_options['alc_email_address']
	);
	
	$custom =  get_post_custom($post->ID);
	$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
	//$breadcrumbs = $alc_options['alc_show_breadcrumbs'];
	$titles = $alc_options['alc_show_page_titles'];
?>
<?php  if ($titles):?>
<div class="bar-wrap">
    <div class="container">
        <div class="row">
        <div class="span12">
            <div class="title-bar">
                <?php  if ($titles):?>
					<h1>
					<?php 
						$headline = get_post_meta($post->ID, "_headline", $single = false);
						if(!empty($headline[0]) ){echo $headline[0];}
						else{echo get_the_title();} 
					?>
					</h1>
		<?php endif?>
            </div>        
            </div>
        </div>
    </div>
</div>
<?php endif?>
<?php if (!empty($alc_options['alc_contact_address'])):?>
<script type="text/javascript">   
  jQuery(function(){
	jQuery('#map_canvas').gmap3(
	  {
		action: 'addMarker',
		address: "<?php echo htmlspecialchars($alc_options['alc_contact_address'])?>",
		map:{
		  center: true,
		  zoom: 14
		}
		
	  },
	  {action: 'setOptions', args:[{scrollwheel:true}]}
	);
	  
  });
</script> 
<?php endif?> 
<div class="product_wrap">
    <div class="container page-content">
		<div class="row">
			<div class="span12"><div id="map_canvas" class="gmap3 map_location"></div>		</div>
				<div class="span8">
					<div class="contact-form">
						<form method="POST" class="contactForm">
							<div id="status"></div>
							<fieldset>              
								<input type="text" placeholder="<?php _e('Name', 'Maxshop')?>" name="contactname" id="contactname" />
								<?php if(isset($nameError) && $nameError != ''): ?><span class="errorarr"><?php echo $nameError;?></span><?php endif;?>
								<input type="text" placeholder="<?php _e('E-mail', 'Maxshop')?>" name="contactemail" id="contactemail" />
								<?php if(isset($emailError) && $emailError != ''): ?><span class="errorarr"><?php echo $emailError;?></span><?php endif;?>
								<input type="text" placeholder="<?php _e('Website', 'Maxshop')?>" name="contactwebsite" id="contactwebsite" />
							</fieldset>
							<textarea cols="30" rows="10" name="contactmessage" id="contactmessage"  placeholder="<?php _e('Message', 'Maxshop')?>" ></textarea>
							<?php if(isset($messageError) && $messageError != ''): ?><span class="errorarr"><?php echo $messageError;?></span><?php endif;?>
							<input type="submit"  value="<?php _e('Send message', 'Maxshop')?>" name="send" id="send" />
							<input type="hidden" name = "options" value="<?php echo implode('|', $options) ?>" />
						</form>
                    </div>
				</div>
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div class="span4">
					<div class="contact_info">
						<?php the_content(); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
    </div>
</div>
<script type="text/javascript">
<!-- Contact form validation-->
jQuery(document).ready(function(){

  jQuery(".contactForm").validate({
	submitHandler: function() {
	
		var postvalues =  jQuery(".contactForm").serialize();
		
		jQuery.ajax
		 ({
		   type: "POST",
		  url: "<?php echo get_template_directory_uri()  ?>/contact-form.php",
		   data: postvalues,
		   success: function(response)
		   {
		 	 jQuery("#status").html(response).show('normal');
		     jQuery('#contactmessage, #contactemail, #contactname, #contactwebsite').val("");
		   }
		 });
		return false;
		
    },
	focusInvalid: true,
	focusCleanup: false,
	//errorLabelContainer: jQuery("#registerErrors"),
  	rules: 
	{
		contactname: {required: true},
		contactemail: {required: true, minlength: 6,maxlength: 50, email:true},
		contactmessage: {required: true, minlength: 6}
	},
	
	messages: 
	{
		contactname: {required: "<?php _e( 'Name is required', 'Maxshop' ); ?>"},
		contactemail: {required: "<?php _e( 'E-mail is required', 'Maxshop' ); ?>", email: "<?php _e( 'Please provide a valid e-mail', 'Maxshop' ); ?>", minlength:"<?php _e( 'E-mail address should contain at least 6 characters', 'Maxshop' ); ?>"},
		contactmessage: {required: "<?php _e( 'Message is required', 'Maxshop' ); ?>"}
	},
	
	errorPlacement: function(error, element) 
	{
		error.insertBefore(element);
		jQuery('<span class="errorarr"></span>').insertBefore(element);
	},
	invalidHandler: function()
	{
		//jQuery("body").animate({ scrollTop: 0 }, "slow");
	}
	
});
});

</script>


<?php get_footer(); ?>