<?php
/***************************
Template Name: Register
****************************/
get_header();
if(defined('REGISTRATION_ERROR')){
    foreach(unserialize(REGISTRATION_ERROR) as $error)
      echo "<div class='error-message'>{$error}</div>";
  // errors here, if any

}elseif(defined('REGISTERED_A_USER')){
  $url = home_url('login');
  wp_redirect( $url );
    }
?>
<div class="limiter">
  <div class="container-login100">
    <div class="wrap-login100">
      <div class="login100-pic js-tilt" data-tilt>
        <img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/img-01.png" alt="IMG">
      </div>

      <form action="<?php echo add_query_arg('do', 'register'); ?>"  method="post" id="register-form" class="login100-form validate-form">
        <span class="login100-form-title">
         Registrations
        </span>
        <div class="wrap-input100 validate-input" data-validate = "firstname is required">
          <input class="input100" type="text" name="user" id="user" placeholder="First Name">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
          </span>
        </div>
        <div class="wrap-input100 validate-input" data-validate = "lasstname is required">
          <input class="input100" type="text" name="last_name" id="last_name" placeholder="Last Name">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
          </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
          <input class="input100" type="text" name="email" id="email" placeholder="Email">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </span>
        </div>
        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
          <input class="input100" type="text" name="company" id="company" placeholder="Company">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-handshake-o" aria-hidden="true"></i>
          </span>
        </div>
        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
          <input class="input100" type="text" name="mobileno" id="mobileno" placeholder="Mobile">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-mobile" aria-hidden="true"></i>
          </span>
        </div>
        <!-- <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
          <input class="input100" type="text" name="contactno" id="contactno" placeholder="Contact number">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </span>
        </div> -->

        <div class="wrap-input100 validate-input" data-validate = "Password is required">
          <input class="input100" type="password" name="pass1" id="pass1" placeholder="Password">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
          </span>
        </div>
        <div class="wrap-input100 validate-input" data-validate = "Password is required">
          <input class="input100" type="password" name="pass2" id="pass2" placeholder="Confirm Password">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
          </span>
        </div>

        <input type="hidden" name="spam" class="form-control" value="" />
        <div class="container-login100-form-btn">
          <button  id="register" class="login100-form-btn">
            Register
          </button>
        </div>

        <!-- <div class="text-center p-t-12">
          <span class="txt1">
            Forgot
          </span>
          <a class="txt2" href="#">
            Username / Password?
          </a>
        </div> -->

        <div class="text-center p-t-136">
          <a class="txt2" href="<?php echo home_url(); ?>/login">
            Already a member? Login here
            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php get_footer(); ?>
