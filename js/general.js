$(document).ready(function() {
	$('body').removeClass('no-js');
	$('body').addClass('js-enabled');

	$('form input').each(function() {
		var val = $(this).val();

		$(this).focus(function() {
			if ($(this).val() == val) {
				$(this).val('');
			};
		});

		$(this).blur(function() {
			if ($(this).val() == '') {
				$(this).val(val);
			};
		});
	});
	
	jQuery('.hori-nav').superfish({
		speed : 'fast'
	});
});

// Content Toggle
jQuery(function($){
    // Initial state of toggle (hide)
    $(".slide_toggle_content").hide();
    // Process Toggle click (http://api.jquery.com/toggle/)
    $("h4.slide_toggle").toggle(function(){
	    $(this).addClass("clicked");
	}, function () {
	    $(this).removeClass("clicked");
    });
    // Toggle animation (http://api.jquery.com/slideToggle/)
    $("h4.slide_toggle").click(function(){
	$(this).next(".slide_toggle_content").slideToggle();
    });
});

// Tabs code
jQuery(function($){
	$('ul.tabs > li > a').click(function(e) {
		//Get Location of tab's content
	    var contentLocation = $(this).attr('href');

	    //Let go if not a hashed one
	    if(contentLocation.charAt(0)=="#") {

	        e.preventDefault();

	        //Make Tab Active
	        $(this).parent().siblings().children('a').removeClass('active');
	        $(this).addClass('active');

	        //Show Tab Content & add active class
	        $(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
	    }
	})
});
