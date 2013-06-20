<!DOCTYPE html>
<html>
<head>
<title>Jack in the box</title>
<link rel="Shortcut Icon" type="image/x-icon" href="images/start/favicon.ico" />
<link href="stylesheets/screen.css" rel="stylesheet" type="text/css"/>
<link href="stylesheets/video.css" rel="stylesheet" type="text/css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<script type="text/javascript" src="js/libs/modernizr.js"></script>
<script type="text/javascript" src="js/libs/jquery.js"></script>
<!-- disable loading msg -->
 <script>
$(document).on("mobileinit", function(){
 $.mobile.loadingMessage = false;
});
 </script>
<!-- / -->
<script type="text/javascript" src="js/libs/jquery_mob.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2RYXUom_wqIe1vEdjBHvByKDXrlwniNA&sensor=true"></script>
<script type="text/javascript" src="js/navigation.js"></script>
</head>

<body>
<div id="container">
    {$header}
    <div id="start_balk">
        <header>
            <nav>
                <a id="start_store_locator" href="#store"></a>
                <a id="start_burger_showoff" href="#list"></a>
            </nav>
            <div id="start_vinger_logo"></div>
        </header>
    </div>
    <div id="start_blur_bg">
        <h1>Become a chef!</h1>
        <p>3000 <span></span> CHEFS, NOW YOU CAN MAKE YOUR OWN BURGER!</p>
    </div>
    <div id="start_table_box">
        <div id="start_table">
            <div id="start_cola"></div>
            <div id="start_ui"></div>
            <div id="start_kaas"></div>
            <div id="start_vlees"></div>
            <div id="start_groenten"></div>
            <div id="start_burger"></div>
            <a id="start_create_a_burger" href="#start"><span>Create a burger</span></a>
        </div>
    </div>
    <div id="content_bottom">
    {$content}
    </div>
</div>
<script type="text/javascript" src="js/libs/QTransform.js"></script>
<script type="text/javascript" src="js/libs/isotope.js"></script>
<script type="text/javascript" src="js/animation.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="js/video.js"></script>
</body>
</html>