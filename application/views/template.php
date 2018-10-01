<?php $config = $this->session->userdata('config'); ?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
    <meta name="author" content="BB 45Trans">
    <title><?php echo $this->session->flashdata('title'); ?> - <?php echo $config['get_title']['value']; ?></title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="/assets/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="/assets/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="/assets/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="/assets/img/apple-touch-icon-144x144-precomposed.png">

    <!-- BASE CSS -->
    <link href="/assets/css/base.css" rel="stylesheet">
    
    <?php if($this->uri->segment(1) == 'tour'){ ?>
    <!-- SPECIFIC CSS -->
    <link href="/assets/css/timeline.css" rel="stylesheet">
    <?php }else if($this->uri->segment(1) == 'cart'){ ?>
    
    <!-- CSS -->
    <link href="/assets/css/jquery.switch.css" rel="stylesheet">
    <link href="/assets/css/date_time_picker.css" rel="stylesheet">
    <?php }else if($this->uri->segment(1) == 'member'){ ?>
    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="/assets/css/jquery.switch.css" rel="stylesheet">
    <?php } ?>
    
    <!-- CSS -->
    <link href="/assets/css/slider-pro.min.css" rel="stylesheet">
    <link href="/assets/css/date_time_picker.css" rel="stylesheet">
    <link href="/assets/css/owl.carousel.css" rel="stylesheet">
	<link href="/assets/css/owl.theme.css" rel="stylesheet">

    <!-- Google web fonts -->
   <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   <link href='https://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
   <link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

    <!-- REVOLUTION SLIDER CSS -->
    <link href="/assets/rs-plugin/css/settings.css" rel="stylesheet">
    <link href="/assets/css/extralayers.css" rel="stylesheet">
    <!-- jQuery Javascript -->
    <script src="/assets/js/jquery-1.11.2.min.js"></script>

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div>
    <!-- End Preload -->

    <div class="layer"></div>
    <!-- Mobile menu overlay mask -->

    <!-- Header================================================== -->
    <header>
        <div id="top_line">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6"><i class="icon-phone"></i><strong><?php echo $config['get_number']['value']; ?></strong></div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <ul id="top_links">
                        	<?php if(!empty($this->session->userdata('auth_client'))){ $ses = $this->session->userdata('auth_client'); ?>
                            <li>
                                <div class="dropdown dropdown-access">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="access_link"><?php echo $ses['first_name'].' '.$ses['last_name']; ?></a>
                                    <div class="dropdown-menu" id="log_out">
                                    	<img height="68" width="68" src="<?php if(!empty($ses['picture'])){ echo $ses['picture']; }else{ echo '/assets/img/default-avatar.png'; } ?>" alt="Welcome <?php echo $ses['first_name'].' '.$ses['last_name']; ?>" class="img-circle">
                                    	<h4><?php echo $ses['first_name'].' '.$ses['last_name']; ?></h4>
                                        <p>Last access <em><?php echo date('d M Y H:i:s', $ses['last_access']); ?></em></p>
                                        <button type="button" class="btn_1 green small"><a href="/member">Profile</a></button>
                                        <button type="button" class="btn_1 green small"><a href="/auth/logout">Log Out</a></button>
                                    </div>
                                </div><!-- End Dropdown access -->
                            </li>
                            <?php }else{ ?>
                            <li><a href="/auth" id="access_link">Sign in</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div><!-- End row -->
            </div><!-- End container-->
        </div><!-- End top line-->
        
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div id="logo_home">
                    	<h1><a href="/" title="<?php echo $config['get_title']['value']; ?>"><?php echo $config['get_title']['value']; ?></a></h1>
                    </div>
                </div>
                <nav class="col-md-9 col-sm-9 col-xs-9">
                    <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                    <div class="main-menu">
                        <div id="header_menu">
                            <img src="/assets/img/logo_sticky.png" width="160" height="34" alt="City tours" data-retina="true">
                        </div>
                        <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                        <ul>
                            <li>
                                <a href="/" class="show-submenu">Home </a>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="show-submenu">All Tours<i class="icon-down-open-mini"></i></a>
                                <ul>
                                    <li><a href="/tours/index">All Tours List</a></li>
                                    <?php foreach($config['get_menus'] as $row) { ?>
                                    <li><a href="/tours/categories/<?php echo $row->id_categories; ?>"><?php echo $row->name; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            
                            <?php foreach($config['get_menus'] as $row){ ?>
                            <li class="megamenu submenu">
                                <a href="javascript:void(0);" class="show-submenu-mega"><?php echo $row->name; ?><i class="icon-down-open-mini"></i></a>
                                <div class="menu-wrapper">
                                    <div class="col-md-4">
                                        <ul id="menu<?=$row->id_categories;?>1">
                                            <?php echo file_get_contents(base_url('welcome/get_menu/'.$row->id_categories.'?p=1')); ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <ul id="menu<?=$row->id_categories;?>2">
                                        <?php echo file_get_contents(base_url('welcome/get_menu/'.$row->id_categories.'?p=2')); ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <ul id="menu<?=$row->id_categories;?>3">
                                        <?php echo file_get_contents(base_url('welcome/get_menu/'.$row->id_categories.'?p=3')); ?>
                                        </ul>
                                    </div>
                                </div><!-- End menu-wrapper -->
                            </li>
                            <?php } ?>

                            <?php foreach($config['menu_dynamic'] as $row){ ?>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="show-submenu"><?=$row->text; ?><i class="icon-down-open-mini"></i></a>
                                <ul>
                                    <?php if(isset($row->children)){ foreach($row->children as $crow) { ?>
                                    <li><a href="<?=$crow->link;?>"><?=$crow->text; ?></a></li>
                                    <?php }} ?>
                                </ul>
                            </li>
                            <?php } ?>

                        </ul>
                    </div><!-- End main-menu -->
                    <ul id="top_tools">
                        <li>
                            <div class="dropdown dropdown-cart">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="txtNameCart"></a>
                                <ul class="dropdown-menu" id="cart_items">
                                    <div id="cart_shop"></div>
                                    <li>
                                        <div>Total: <span id="total_cart"></span></div>
                                        <a href="/cart" class="button_drop outline">Go to cart</a>
                                        <a href="/cart/checkout" class="button_drop outline">Check out</a>
                                    </li>
                                </ul>
                            </div><!-- End dropdown-cart-->
                        </li>
                    </ul>
                </nav>
            </div>
        </div><!-- container -->
    </header><!-- End Header -->
    
    <?= $contents; ?>
    
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <h3>Latest post</h3>
                    <div id="latest_post"></div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h3><?php echo $config['text_link1']['value']; ?></h3>
                    <?php echo $config['footer_link1']['value']; ?>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h3><?php echo $config['text_link2']['value']; ?></h3>
                    <?php echo $config['footer_link1']['value']; ?>
                </div>
                <div class="col-md-2 col-sm-3">
                    <h3>Need help?</h3>
                    <a href="#." id="phone"><?php echo $config['get_number']['value']; ?></a>
                    <a href="#." id="email_footer"><?php echo $config['get_email']['value']; ?></a>
                    <h3><?php echo $config['text_link3']['value']; ?></h3>
                    <?php echo $config['footer_link3']['value']; ?>
                </div>
            </div><!-- End row -->
            <div class="row">
                <div class="col-md-12">
                    <div id="social_footer">
                        <ul>
                        	<?php 
							foreach($config['get_social_media_footer'] as $row){ ?>
                            <li><a href="<?php echo $row->value; ?>" target="_blank"><i class="<?php echo $row->config; ?>"></i></a></li>
                            <?php } ?>
                        </ul>
                        <p><?php echo $config['get_footer_copyright']['value']; ?></p>
                    </div>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
    </footer><!-- End footer -->

<div id="toTop"></div><!-- Back to top button -->

    <!-- Common scripts -->
    <script src="/assets/js/jquery.bootstrap-growl.min.js"></script>
    <script src="/assets/js/common_scripts_min.js"></script>
    <script src="/assets/js/functions.js"></script>

    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script src="/assets/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="/assets/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="/assets/js/revolution_func.js"></script>

    <?php if($this->uri->segment(1) == 'tours' || $this->uri->segment(1) == 'tour'){ ?>
    
    <!-- Date and time pickers -->
	<script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.js"></script>
    <script>
      $('input.date-pick').datepicker('setDate', 'today');
      $('input.time-pick').timepicker({
        minuteStep: 15,
        showInpunts: false
    })
    </script>
    
    <!-- Cat nav mobile -->
	<script  src="/assets/js/cat_nav_mobile.js"></script>
    <script>$('#cat_nav').mobileMenu();</script>

    <?php }else if($this->uri->segment(1) == 'member'){ ?>

    <script src="/assets/js/tabs.js"></script>
    <script>new CBPFWTabs( document.getElementById( 'tabs' ) );</script>
    <script>
        $('.wishlist_close_admin').on('click', function(c){
            $(this).parent().parent().parent().fadeOut('slow', function(c){
            });
        });	
    </script>

    <?php } ?>
    
	<script type="application/javascript">
		$(document).ready(function(){
			get_cart();
            get_latest_post();
		});
		
		function get_cart(){
			setTimeout(function(){
				$.getJSON("<?php echo base_url('tours/cart_shop'); ?>", function(result){
					$("#cart_shop").html(result.cart);
					$("#total_cart").html('$'+result.total);
					$("#txtNameCart").html('<i class=" icon-basket-1"></i>Cart ('+result.totalqty+') ');
				});
			}, 1500);
		}

        function get_latest_post(){
            setTimeout(() => {
                $.getJSON("/welcome/latest_blog", function(result){
                    $("#latest_post").html(result.html);
                });
            }, 1600);
        }
		
		function toast(types, text){
			
			$.bootstrapGrowl(text, {
				type: types,
				align: 'right',
				width: 'auto',
				offset: {from: 'top', amount: 70},
				stackup_spacing: 30
			});
		}
	</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b688e4adf040c3e9e0c5722/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>

</html>