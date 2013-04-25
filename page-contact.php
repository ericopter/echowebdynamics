<?php
/**
 * Template Name: Contact Page
 */

$requiredFields = array(
	'contact-name' => 'Please enter your full name',
	'contact-email' => 'Please enter your email address',
	'contact-phone' => 'Please enter your phone number',
	'contact-message' => 'Please enter a message'
);

$echoPost = array();
$errors = array();

if ( of_get_option('use-recaptcha') ) {

    if ( !function_exists('_recaptcha_qsencode') ) {
		require_once('inc/scripts/recaptcha/recaptchalib.php');
    }

    $publickey = of_get_option('recaptcha-public-key'); // you got this from the signup page
    $privatekey = of_get_option('recaptcha-private-key'); // you got this from the signup page
    $resp = null;
    $error = null;
    
	if( isset($_POST['submit']) ) {
		$resp = recaptcha_check_answer($privatekey,
		    $_SERVER["REMOTE_ADDR"],
		    $_POST["recaptcha_challenge_field"],
		    $_POST["recaptcha_response_field"]
		);
		if ( !$resp->is_valid ) {
	    	$rCaptcha_error = $resp->error;
		}
    }
}

if (isset($_POST['submit'])) {
	$echoPost = $_POST;
	
	foreach ($requiredFields as $name => $message) {
		$value = trim($echoPost[$name]);
		
		if (strlen($value) == 0) {
			$errors[$name] = $requiredFields[$name];
		}
	}
	
	$name = $echoPost['contact-name'];
	$email = $echoPost['contact-email'];
	$phone = $echoPost['contact-phone'];
	$message = $echoPost['contact-message'];
	
	if (count($errors) == 0) {
		$email_to = of_get_option('email-recipients');
		$subject = sprintf(__('Contact Form submission from %s', 'echotheme'), get_option('blogname') );
		$message_contents = __("Sender's name: ", 'echotheme') . $name . "\r\n" .
				    __('E-mail: ', 'echotheme') . $email . "\r\n" .
				    __('Phone #: ', 'echotheme') . $phone ."\r\n\r\n" .
				    __('Message: ', 'echotheme') . " \r\n" . $message . " \r\n";
		
		$header = "From: $name <".$email.">\r\n";
		$header .= "Reply-To: $email\r\n";
		$header .= "Return-Path: $email\r\n";
		$emailSent = ( @wp_mail( $email_to, $subject, $message_contents, $header ) ) ? true : false;
		
		unset($echoPost);
	}
	

}
get_header();
?>
<!-- page-contact.php -->
<div id="contact" class="sixteen columns">
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
	
	<div class="row">
		<?php 
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-content">
				<?php
				if ($image = get_the_post_thumbnail(get_the_ID(), 'medium')) :
				?>
				<div class="post-thumbnail image-frame floatR">
					<?php echo $image; ?>
				</div> <!-- end .post-thumbnail -->
				<?php
				endif;
				?>
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div>
	
	<div id="contact-form-wrapper" class="row">

		<?php if ($emailSent): ?>
			<section id="contact-thanks">
				<article>
					<header>
						<h1>
							<?php echo $name; ?>,
							<br />
							Thank you for your interest!
						</h1>
					</header>
					We appreciate you contacting us and someone will respond to you soon.
				</article>
			</section>
		<?php endif; ?>

		<form action="<?php echo the_permalink(); ?>" method="post" id="contact-form">
			<div class="row">
				<label for="contact-name">Name:</label>
				<input type="text" name="contact-name" value="<?php if (isset($echoPost['contact-name'])) {echo $echoPost['contact-name'];} ?>" id="contact-name" />
				<?php if (isset($errors['contact-name'])): ?>
				<div class="error">
					<?php echo $errors['contact-name']; ?>
				</div> <!-- end .error -->
				<?php endif; ?>
			</div> 

			<div class="row">
				<label for="contact-email">Email:</label>
				<input type="text" name="contact-email" value="<?php if (isset($echoPost['contact-email'])) {echo $echoPost['contact-email'];} ?>" id="contact-email" />
				<?php if (isset($errors['contact-email'])): ?>
				<div class="error">
					<?php echo $errors['contact-email']; ?>
				</div> <!-- end .error -->
				<?php endif; ?>
			</div>

			<div class="row">
				<label for="contact-phone">Phone:</label>
				<input type="text" name="contact-phone" value="<?php if (isset($echoPost['contact-phone'])) {echo $echoPost['contact-phone'];} ?>" id="contact-phone" />
				<?php if (isset($errors['contact-phone'])): ?>
				<div class="error">
					<?php echo $errors['contact-phone']; ?>
				</div> <!-- end .error -->
				<?php endif; ?>
			</div>

			<div class="row">
				<label for="contact-message">Message:</label>
				<textarea name="contact-message" rows="7" cols="70" value="<?php if (isset($echoPost['contact-message'])) {echo $echoPost['contact-message'];} ?>" id="contact-message"></textarea>
				<?php if (isset($errors['contact-message'])): ?>
				<div class="error">
					<?php echo $errors['contact-message']; ?>
				</div> <!-- end .error -->
				<?php endif; ?>
			</div> 

			<?php 
			if ($theme = of_get_option('use-recaptcha')) : 
			?>
		    <script type="text/javascript">var RecaptchaOptions = {theme : '<?php echo of_get_option('recaptcha-theme'); ?>'};</script>
			<div class="row" id="form-captcha">
				<?php 
				echo recaptcha_get_html( $publickey, $rCaptcha_error ); 
				?>
				<?php if (isset($rCaptcha_error)): ?>
				<div class="error">
					Incorrect Captcha Value
				</div> <!-- end .error -->
				<?php endif; ?>

			</div>
			<br />
			<?php endif; ?>
			<div class="row submit">
				<input type="submit" name="submit" value="Send" />
			</div>
		</form>

	</div>
	
</div> <!-- end #contact -->


<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		// focus on first error
		// $('div.error').first().closest('div.row').find('input').focus();
		
		// clear form errors on focus
		$('#contact-form input, #contact-form textarea, #form-captcha input').focus(function() {
			$(this).closest('div.row').find('.error').hide();
		});
	});
</script>

<?php
get_footer();
?>