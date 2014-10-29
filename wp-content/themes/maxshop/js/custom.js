/*jshint jquery:true */
/*global $:true */

jQuery(document).ready(function() {
	"use strict";
    
    jQuery("select").selectBox();

    jQuery( ".slider-slides" ).cycle({
        pager:'.slider-btn',
        prev: '.prev',
        next: '.next'
    });
    
    jQuery( ".sub-menu").addClass('clearfix');
	
	// *****************Compare button***********************/
	jQuery('.icon>.compare').addClass('three tooltip');
	jQuery('.product-detail>.compare').addClass('big-button');
	jQuery(".compare").attr("title", "add to compare");
	//remove text in product list
	jQuery(".icon>.compare").text("");
	jQuery(".icon .three").text("");

	//*******************Wishlist button************************/
	jQuery('.icon .add_to_wishlist').addClass('two tooltip');
	jQuery('.product-detail .add_to_wishlist').addClass(' wish big-button');
	jQuery(".add_to_wishlist").attr("title", "add to wishlist");
	jQuery(".icon .two").text("");
	
	// Toggles
	jQuery(".toggle-container").hide();
	jQuery(".toggle-trigger").click(function(e){
		e.preventDefault();
		jQuery(this).toggleClass("open").next().slideToggle(500);
		return false;
	});

    // ToolTip
    jQuery('.tooltip').tooltipster({
        theme: '.tooltipster-punk'
    });
    

    // Lightbox
    jQuery("a.zoom").prettyPhoto({
        social_tools: ''
    });

    jQuery("nav ul li").hover(function(){
        jQuery(this).children('ul').stop(true, true).fadeIn(700);
    }, function(){
        jQuery(this).children('ul').stop(true, true).fadeOut(500);
    });

    jQuery(".offers figure").hover(function(){
        jQuery(this).children('.overlay').stop(true, true).fadeIn(700);
    }, function(){
        jQuery(this).children('.overlay').stop(true, true).fadeOut(500);
    });

    jQuery(".product figure").hover(function(){
        jQuery(this).children('.overlay').stop(true, true).fadeIn(700);
    }, function(){
        jQuery(this).children('.overlay').stop(true, true).fadeOut(500);
    });

    jQuery('#carousel').elastislide({
        speed : 2000
    });

    jQuery('footer .back-top a').click(function(e){
        e.preventDefault();
        jQuery("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });

    //ACCORDION
    jQuery( "#accordion" ).accordion();
    jQuery( "#check-accordion" ).accordion();
    jQuery(".check-accordion2").accordion();


    jQuery('.product figure .overlay a').hover(
        function(){
            jQuery(this).stop().animate(
                {backgroundPosition: "(0 -41px)"},
                {duration:500}
            );
        },
        function(){
            jQuery(this).stop().animate(
                {backgroundPosition: "(0 0)"},
                {duration:500}
            );
        }
    );

    jQuery('.sorting-bar .sorting-btn a').hover(
        function(){
            jQuery(this).stop().animate(
                {backgroundPosition: "(0 -29px)"},
                {duration:500}
            );
        },
        function(){
            jQuery(this).stop().animate(
                {backgroundPosition: "(0 0)"},
                {duration:500}
            );
        }
    );

    jQuery('.detail .icon a').hover(
        function(){
            jQuery(this).stop().animate(
                {backgroundPosition: "(0 -42.3px)"},
                {duration:500}
            );
        },
        function(){
            jQuery(this).stop().animate(
                {backgroundPosition: "(0 0)"},
                {duration:500}
            );
        }
    );

    jQuery('footer .social-icon a').hover(
        function(){
            jQuery(this).stop().animate(
                {backgroundPosition: "(0 -20px)"},
                {duration:500}
            );
        },
        function(){
            jQuery(this).stop().animate(
                {backgroundPosition: "(0 0)"},
                {duration:500}
            );
        }
    );
        jQuery('.social-icon a').hover(
        function(){
            jQuery(this).stop().animate(
                {backgroundPosition: "(0 -20px)"},
                {duration:500}
            );
        },
        function(){
            jQuery(this).stop().animate(
                {backgroundPosition: "(0 0)"},
                {duration:500}
            );
        }
    );

    jQuery('#carousel').carouFredSel({
        responsive: true,
        circular: false,
        auto: false,
        items: {
            visible: 1,
            width: 200,
            height: '56%'
        },
        prev: '.prev',
        next: '.next',
        scroll: {
            fx: 'fade'
        }
    });

    jQuery('#thumbs').carouFredSel({
        responsive: true,
        circular: false,
        infinite: false,
        auto: false,
        prev: '#prev',
        next: '#next',
        items: {
            visible: {
                min: 2,
                max: 6
            }
        }
    });

    jQuery('#thumbs a').click(function(e) {
		e.preventDefault();
        jQuery('#carousel').trigger('slideTo', '#' + this.href.split('#').pop() );
        jQuery('#thumbs a').removeClass('selected');
        jQuery(this).addClass('selected');
        return false;
    });

    jQuery( "#product_tabs" ).tabs();

// Range
    jQuery( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 1325,
        values: [ 0, 600 ],
        slide: function( event, ui ) {
            jQuery( "#amount" ).val("jQuery" + ui.values[0]);
			jQuery( "#amount2" ).val("jQuery" + ui.values[1]);
        }
    });
    jQuery( "#amount" ).val( "jQuery" + jQuery( "#slider-range" ).slider( "values", 0 ) );
    jQuery( "#amount2" ).val( "jQuery"+ jQuery( "#slider-range" ).slider( "values", 1 ) );


});
/********* Contact Widget *************/
function checkemail(emailaddress){
	"use strict";
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i); 
	return pattern.test(emailaddress); 
}

jQuery(document).ready(function(){ 
	"use strict";
	jQuery('#registerErrors, .widgetinfo').hide();		
	var $messageshort = false;
	var $emailerror = false;
	var $nameshort = false;
	var $namelong = false;
	
	jQuery('#contactFormWidget input#wformsend').click(function(){ 
		var $name = jQuery('#wname').val();
		var $email = jQuery('#wemail').val();
		var $message = jQuery('#wmessage').val();
		var $contactemail = jQuery('#wcontactemail').val();
		var $contacturl = jQuery('#wcontacturl').val();
		var $subject = jQuery('#wsubject').val();
	
		if ($name !== '' && $name.length < 3){ $nameshort = true; } else { $nameshort = false; }
		if ($name !== '' && $name.length > 30){ $namelong = true; } else { $namelong = false; }
		if ($email !== '' && checkemail($email)){ $emailerror = true; } else { $emailerror = false; }
		if ($message !== '' && $message !== 'Message' && $message.length < 3){ $messageshort = true; } else { $messageshort = false; }
		
		jQuery('#contactFormWidget .loading').animate({opacity: 1}, 250);
		
		if ($name !== '' && $nameshort !== true && $namelong !== true && $email !== '' && $emailerror !== false && $message !== '' && $messageshort !== true && $contactemail !== ''){ 
			jQuery.post($contacturl, 
				{type: 'widget', contactemail: $contactemail, subject: $subject, name: $name, email: $email, message: $message}, 
				function(/*data*/){
					jQuery('#contactFormWidget .loading').animate({opacity: 0}, 250);
					jQuery('.form').fadeOut();
					jQuery('#bottom #wname, #bottom #wemail, #bottom #wmessage').css({'border':'0'});
					jQuery('.widgeterror').hide();
					jQuery('.widgetinfo').fadeIn('slow');
					jQuery('.widgetinfo').delay(2000).fadeOut(1000, function(){ 
						jQuery('#wname, #wemail, #wmessage').val('');
						jQuery('.form').fadeIn('slow');
					});
				}
			);
			
			return false;
		} else {
			jQuery('#contactFormWidget .loading').animate({opacity: 0}, 250);
			jQuery('.widgeterror').hide();
			jQuery('.widgeterror').fadeIn('fast');
			jQuery('.widgeterror').delay(3000).fadeOut(1000);
			
			if ($name === '' || $name === 'Name' || $nameshort === true || $namelong === true){ 
				jQuery('#wname').css({'border-left':'4px solid #red'}); 
			} else { 
				jQuery('#wname').css({'border-left':'4px solid #929DAC'}); 
			}
			
			if ($email === '' || $email === 'Email' || $emailerror === false){ 
				jQuery('#wemail').css({'border-left':'4px solid red'});
			} else { 
				jQuery('#wemail').css({'border-left':'4px solid #929DAC'}); 
			}
			
			if ($message === '' || $message === 'Message' || $messageshort === true){ 
				jQuery('#wmessage').css({'border-left':'4px solid red'}); 
			} else { 
				jQuery('#wmessage').css({'border-left':'4px solid #929DAC'}); 
			}
			
			return false;
		}
	});
});
