   <?php
/***************************
Template Name: favourite
****************************/

get_header('main');
if(!is_user_logged_in()) {
    $url = home_url('login');
    wp_redirect($url,302);
}
function get_current_user_role() {
  global $wp_roles;
  $current_user = wp_get_current_user();
  $roles = $current_user->roles;
  $role = array_shift($roles);
  return isset($wp_roles->role_names[$role]) ? translate_user_role($wp_roles->role_names[$role] ) : false;
}
?>
    <div class="container">

      <!-- Timeline
      ================================================= -->
      <div class="timeline">
        <div class="timeline-cover">

          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                  <img src="<?php echo get_avatar_url(); ?>" alt="" class="img-responsive profile-photo" />
                  <h3><?php echo  $current_user->display_name ;?></h3>
                  <p class="text-muted"><?php echo get_current_user_role(); ?></p>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  
                  <li><a href="timeline-album.html">Album</a></li>
                  <li><a href="<?php echo get_bloginfo('template_url'); ?>/dashboard">Dashboard</a></li>
                </ul>
                
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->

          <!--Timeline Menu for Small Screens-->
          <div class="navbar-mobile hidden-lg hidden-md">
            <div class="profile-info">
              <img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/gr.jpg" alt="" class="img-responsive profile-photo" />
              <h4><?php echo  $current_user->display_name ;?></h4>
              <p class="text-muted"><?php echo get_current_user_role(); ?></p>
            </div>
            <div class="mobile-menu">
              
            </div>
          </div><!--Timeline Menu for Small Screens End-->

        </div>
        <div id="page-contents">
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-7">
              <div class="edit-profile-container">
                <div class="block-title">
                  <h4 class="grey"><i class="icon ios-heart"></i>Favourite list</h4>
                  <div class="line"></div>
                  <div class="line"></div>
                </div>
                <div class="edit-block">
                  <?php  $user = wp_get_current_user(); 
                   $favourites = $wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."favourite WHERE usrid=".$user->data->ID);
                    foreach ($favourites as $favourite) {
                      $postData = get_post($favourite->postid);
                  ?>
                  <div class="line"></div>
                  <div class="settings-block">
                    <div class="row">
                      <div class="col-sm-9">
                        <div class="switch-description">
                          <div><strong><?php echo $postData->post_title; ?></strong></div>
                          <p><?php echo $postData->post_excerpt; ?></p>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="toggle-switch">
                          <label class="switch">
                            <input type="checkbox" id="deleted" checked>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-md-2 static">
            
         
            </div>
          </div>
        </div>
      </div>
    </div>
<?php get_footer('main'); ?>