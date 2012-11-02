<!doctype html>
<html>
    <head>
    	<title>HarvardCourses</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
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
                display: block;
                margin: 0 auto;
                text-align: center;
            }

            .ui-btn-active {
                background: #ac0000;
            }

            h1 {
                margin-bottom: 0 !important;
                margin-top: 0 !important;
            }

            .ui-li .ui-btn-inner a.ui-link-inherit, .ui-li-static.ui-li {
                padding: .4em 15px .4em 15px !important;
            }

            .ui-li-aside {
                font-weight: bold;
                font-size: 13.5px;
            }

        </style>

        <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
        <? $this->load->helper('url'); ?>
    <script src="<? echo base_url();?>default.js"></script>
</head>
	<body>
		<div id="shopping" data-role="page">
			<div data-role="header">
				<div>
					<h2 class="logo">HarvardCourses</h2>
				</div>
			</div>
			<div data-role="content">
				<ul data-role="listview" id="courselist">
					<li>
						<form action="/courses/searchCourses/" method="post">
            		        <input type="search" name="search" id="searc-basic" placeholder="type a course title, department, professor..." />
            		        <input type="submit" value="search" />
            		    </form>
					</li>
				</ul>
			</div>
			<div data-role="footer" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a id="browse-icon" data-icon="custom" href="/courses/">Browse</a></li>
						<li><a id="shopping-icon" data-icon="custom" href="#" class="ui-btn-active ui-state-persist" data-ajax="false">Shopping</a></li>
						<li><a id="taking-icon" data-icon="custom" href="/courses/taking" data-ajax="false">Taking</a></li>
					</ul>
				</div>
			</div>
			
		</div>
	</body>
</html>
