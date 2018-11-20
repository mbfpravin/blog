<!DOCTYPE html>
<html lang="en">
	<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title><?php echo get_bloginfo('name'); ?></title>

		<script type="text/javascript">
				var templateUri = "<?php echo get_bloginfo('template_url'); ?>";
				var blogUri = "<?php echo get_bloginfo('url'); ?>";
				var templateUri = '<?php echo TMPL_URL; ?>';
		</script>
		<!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/app/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/app/css/style.css" />
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/app/css/ionicons.min.css" />
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/app/css/font-awesome.min.css" />
    <link href="<?php echo get_bloginfo('template_url'); ?>/app/css/emoji.css" rel="stylesheet">

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">

    <!--Favicon-->
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url'); ?>/assets/images/icons/favicon.ico"/>
	</head>
  <body>

    <!-- Header
    ================================================= -->
		<header id="header">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- <a class="navbar-brand" href="index-register.html"><img src="<?php echo get_bloginfo('template_url'); ?>/img/home-logo.png" alt="logo" /></a> -->
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">
              <li class="dropdown"><a class="txt2" href="<?php echo home_url(); ?>/events">Events</a></li>
              <li class="dropdown"><a class="txt2" href="<?php echo home_url(); ?>/favourite">Profile</a></li>
<!--               <li class="dropdown"><a class="txt2" href="<?php echo home_url(); ?>/change-password">Change Password</a></li>
 -->              <li class="dropdown"><a <?php if($slug =="logout") { ?> class="active" <?php } ?> href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
            </ul>
            <form class="navbar-form navbar-right hidden-sm">
              <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="text" class="form-control" placeholder="Search friends, photos, videos">
              </div>
            </form>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>
    <!--Header End-->
