<?php
/***************************
Template Name: Booknow
****************************/
get_header('main');
?>
<div class="google-maps">
      <div id="map" class="map contact-map"></div>
    </div>
    <div id="page-contents">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-10 col-md-offset-1">
            <div class="contact-us">
            	<div class="row">
            		<div class="col-md-8 col-sm-7">
                  <h4 class="grey">Booking form</h4>
                  <form class="contact-form">
                    <div class="form-group">
                      <i class="icon ion-person"></i>
                       <?php 
                       $formPage = get_post($_REQUEST['id']); 
                       ?>
                      <input id="contact-name"  name="event_name" class="form-control" placeholder="<?php echo $formPage->post_title; ?>" required="required" data-error="Name is required." value="<?php echo $formPage->post_title; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <i class="icon ion-person"></i>
                      <input id="contact-name" type="text" name="name" class="form-control" placeholder="Enter your name *" required="required" data-error="Name is required.">
                    </div>
                    <div class="form-group">
                      <i class="icon ion-email"></i>
                      <input id="contact-email" type="text" name="email" class="form-control" placeholder="Enter your email *" required="required" data-error="Email is required.">
                    </div>
                    <div class="form-group">
                      <i class="icon ion-android-call"></i>
                      <input id="contact-phone" type="text" name="phone" class="form-control" placeholder="Enter your phone *" required="required" data-error="Phone is required.">
                    </div>
                    <div class="form-group">
                      <textarea id="form-message" name="message" class="form-control" placeholder="Enter your Message*" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                    </div>
                    <button class="btn-primary">Book Now</button>
                  </form>
                </div>
            	</div>
            </div>
          </div>
    		</div>
    	</div>
    </div>
  <?php get_footer('main'); ?>