<?php
/***************************
Template Name: Dashboard
****************************/
get_header('main');
if(!is_user_logged_in()) {
    $url = home_url('login');
    wp_redirect($url,302);
}

?>

<div id="page-contents">
  <div class="container">
    <div class="row">

      <!-- Newsfeed Common Side Bar Left
      ================================================= -->
      <div class="col-md-3 static">
        <div class="profile-card">
          <img src="<?php echo get_avatar_url(); ?>" alt="user" class="profile-photo" />
          <h5><a href="<?php echo home_url(); ?>/favourite" class="text-white"><?php echo  $current_user->display_name ;?></a></h5>
        </div>
      </div>
 
      <div class="col-md-7">
        <?php
        
          global $post;
          $blogArgs = array(
              'post_type'     => 'post',
              'numberposts' => -1,
              'order'         => 'DESC', 
              'orderby'       => 'post_date',
              'post_status'   => 'publish',
              'meta_query' => array(
                   array(
                       'key' => 'show_in_home',
                       'value' => 'yes'
                   )                                                
               ),   
          ); 
          $blogPages = get_posts($blogArgs);
        //     foreach($blogPages as $blogPage){
                 
        //  echo $postid = $blogPage->ID;
        // }
        // exit();
          foreach($blogPages as $blogPage){
                          $featImage = wp_get_attachment_url(get_post_thumbnail_id($blogPage->ID) );
                          $content = apply_filters('the_content',$blogPage->post_content);
          $usrid = get_current_user_id();
          $postid = $blogPage->ID;
          // $postid=get_the_id();
          $query = "SELECT * FROM ".$wpdb->prefix."favourite WHERE usrid=".$usrid." AND postid=".$postid;
          $result = $wpdb->get_row($query);
        ?>
        <div class="post-content">
          <img src="<?php echo $featImage ?>" alt="post-image" class="img-responsive post-image" />
          <div class="post-container">
            <div class="post-detail">
                <div class="user-info">
                  <h5><?php echo $blogPage->post_title; ?></h5>
                  <p class="text-green">Author :<?php echo get_the_author(); ?></p>
                  <p class="text-muted">Published <?php echo get_the_date( 'F jS, Y', $blogPage->ID); ?></p>
                </div>
                <div class="stage">
                    <div class="heart <?php if($result!=""){ echo "is-active";}?>" data-user="<?php echo $usrid; ?>" data-postid="<?php  echo $postid = $blogPage->ID; ?>" ></div>
                </div>
                  <div class="reaction">
                  </div>
                <div class="line-divider"></div>
                  <div class="post-text">
                    <p><?php echo $blogPage->post_content; ?></p>
                  </div>
                      <input type="hidden" name="usrid" id="usrid" value="<?php echo $usrid; ?>" />
                      <input type="hidden" name="postid" id="postid" value="<?php echo $postid; ?>" />
                      
                      <button  class="chBox fav_list_add" name="checkbox" id="favourite" value="1" ><?php if($result!=""){ echo "Remove favourite";}else {echo "Add to favourite";}?></button> 
            </div>
          </div>
        </div>
        <?php } ?>
    </div>
  </div>
</div>
<?php get_footer('main'); ?>
