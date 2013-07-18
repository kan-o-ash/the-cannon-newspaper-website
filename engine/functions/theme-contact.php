<?php

function dt_contact_form_email(){
	$email = get_option('dt_email_address');
	return $email;
}

function dt_contact_form_subjects(){
	$subjects=get_option('dt_contact_subject');
	return $subjects;
}


function dt_contact_form_display($echo=true){

$output='
	<div class="contact">

            <div class="alert"></div>

            <form method="post" action="' . get_template_directory_uri()  .'/engine/functions/theme-contact.php" class="dt-contactform">

            <fieldset>

            <div class="name">
            	<label accesskey="U">' . __('Name:', 'engine') . '</label>
            	<input type="text" class="dt-name text" value="" />
            </div>

            <div class="email">
            	<label accesskey="E">' .  __('Email:', 'engine') . '</label>
            	<input type="text" class="dt-email text" value="" />
            </div>';



$subjects= dt_contact_form_subjects();
if($subjects != ""):
	$subjects=explode(",", $subjects);

	$output .= '
			<div class="subject multi">
				<label accesskey="S">' .   __('Subject:', 'engine') . '</label>
				<select class="dt-subject">';
				foreach($subjects as $subject):
						$output .= '
						<option value="' . $subject . '">' .  $subject . '</option>';
				endforeach;
	$output .= '
				</select>
			</div>';

else:
	$output .= '
			<div class="subject">
				<label accesskey="S">' .  __('Subject:', 'engine') . '</label>
				<input type="text" class="dt-subject text" value="" />
			</div>';
endif;


$output .= '
		    <div class="message">
            	<label>' .  __('Message:', 'engine') . '</label>
				<textarea cols="30" rows="10" class="dt-comments"></textarea>
            </div>

            <div class="verify">
            	<label accesskey="V">2 + 2 =</label>
            	<input type="text" class="dt-verify text" value="" />
            </div>

            <div class="send">
            	<input type="submit" class="submit" value="'.__('Submit', 'engine').'" />
            </div>

            </fieldset>

            </form>

	</div>';

if(!$echo)
	return $output;

echo $output;

}

add_action('wp_ajax_dt_contact_form', 'dt_send_contact_form');
add_action('wp_ajax_nopriv_dt_contact_form', 'dt_send_contact_form');

function dt_send_contact_form(){


if(!$_REQUEST){
		exit;
	}

		$name		= $_REQUEST['name'];
        $email		= $_REQUEST['email'];
        $subject	= $_REQUEST['subject'];
        $comments	= $_REQUEST['comments'];
        $verify		= $_REQUEST['verify'];
        $error		= '';

		if(trim($name) == '') {
        	echo '<div class="error_message">'. __('Attention! Please enter your name.', 'engine').'</div>';
			exit();
        } else if(trim($email) == '') {
        	echo '<div class="error_message">'. __('Attention! Please enter your email address.', 'engine').'</div>';
			exit();
        } else if(!isEmail($email)) {
        	echo '<div class="error_message">'. __('Attention! Invalid email address, please try again.', 'engine').'</div>';
			exit();
        }

        /* if(trim($subject) == '') {
        	echo '<div class="error_message">Attention! Please enter a subject.</div>';
			exit();
        } else */
		if(trim($comments) == '') {
        	echo '<div class="error_message">'. __('Attention! Please enter your message.', 'engine').'</div>';
			exit();
        } else if(trim($verify) == '') {
	    	echo '<div class="error_message">'. __('Attention! Please enter the verification number.', 'engine').'</div>';
			exit();
	    } else if(trim($verify) != '4') {
	    	echo '<div class="error_message">'. __('Attention! The verification number you entered is incorrect.', 'engine').'</div>';
			exit();
	    }
		
        if($error == '') {

			if(get_magic_quotes_gpc()) {
            	$comments = stripslashes($comments);
            }


        // Configuration option.
		// Enter the email address that you want the emails to be sent to.
		// Example $address = "joe@yourdomain.com";

        $address = dt_contact_form_email();


        // Configuration option.
        // The standard subject will appear as, "You've been contacted by John Doe."
        // Example, $e_subject = 'You\'ve been contacted by ' . $name . '.';

        $e_subject = '[Contact Form] ' . $subject . ', from ' . $name . '';


        // Configuration option.
		// You can change this if you feel that you need to.
		// Developers, you may wish to add more fields to the form, in which case you must be sure to add them here.

		$e_body = "You have been contacted by $name with regards to $subject." ."\r\n\n";
		$e_content = "Name: $name\r\nEmail: $email\r\nSubject: $subject\r\n\nMessage:\r\n$comments\r\n\n";
		$e_reply = "";

        $msg = $e_body . $e_content . $e_reply;

		if(!$address or $address=="")
			$address=get_option('admin_email');

        if(wp_mail($address, $e_subject, $msg, __('From:', 'engine') . " $email\r\n". __('Reply-To:', 'engine') ." $email\r\n" . __('Return-Path:', 'engine') . " $email\r\n")) {


		// Email has sent successfully, echo a success page.
		$sent = __('Email Sent Successfully', 'engine');
		$thanks = __('Thank you, your message has been submitted.', 'engine');

		echo "<fieldset>";
		echo "<div class='success_message'>";
		echo "<h2>$sent</h2>";
		echo "<p>$thanks</p>";
		echo "</div>";
		echo "</fieldset>";
		die;

		} else {

		echo 'ERROR! ' ;

		}

	}

	die();



}

function isEmail($email) { // Email address verification, do not edit.

	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|™|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));

	}