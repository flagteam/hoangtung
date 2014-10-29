<?php $alc_options = isset($_POST['options']) ? $_POST['options'] : get_option('alc_general_settings');?>
<!-- FOOTER -->
<?php if (is_active_sidebar('footer-top-sidebar')):?>
	<div class="shipping-wrap">
		<div class="container">
			<div class="row">
				<div class="span12">
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Top Sidebar") ) :endif;?>
				</div>
			</div>
		</div>
	</div>
<?php endif?>
<div class="footer-wrap">
	<div class="container">
		<div class="row">
			<div class="footer clearfix">
				<?php
				$footer_widget_count = isset($alc_options['alc_footer_widgets_count']) ? $alc_options['alc_footer_widgets_count']:0;
				if($footer_widget_count > 0):
					for($i = 1; $i<= $footer_widget_count; $i++){
						if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Widget ".$i) ) :endif;
					}			
				endif; ?>	
			</div>
			<footer>
				<div class="row">
					<div class="span5">
						<p><?php echo $alc_options['alc_copyright']?></p>
					</div>
					<div class="span2 back-top">
						<a href="#" class="scrollup"><img src="<?php echo get_template_directory_uri().'/images/back.png' ?>" alt=""></a>
					</div>
					<div class="span5">
						<?php if (isset($alc_options['alc_footer_social'])):?>
							<div class="social-icon">       
								<?php echo do_shortcode($alc_options['alc_footer_social'])?>
							</div>
						<?php endif?>
					</div>
				</div>
			</footer>
		</div>
	</div>
</div>
<!-- FOOTER -->

<?php if (isset($alc_options['alc_custom_js'])) echo $alc_options['alc_custom_js']; ?>
<?php wp_footer()?>
</body>
</html>