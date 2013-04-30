<?php
$root = $_SERVER['DOCUMENT_ROOT'];
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}

header("Content-type: text/css");

/**********************************************************
Body Options	
**********************************************************/
 ?>
body {
<?php
// set up custom body background properties
if (of_get_option('global-custom-background')) :
	$body_bg = of_get_option('body-background');

	if ($body_bg['color']) { ?>
	background-color : <?php echo $body_bg['color']; ?>;
	<?php
	}
	
	if ($body_bg['image']) {?>
	background-image : url('<?php echo $body_bg['image'] ?>');
	<?php
	
	if ($body_bg['repeat']) { ?>
	background-repeat : <?php echo $body_bg['repeat']; ?>;
	<?php
	}
	
	if ($body_bg['position']) { ?>
	background-position : <?php echo $body_bg['position']; ?>;
	<?php
	}
	
	if ($body_bg['attachment']) { ?>
	background-attachment : <?php echo $body_bg['attachment']; ?>;
	<?php
	}
	}
	

endif;
?>
}

<?php





/**********************************************************
#wrapper Options	
**********************************************************/
// set up our dynamic layout properties
?>
#wrapper {
<?php
/*
	Are we using full width or framed layout
*/
if ('framed' == of_get_option('site-layout')) :
	
// get the site-width property then add some padding space
$width = of_get_option('site-width')  . 'px';
?>
	width : <?php echo $width ?>;
	max-width : 100%;
	margin : 20px auto;
<?php

	if (of_get_option('frame-shadow')) : 
		
	$shadowSize = of_get_option('frame-shadow-size') ? intval(of_get_option('frame-shadow-size')) . 'px': '4px';
	$shadowColor = of_get_option('frame-shadow-color') ? of_get_option('frame-shadow-color') : '#999999'; 
	
	?>
	box-shadow : 0 0 <?php echo $shadowSize . ' ' . $shadowColor; ?>;
<?php
	endif; //end frame shadow
	
	
	if ($border= of_get_option('frame-border')) : ?>
	border : 1px solid <?php echo $border; ?>;
<?php
	endif; //end frame shadow

endif; // end framed?


/*
	Set our custom #wrapper background image
*/
if (of_get_option('global-custom-background')) :
	
	$wrapper_bg = of_get_option('wrapper-background');
	
	if ($wrapper_bg['color']) { ?>
	background-color : <?php echo $wrapper_bg['color']; ?>;
	<?php
	}
	
	// output image properties if image set
	if ($wrapper_bg['image']) {
	// if we have an image, output it and then include the other image options
	?>
	background-image : url('<?php echo $wrapper_bg['image'] ?>');
	<?php
	// image repeat
	if ($wrapper_bg['repeat']) { ?>
	background-repeat : <?php echo $wrapper_bg['repeat']; ?>;
	<?php
	}
	// image position
	if ($wrapper_bg['position']) { ?>
	background-position : <?php echo $wrapper_bg['position']; ?>;
	<?php
	}
	// image attachement
	if ($wrapper_bg['attachment']) { ?>
	background-attachment : <?php echo $wrapper_bg['attachment']; ?>;
	<?php
	}
	
	} // endif image
	
	
endif; // end if global-custom-background
?>
}
<?php




/**********************************************************
Header Options	
**********************************************************/
// set up custom header properties
if ($header_bg = of_get_option('header-background')) :
?>
#header {
	<?php
	if ($header_bg['color']) { ?>
	background-color : <?php echo $header_bg['color']; ?>;
	<?php
	}
	
	if ($header_bg['image']) {?>
	background-image : url('<?php echo $header_bg['image'] ?>');
	<?php
	// if we have a header image setting then look for the other image related settings
	if ($header_bg['repeat']) { ?>
	background-repeat : <?php echo $header_bg['repeat']; ?>;
	<?php
	}
	
	if ($header_bg['position']) { ?>
	background-position : <?php echo $header_bg['position']; ?>;
	<?php
	}
	
	if ($header_bg['attachment']) { ?>
	background-attachment : <?php echo $header_bg['attachment']; ?>;
	<?php
	}
	}
	?>
}
<?php
endif;
/**********************************************************
Logo Options	
**********************************************************/
// set up custom logo properties
if ($sLogo = of_get_option('site-logo')):
	// get the logo dimensions
	$size = getimagesize($sLogo);
?>
#branding h2 a {
	background-image : url('<?php echo $sLogo; ?>');
	width : <?php echo $size[0] ?>px;
	height : <?php echo $size[1] ?>px;
}
<?php
endif; // end if site-logo







// set up custom content properties
if ($content_bg = of_get_option('content-background')) :
?>
#content {
	<?php
	if ($content_bg['color']) { ?>
	background-color : <?php echo $content_bg['color']; ?>;
	<?php
	}
	
	if ($content_bg['image']) {?>
	background-image : url('<?php echo $content_bg['image'] ?>');
	<?php
	// if we have a header image setting then look for the other image related settings
	if ($content_bg['repeat']) { ?>
	background-repeat : <?php echo $content_bg['repeat']; ?>;
	<?php
	}
	
	if ($content_bg['position']) { ?>
	background-position : <?php echo $content_bg['position']; ?>;
	<?php
	}
	
	if ($content_bg['attachment']) { ?>
	background-attachment : <?php echo $content_bg['attachment']; ?>;
	<?php
	}
	}
	?>
}
<?php
endif;

// set up custom footer properties
if ($footer_bg = of_get_option('footer-background')) :
?>
#footer {
	<?php
	if (of_get_option('footer-custom-background')) :
	
	if ($footer_bg['color']) { ?>
	background-color : <?php echo $footer_bg['color']; ?>;
	<?php
	}
	
	if ($footer_bg['image']) {?>
	background-image : url('<?php echo $footer_bg['image'] ?>');
	<?php
	// if we have a header image setting then look for the other image related settings
	if ($footer_bg['repeat']) { ?>
	background-repeat : <?php echo $footer_bg['repeat']; ?>;
	<?php
	}
	
	if ($footer_bg['position']) { ?>
	background-position : <?php echo $footer_bg['position']; ?>;
	<?php
	}
	
	if ($footer_bg['attachment']) { ?>
	background-attachment : <?php echo $footer_bg['attachment']; ?>;
	<?php
	}
	}
	endif; // end footer-custom-background
	
	if (of_get_option('footer-custom-text')) :
		# code...
	endif; // end if footer-custom-text
	?>
}
<?php
endif;
?>