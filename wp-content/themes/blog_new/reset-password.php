<?php
/***************************
Template Name: Reset password
****************************/
get_header();?>
<div class="limiter">
  <div class="container-login100">
    <div class="wrap-login100">
      <div class="login100-pic js-tilt" data-tilt>
        <img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/img-01.png" alt="IMG">
      </div>

      <form name="resetpasswordform" id="resetpasswordform" action="" method="post" class="login100-form validate-form">
        <span class="login100-form-title">
          Enter Vaild Email
        </span>

        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
          <input class="input100" type="text" id="user_login" name="username" placeholder="Email">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </span>
        </div>
        <input type="hidden" name="userid" value="Change password">
        <div class="container-login100-form-btn">
          <button name="wp-submit" id="wp-submit" class="login100-form-btn">
            Reset Password <?php echo apply_filters('the_content'); ?>
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
<?php get_footer(); ?>
