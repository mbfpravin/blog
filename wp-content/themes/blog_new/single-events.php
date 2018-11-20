<?php
get_header('main');
$featImage = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$usrid = get_current_user_id();
          $postid = $_REQUEST['id'];
?>
<div id="page-contents">
  <div class="container">
    <div class="row">
      <div class="col-md-3 static">
      </div>
      <div class="col-md-7">
        <div class="post-content">
          <img src="<?php echo $featImage ?>" alt="post-image" class="img-responsive post-image" />
          <div class="post-container">
            <div class="post-detail">
                <div class="user-info">
                  <h5><?php echo $post->post_title; ?></h5>
                </div>
                <div class="line-divider"></div>
                  <div class="post-text">
                    <p><?php echo $post->post_content; ?></p>
                     <h4 class="grey">Booking form</h4>
                    <form method="post" class="contact-form" data-user="<?php echo $usrid; ?>" data-postid="<?php echo $postid = $post->ID; ?>">
                    <div class="form-group">
                      <i class="icon"></i>
                       <?php 
                       $formPage = get_post($_REQUEST['id']); 
                       ?>
                      <input id="ename"  name="event_name" class="form-control" placeholder="<?php echo $formPage->post_title; ?>" required="required" data-error="Name is required." value="<?php echo $formPage->post_title; ?>" disabled>
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
                    <input type="submit" class="btn-primary" id="book" data-user="<?php echo $usrid; ?>" data-postid="<?php echo $postid = $post->ID; ?>" value="Book Now" />
                  </form>
                  </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<?php get_footer('main'); ?>