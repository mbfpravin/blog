<?php
	@ini_set( 'upload_max_size' , '64M' );
	@ini_set( 'post_max_size', '64M');
	@ini_set( 'max_execution_time', '300' );
	add_action('init', 'init_custom_load');
	if (!defined('TMPL_URL')) {
	    define('TMPL_URL', get_template_directory_uri());
	}
	function init_custom_load(){

	if(is_admin()) {
	    wp_enqueue_style('admin_css', TMPL_URL.'/lib/css/admin_css.css', false, '1.0', 'all');
	    wp_enqueue_style('font-awesome.min', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
	    wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	    wp_enqueue_script('admin_js', TMPL_URL.'/js/lib/admin.js', false, '1.0', 'all');
	}
	}
	remove_action('wp_head', 'wp_generator');
	show_admin_bar(false);
	require_once(ABSPATH . 'wp-admin/includes/user.php');

	/* For post types and metabox */
	require_once(TEMPLATEPATH . "/lib/admin-config.php");

	/* Featured Image */
	add_theme_support('post-thumbnails');

	/*	Menu Backend */
	add_theme_support( 'menus' );
    add_theme_support( 'widgets' );

	/*	Multipost Thumbnail Image */
   if (class_exists('MultiPostThumbnails')) {
    	$types = array('post_type_name');
    	foreach($types as $type) {
    		new MultiPostThumbnails(array('label' => 'custom_label_name', 'id' => 'custom_image_id', 'post_type' => $type));
    	}

    };
	/*	For Excerpt */
	add_post_type_support('page', 'excerpt');

	/* Format the content */
	function content_formatter($content) {
	    $bad_content = array('<p></div></p>', '<p><div class="full', '_width"></p>', '</div></p>', '<p><ul', '</ul></p>', '<p><div', '<p><block', 'quote></p>', '<p><hr /></p>', '<p><table>', '<td></p>', '<p></td>', '</table></p>', '<p></div>', 'nosidebar"></p>', '<p><p>', '<p><a', '</a></p>', '_half"></p>', '_third"></p>', '_fourth"></p>', '<p><p', '</p></p>', 'child"></p>', '<p></p>');
	    $good_content = array('</div>', '<div class="full', '_width">', '</div>', '<ul', '</ul>', '<div', '<block', 'quote>', '<hr />', '<table>', '<td>', '</td>', '</table>', '</div>', 'nosidebar">', '<p>', '<a', '</a>', '_half">', '_third">', '_fourth">', '<p', '</p>', 'child">', '');
	    $new_content = str_replace($bad_content, $good_content, $content);
	    return $new_content;
	}
	remove_filter('the_content', 'wpautop');
	add_filter('the_content', 'wpautop', 10);
	add_filter('the_content', 'content_formatter', 11);

	/* For empty paragraph */
	function shortcode_empty_paragraph_fix_tag($content) {
	   $array = array(
	      '<p>[' => '[',
	      ']</p>' => ']',
	      '<p></p>' => '',
	      ']<br />' => ']'
	   );
	   $content = strtr($content, $array);
	   return $content;
	}

	/*********
    Remove Image Height and Width
    **********/

	function remove_width_attribute( $html ) {
	 $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	 return $html;
	}
	add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10,3 );
	add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

	add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
	function remove_thumbnail_dimensions( $html ) {
	  $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	  return $html;
	}
	/*********
    Remove P tag from images
    **********/
	function filter_ptags_on_images($content) {
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
	}
	add_filter('acf_the_content', 'filter_ptags_on_images');
	add_filter('the_content', 'filter_ptags_on_images');

	/********To support svg *************/
   	function cc_mime_types($mimes) {
 		$mimes['svg'] = 'image/svg+xml';
 		return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');


 	/*********Post-Tags*********/
	add_action( 'init', 'gp_register_taxonomy_for_object_type' );

	function gp_register_taxonomy_for_object_type() {
	 	$types = array( 'post_types' );
	 	foreach ($types as $type) {
		 	register_taxonomy_for_object_type( 'post_tag', $type );
	 	}
	};

	/********
	Shortcodes
	*********/

	function span( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<span>'.do_shortcode($content).'</span>';
	}
	add_shortcode('span', 'span');

	function break_tag( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '</br>';
	}
	add_shortcode('break_tag', 'break_tag');

	function div_tag( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div>'.do_shortcode($content).'</div>';
	}
	add_shortcode('div_tag', 'div_tag');

	function col_8_center($atts, $content = null) {
    	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	    $content=shortcode_empty_paragraph_fix_tag($content);
	    return ' <div class="col-8 center-block">' .do_shortcode($content).'
		            </div>';

	}
	add_shortcode('col_8_center', 'col_8_center');

	function accordion_container($atts, $content = null) {
    	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	    $content=shortcode_empty_paragraph_fix_tag($content);
	    return ' <div class="component-accordion">' .do_shortcode($content).'</div>';

	}
	add_shortcode('accordion_container', 'accordion_container');

	function accordion_row($atts, $content = null) {
    	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	    $content=shortcode_empty_paragraph_fix_tag($content);
	    return '<div class="accordion-blk">' .do_shortcode($content).'</div>';

	}
	add_shortcode('accordion_row', 'accordion_row');

	function accordion_content($atts, $content = null) {
    	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	    $content=shortcode_empty_paragraph_fix_tag($content);
	    return '<div class="accordion-content">' .do_shortcode($content).'</div>';

	}
	add_shortcode('accordion_content', 'accordion_content');

	function row($atts, $content = null) {
    	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	    $content=shortcode_empty_paragraph_fix_tag($content);
	    return '<div class="row">' .do_shortcode($content).'</div>';

	}
	add_shortcode('row', 'row');

	function six_column($atts, $content = null) {
    	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	    $content=shortcode_empty_paragraph_fix_tag($content);
	    return '<div class="col-6">' .do_shortcode($content).'</div>';

	}
	add_shortcode('six_column', 'six_column');

	function eight_column($atts, $content = null) {
    	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	    $content=shortcode_empty_paragraph_fix_tag($content);
	    return '<div class="col-8">' .do_shortcode($content).'</div>';

	}
	add_shortcode('eight_column', 'eight_column');

	function four_column($atts, $content = null) {
    	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	    $content=shortcode_empty_paragraph_fix_tag($content);
	    return '<div class="col-4"><div class= "subsection">' .do_shortcode($content).'</div></div>';

	}
	add_shortcode('four_column', 'four_column');


	function video_content( $atts, $content = null ) {
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		$content=shortcode_empty_paragraph_fix_tag($content);
		return '<div class= "video-section"><div class="embed-responsive embed-responsive-16by9 video-section "> <iframe class="embed-responsive-item" src="'.$atts["videosrc"].'" allowfullscreen></iframe> </div>'.
		do_shortcode($content).'</div>';
	}
	add_shortcode('video_content', 'video_content');


// function custom_loginlogo() {
// echo '<style type="text/css">
// h1 a {background: url('.get_bloginfo('template_directory').'/img/logosub.png) no-repeat center !important; display: block; height: 90px !important; width: auto !important; }
// .login,html{ background: #150e20 url('.get_bloginfo('template_directory').'/admin/images/generic-img1.jpg) repeat-x !important; background-position: center bottom !important; }
// </style>';
// }
// add_action('login_head', 'custom_loginlogo');
//
//
//
// if ( ! function_exists( 'wp_css_login' ) ){
// function wp_css_login(){
// echo '<link href="'.get_bloginfo('template_directory').'/admin/css/wp-login.css" rel="stylesheet" media="all"  />';
// }
// add_action('login_head','wp_css_login');
// }

/**
 * Registration form
 *
 */

add_action('template_redirect', 'register_a_user');
function register_a_user(){
      if(isset($_GET['do']) && $_GET['do'] == 'register'):
        $errors = array();
        if(empty($_POST['user']) || empty($_POST['email'])) $errors[] = 'provide a user and email';
        if(!empty($_POST['spam'])) $errors[] = 'gtfo spammer';
        if(!empty($_POST['pass1']) && !empty($_POST['pass2'])) $error[] = 'The passwords you entered do not match';

        $user_login = esc_attr($_POST['user']);
        $user_email = esc_attr($_POST['email']);
        $first_name = esc_attr($_POST['first_name']);
        $last_name = esc_attr($_POST['last_name']);
        $company = esc_attr($_POST['company']);
        // $contactno = esc_attr($_POST['contactno']);
        $mobileno = esc_attr($_POST['mobileno']);
        $user_pass = esc_attr($_POST['pass1']);
        $user_pass2 = esc_attr($_POST['pass2']);

        $sanitized_user_login = sanitize_user($user_login);
        $user_email = apply_filters('user_registration_email', $user_email);

        if(!is_email($user_email)) $errors[] = 'invalid e-mail';
        elseif(email_exists($user_email)) $errors[] = 'this email is already registered, bla bla...';

        if(empty($sanitized_user_login) || !validate_username($user_login)) $errors[] = 'invalid user name';
        elseif(username_exists($sanitized_user_login)) $errors[] = 'user name already exists';

        if(empty($errors)):
     if ( $_POST['pass1'] == $_POST['pass2'] ) {

     $user_data = array (
            'user_login' => $sanitized_user_login,
            'user_pass' => $user_pass,
            'user_email' => $user_email,
            'first_name' => $user_login,
            'last_name' => $last_name,
            'company' => $company,
            'mobileno' => $mobileno,
        );

        // Create the user
        $user_id = wp_insert_user( $user_data );

    } else {
    $errors[] = 'passwords dont match';
    }


          if(!$user_id):
            $errors[] = 'registration failed...';
          else:
            wp_new_user_notification($user_id);
          endif;
        endif;

        if(!empty($errors)) define('REGISTRATION_ERROR', serialize($errors));
        else define('REGISTERED_A_USER', $user_email);
      endif;
}

add_action( 'register_form', 'myplugin_register_form' );
add_action( 'show_user_profile', 'myplugin_register_form' );
add_action( 'edit_user_profile', 'myplugin_register_form' );

function myplugin_register_form($user) {
    $accountnumber = date("Y").date('l').str_pad($user->ID, 4, '0', STR_PAD_LEFT);

    $company = ( ! empty( $_POST['company'] ) ) ? sanitize_text_field( $_POST['company'] ) : '';
        ?>
        <table class="form-table">
            <tbody>
                <tr class="user-company-wrap">
                    <th><label for="company">Company</label></th>
                    <td> <input type="text" name="company" id="company" class="input" value="<?php echo get_the_author_meta( 'company', $user->ID ); ?>" size="25" />
                    </td>
                </tr>
                <tr class="user-mobileno-wrap">
                    <th><label for="mobileno">Mobile number</label></th>
                    <td> <input type="text" name="mobileno" id="mobileno" class="input" value="<?php echo get_the_author_meta( 'mobileno', $user->ID ); ?>" size="25" />
                    </td>
                </tr>
                <tr class="user-contactno-wrap">
                    <th><label for="contactno">Contact number</label></th>
                    <td> <input type="text" name="contactno" id="contactno" class="input" value="<?php echo get_the_author_meta( 'contactno', $user->ID ); ?>" size="25" />
                    </td>
                </tr>
                <tr class="user-useracctno-wrap">
                    <th><label for="useracctno">User account number</label></th>
                    <td> <input type="text" name="useracctno" id="useracctno" class="input" value="<?php echo $accountnumber; ?>" size="25" />
                    </td>
                </tr>
                <tr class="user-administrator-wrap">
                    <th><label for="contactno">Administrator</label></th>
                    <td><input type="checkbox" name="administrator" id="administrator" value="yes"  <?php if(get_the_author_meta( 'administrator', $user->ID ) == "yes") { echo 'checked="checked"'; } ?>/>
                    </td>
                </tr>
                <tr class="user-trainer-wrap">
                    <th><label for="contactno">Trainer</label></th>
                    <td><input type="checkbox" name="trainer" id="trainer" value="yes"  <?php if(get_the_author_meta( 'trainer', $user->ID ) == "yes") { echo 'checked="checked"'; } ?>/>
                    </td>
                </tr>

        </tbody>
    </table>
        <?php
    }

    //2. Add validation. In this case, we make sure first_name is required.
    add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
    function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {

        if ( empty( $_POST['company'] ) || ! empty( $_POST['company'] ) && trim( $_POST['company'] ) == '' ) {
        $errors->add( 'company_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'mydomain' ),__( 'You must include company.', 'mydomain' ) ) );

        }

        return $errors;
    }

    //3. Finally, save our extra registration user meta.
    add_action( 'user_register', 'myplugin_user_register' );
    add_action( 'personal_options_update', 'myplugin_user_register' );
    add_action( 'edit_user_profile_update', 'myplugin_user_register' );

		function myplugin_user_register( $user_id ) {

        if ( ! empty( $_POST['company'] ) ) {
            update_user_meta( $user_id, 'company', sanitize_text_field( $_POST['company'] ) );
        }

        if ( ! empty( $_POST['mobileno'] ) ) {
            update_user_meta( $user_id, 'mobileno', sanitize_text_field( $_POST['mobileno'] ) );
        }

        if ( ! empty( $_POST['contactno'] ) ) {
            update_user_meta( $user_id, 'contactno', sanitize_text_field( $_POST['contactno'] ) );
        }
        //if ( ! empty( $_POST['useracctno'] ) ) {
            update_user_meta( $user_id, 'useracctno', sanitize_text_field( $_POST['useracctno'] ) );
       // }
            update_user_meta( $user_id, 'administrator', sanitize_text_field( $_POST['administrator'] ) );
            update_user_meta( $user_id, 'trainer', sanitize_text_field( $_POST['trainer'] ) );
    }


     function send_welcome_email_to_new_user($user_id) {
    $user = get_userdata($user_id);
    $user_email = $user->user_email;
    // for simplicity, lets assume that user has typed their first and last name when they sign up
    $user_full_name = $user->user_firstname . $user->user_lastname;

    // Now we are ready to build our welcome email
    $to = $user_email;
    $subject = "Hi " . $user_full_name . ", welcome to our site!";
    $body = '<h1>Dear ' . $user_full_name . ',</h1></br>
              <p>Thank you for joining. Your account is now active.</p>
              <p>Please go ahead and navigate around your account.</p>
              <p>Let me know if you have further questions, I am here to help.</p>
              <p>Enjoy the rest of your day!</p>';
    $from = "Certificate Module<no-reply@certificate.in>";
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers .= "From: " .  $from."\r\n";
    if (wp_mail($to, $subject, $body, $headers)) {
      error_log("email has been successfully sent to user whose email is " . $user_email);
    }else{
      error_log("email failed to sent to user whose email is " . $user_email);
    }
  }

  // THE ONLY DIFFERENCE IS THIS LINE
  add_action('user_register', 'send_welcome_email_to_new_user');
  // THE ONLY DIFFERENCE IS THIS LINE

?>
