<!DOCTYPE html>
<!--[if lte IE 8]> <html class="ie8" lang="en"> <![endif]-->
<!--[if !IE]><!--> <html lang="en">             <!--<![endif]-->
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Otonomic</title>
    <link href="css/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Exo:100,300,400' rel='stylesheet' type='text/css'>

    <style>
        .p2s_fanpages .media{min-height: 65px !important;}
        .search_results .close-search{ display: block !important;}
    </style>
    <link rel="stylesheet" type="text/css" href="css/media-queries.css?v=0.0.1" />
</head>


<body>
<div class="csszoom" id="parade">
<div class="main">
    <div class="wrapper">
        <header class="head">
            <img src="img/logo.png" class="logo" alt=" " />
            <div class="top_tag">
                <p class="tag1">It's free, efortless, instant and beautiful.</p>
                <p class="tag2">It's your website</p>
            </div>
        </header>
        <div class="content">
            <section class="content_wrap">
                <div class="get_website_input_wrap">
                    <div class="input_box p2s_fanpages">
                        <input id="main_search_box" type="text" class="input_text LoNotSensitive" placeholder="Enter your Facebook page name here (or URL)" />
                        <div class="tb search-wrapper" id="search_wrapper_main"></div>
                        <div style="position: relative;top: -41px;">
                            <span class="icon_clear close-search"><img class="close-search" src="/shared/fanpages/images/close.png" width="32" height="32"/></span>
                        </div>
                    </div>
                    <div class="get_website_submit_btn">
                        <input id="btn_go" type="button" class="submit_btn" value="Get your website" title='Choose your page from the suggestions below' />
                    </div>
                </div>
                <div class="input_shade"></div>
            </section>
        </div>
    </div>
</div>
</div>
<?php include_once('../../../shared/fanpages/fanpage_autoload.php');?>

</body>
</html>
