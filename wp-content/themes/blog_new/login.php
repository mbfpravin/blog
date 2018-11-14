<?php
/***************************
Template Name: Login
****************************/
get_header();
if(is_user_logged_in()) {
    $url = home_url('dashboard');
    wp_redirect( $url );
    exit();
}
$error = 0;
if($_POST)
{
    global $wpdb;
    $username = esc_sql($_REQUEST['username']);
    $password = esc_sql($_REQUEST['password']);

    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;

    $user_verify = wp_signon( $login_data, false );
    if ( is_wp_error($user_verify) )
    {
        $error++;
    } else {
        $url = home_url('dashboard');
        wp_redirect( $url );
        exit();
    }

} else
{
    //echo "Invalid login details";
}
?>
<?php if($error == 1) { ?>
<div class="error-message">Invalid login or password</div>
<?php } ?>

<!-- <form name="loginform" method="post" id="loginform" action="<?php echo home_url(); ?>/login" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
<h2 class="w3-center">Login</h2>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
    <div class="w3-rest">
      <input id="user_login" name="username" class="w3-input w3-border"  type="text" placeholder="Email">
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" type="password" id="user_pass" name="password" placeholder="Password">
    </div>
</div>

<p class="w3-center">
<button class="w3-button w3-section w3-blue w3-ripple"> Send </button>
</p>
</form>

</body>
</html>

<?php
/***************************
Template Name: Login
****************************/
get_header();
?> -->
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/img-01.png" alt="IMG">
				</div>

				<form name="loginform" method="post" id="loginform" action="<?php echo home_url(); ?>/login" class="login100-form validate-form">
					<span class="login100-form-title">
						Member Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" id="user_login" name="username" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" id="user_pass" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					<div class="text-center p-t-136">
						<?php  echo do_shortcode("[apsl-login theme='1' login_text='Social Connect' login_redirect_url='http://localhost:8086']");?>
				    </div>
			<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="<?php echo home_url(); ?>/reset-password">
							Password
						</a>
					</div> -->

					<div class="text-center p-t-136">
						<a class="txt2" href="<?php echo home_url(); ?>/register">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
