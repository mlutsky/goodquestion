<!doctype html>
<html>
    <head>
    	<title>GoodQuestion</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
        <!--<link rel="stylesheet" href="jquery.ui.datepicker.mobile.css" /> 
        <script src="jQuery.ui.datepicker.js"></script>
        <script src="jquery.ui.datepicker.mobile.js"></script>-->
        <!--<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.css"/>
    <link rel="stylesheet" href="http://jquerymobile.com/demos/1.0a4.11.0a4.1/experiments/ui-datepicker/jquery.ui.datepicker.mobile.css" />
    <script src="http://code.jquery.com/jquery-1.5.min.js"></script>
    <script src="http://jquerymobile.com/demos/1.0a4.1/experiments/ui-datepicker/jQuery.ui.datepicker.js"></script>
    <script src="http://jquerymobile.com/demos/1.0a4.1/experiments/ui-datepicker/jquery.ui.datepicker.mobile.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.js"></script>-->
        <style>
			/* color scheme and styling modifications based on HackHarvard showcase mobile app */
            h3 {
                margin-bottom: 0 !important;
            }

            h4 {
                font-size: 12px !important;
            }
            
            #browse-icon .ui-icon {
                background:  url(/magnify.png) 50% 50% no-repeat; 
                background-size: 18px;
                border-radius: 0;
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
            }

            #shopping-icon .ui-icon {
                background:  url(/shopping-cart.png) 50% 50% no-repeat; 
                background-size: 18px;
                border-radius: 0;
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
            }

            #taking-icon .ui-icon {
                background:  url(/gameplan.png) 50% 50% no-repeat; 
                background-size: 18px;
                border-radius: 0;
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
            }

            .logo {
                color: white;
                display: block;
                margin: 9px auto;
                text-align: center;
                font-size: 100%;
            }
            
            a {
                text-decoration: none;
                color: white;
            }
            
            a:visited {
                color: white;
            }

            a:active {
                color: white;
            }

            h1 {
                /*margin-bottom: 0 !important;
                margin-top: 0 !important;*/
            }

            .ui-btn-active {
                background: #ac0000;
            }
            
            .ui-li .ui-btn-inner a.ui-link-inherit, .ui-li-static.ui-li {
                padding: .4em 15px .4em 15px !important;
            }

            .ui-li-aside {
                font-weight: bold;
                font-size: 13.5px;
            }

            #subtitle {
                text-align:center;
                font-size:200%;
            }

            /* Buttons */
            .btn.success {
                background-color:green;
            }
            .btn.danger {
                background-color:red;
            }


        </style>

        <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
        <? $this->load->helper('url'); ?>
        <script src="<?= base_url();?>default.js"></script>
        <script src="<?= base_url();?>datetimepicker.js"></script>
</head>
<body>
	<div id="fb-root"></div>
	<script>

		var selectedFriends = new Array();

		window.fbAsyncInit = function() {
		FB.init({
		appId      : '343055252404315',
		status     : true, 
		cookie     : true,
		xfbml      : true,
		oauth      : true,
		frictionlessRequests: true
		});

		FB.getLoginStatus(function(response) {
			if (response.authResponse) {
                onFacebookLogin();
			} else {
				console.log("not logged in");
			}
		});
        };

	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=343055252404315";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

    </script>

        <div data-role="page" id="<?= $page ?>" data-add-back-btn="true">
        <div data-role="header">
            <?php if($page == 'searchEvents'): ?>
                <a href="/main" data-icon="home" data-direction="reverse">Home</a>
            <?php endif; ?>
            <div style="height:40px;vertical-align:text-bottom;">
                <a href="/main"><h1 class="logo">GoodQuestion</h1></a>
            </div>
        </div>
        <div data-role="content">
            <ul data-role="listview">
                <!--
            	<li>
            		<form action="/courses/searchCourses/" method="post">
            		    <input type="search" name="search" id="searc-basic" placeholder="type a course title, department, professor..." />
            		    <input type="submit" value="search" />
            		</form>
            	</li>
                search questions eventually -->
                <!--<li>
                <div class="fb-login-button" scope="email, friends_online_presence" onlogin="onFacebookLogin();">Login with Facebook!</div>
                </li>-->
