<?php
/***************************
Template Name: Change Password
****************************/
get_header();
/*if(is_user_logged_in()) {
    $url = home_url('dashboard');
    wp_redirect( $url );
    exit();
}*/
if(is_user_logged_in()) {
$user = wp_get_current_user();
}
$error = 0;
$success = 0;
if($_POST)
{
    global $wpdb;
    $password = esc_sql($_REQUEST['password']);

    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;

    $user_verify = wp_set_password( $password, $user->data->ID );
    if ( is_wp_error($user_verify) )
    {
        $error++;
    } else {
        $success = 1;
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
<?php if($success == 1) { ?>
<div class="error-message">Successfully changed your password</div>
<?php } ?>
<div class="limiter">
  <div class="container-login100">
    <div class="wrap-login100">
      <div class="login100-pic js-tilt" data-tilt>
        <img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/img-01.png" alt="IMG">
      </div>

      <form name="changepasswordform" id="changepasswordform" action="" method="post" class="login100-form validate-form">
        <span class="login100-form-title">
          Change password
        </span>

        <div class="wrap-input100 validate-input" data-validate = "Password is required">
          <input class="input100" type="password" id="password" name="password" placeholder="New Password">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
          </span>
        </div>
        <input type="hidden" name="userid" value="Change password">
        <div class="container-login100-form-btn">
          <button name="wp-submit" id="wp-submit" class="login100-form-btn">
            Login
          </button>
          <input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>/login">
        </div>

        <!-- <div class="text-center p-t-12">
          <span class="txt1">
            Change
          </span>
          <a class="txt2" href="#">
             Password?
          </a>
        </div> -->

        <!-- <div class="text-center p-t-136">
          <a class="txt2" href="<?php echo home_url(); ?>/register">
            Create your Account
            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
          </a>
        </div> -->
      </form>
    </div>
  </div>
</div>

<?php get_footer(); ?>
