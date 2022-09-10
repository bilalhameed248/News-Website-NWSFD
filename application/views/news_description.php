<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wpkixx.com/html/pitnik/fav-events.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 12:26:06 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>NwsFD</title>
    <link rel="icon" href="<?php echo base_url().'public/rss_feed_images/favicon.png' ?>" type="image/png" sizes="16x16"> 

    <link rel="stylesheet" href="<?php echo base_url();?>public/css/main.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>public/css/weather-icon.css">
	<link rel="stylesheet" href="<?php echo base_url();?>public/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/color.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/responsive.css">

</head>
<body>
<!-- <div class="wavy-wraper">
		<div class="wavy">
		  <span style="--i:1;">p</span>
		  <span style="--i:2;">i</span>
		  <span style="--i:3;">t</span>
		  <span style="--i:4;">n</span>
		  <span style="--i:5;">i</span>
		  <span style="--i:6;">k</span>
		  <span style="--i:7;">.</span>
		  <span style="--i:8;">.</span>
		  <span style="--i:9;">.</span>
		</div>
	</div> -->
<div class="theme-layout">
	
	<div class="responsive-header">
		<div class="mh-head first Sticky">
			<span class="mh-btns-left">
				<a class="" href="#menu"><i class="fa fa-align-justify"></i></a>
			</span>
			<span class="mh-text">
				<a href="newsfeed.html" title=""><img src="images/logo2.png" alt=""></a>
			</span>
			<span class="mh-btns-right">
				<a class="fa fa-sliders" href="#shoppingbag"></a>
			</span>
		</div>
		<div class="mh-head second">
			<form class="mh-form">
				<input placeholder="search" />
				<a href="#/" class="fa fa-search"></a>
			</form>
		</div>
	</div><!-- responsive header -->
	
	<div class="topbar stick" style="background-color: red;">
		<div class="logo">
			<a title="" href="<?php echo base_url();?>"><img style="margin-left: 250px; margin-top: 25px; border: 5px solid #555;" src="<?php echo base_url().'public/rss_feed_images/favicon.png' ?>" alt=""></a>
		</div>
		<div class="top-area">
			<?php if(isset($_SESSION['logged_in']))
			{
			?>
			<div class="user-img">
				<h5><?php echo $this->session->userdata('full_name'); ?></h5>
				<!-- <img src="images/resources/admin.jpg" alt=""> -->
				<span class="status f-online"></span>
				<div class="user-setting">
					<span class="seting-title">User setting <a href="#" title="">see all</a></span>
					<ul class="log-out">
						<li><a href="<?php echo base_url();?>home/logout" title=""><i class="ti-power-off"></i>log out</a></li>
					</ul>
				</div>
			</div>
		<?php } ?>
			<!-- <span class="ti-settings main-menu" data-ripple=""></span> -->
		</div>		
	</div><!-- topbar -->
		
	<section>
		<div class="gap2 gray-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="row merged20" id="page-contents">
							<div class="col-lg-12">
									<div class="central-meta">
										<div class="row">
											<div class="col-lg-12">
												
												<div class="event-box">
													<div class="row merged20">
														<div class="col-lg-4 col-md-4 col-sm-5">
															<figure class="event-thumb" style="margin-top: 16%;"><img src="<?php echo $news_detail->image_url;?>" alt=""></figure>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-5">
															<div class="event-title">
																<span><i class="fa fa-clock-o"><?php echo $news_detail->created_at; ?></i></span>
																<h1>
																	<a href="<?php echo base_url().'home/news_description/'.$news_detail->id?>" title=""><?php echo $news_detail->title; ?>

																	</a>
																</h1>
																<ul class="sociaz-media">
																	<li>
																		<a title="" href="https://www.facebook.com/sharer.php?t=XBOX&u=<?php echo $news_detail->url;?>" class="facebook">
																			<i class="fa fa-facebook">
																				
																			</i>
																		</a>
																	</li>

																	<li><a title="" href="https://twitter.com/intent/tweet?text=<?php echo $news_detail->url;?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
																	<!-- <li><a title="" href="#" class="instagram"><i class="fa fa-instagram"></i></a></li> -->
																</ul>
																<p style="color: blue;">
																	<a href="<?php echo $news_detail->url;?>">
																		<b>See Detail</b>
																	</a>
																</p>
																<p style="color: black;">
																	<?php echo $news_detail->description; ?>
																</p>
															</div>
														</div>
														<div class="col-lg-2 col-md-2 col-sm-2">
															<div class="event-time">
																<span class="event-date">
																	<?php 
																		$date = new DateTime($news_detail->created_at);
																		$monthNum=date_format($date, 'n');
																		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
																		$monthName = $dateObj->format('F');
																		echo date_format($date, 'd')." ".$monthName; 
																	 ?>
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div><!-- centerl meta -->
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section><!-- content -->

	<!-- <a title="Your Cart Items" href="shop-cart.html" class="shopping-cart" data-toggle="tooltip">Cart <i class="fa fa-shopping-bag"></i><span>02</span></a> -->

	<div class="bottombar" style="position: fixed; bottom: 0; background-color: red; color: white;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<span style="margin-right: 30px;">
					<a title="" href="<?php echo base_url().'home/view_privacy_policy' ?>">EULU</a>
					</span>
					<span style="margin-right: 30px;">
					<a title="" href="<?php echo base_url().'home/view_privacy_policy' ?>">Privacy Policy</a>
					</span>
					<span style="margin-right: 30px;">
					<a title="" href="<?php echo base_url().'home/view_privacy_policy' ?>">About</a>
					</span>
					<!-- <span class="copyright"><h5>Follow Us On: </h5></span> -->
					<a title="" href="https://twitter.com/NWSFDdotcom"><img style="height: 40px; float: right;" src="<?php echo base_url().'public/rss_feed_images/twiter.png' ?>" alt=""></a>
					<a title="" href="https://twitter.com/NWSFDdotcom"><img style="height: 40px; float: right;" src="<?php echo base_url().'public/rss_feed_images/instagram.png' ?>" alt=""></a>
				</div>
			</div>
		</div>
	</div><!-- bottom bar -->
</div>
	<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="<?php echo base_url();?>public/js/main.min.js"></script>
	<script src="<?php echo base_url();?>public/js/script.js"></script>
	<script src="<?php echo base_url();?>public/js/map-init.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

</body>	

<!-- Mirrored from wpkixx.com/html/pitnik/fav-events.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 12:26:20 GMT -->
</html>