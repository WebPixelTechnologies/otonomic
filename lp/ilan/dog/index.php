<!DOCTYPE html>
<!--[if lte IE 8]> <html class="ie8" lang="en"> <![endif]-->
<!--[if !IE]><!--> <html lang="en">             <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Otonomic - turn your Facebook page into a professional website</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body{background: #201717;}
        .search_results .close-search{ display: block !important;}
    </style>
    <link rel="stylesheet" type="text/css" href="css/media-queries.css?v=0.0.2" />
</head>

<body>
    <div class="csszoom" id="dog">
        <div class="wrapper">
            <div id="main">
                <div class="container">
                    <div class="top_wraper">
                        <h1 class="slogan" id="slogan">If only I had a website...</h1>
                        <div class="make_my_website" id="make_my_website">
                            <table class="table_form">
                            <tr class="form_input2">
                                <td>
                                    <div style="position: relative" class="p2s_fanpages">
                                        <input id="main_search_box" type="text" class="input_type LoNotSensitive" value="" name="fName" placeholder="Enter your Facebook page name (or URL)">
                                        <div class="facebook_icon"></div>
                                        <div class="tb search-wrapper" id="search_wrapper_main"></div>
                                        <span class="icon_clear close-search"><img class="close-search" src="/shared/fanpages/images/close.png" width="32" height="32"/></span>
                                    </div>
                                </td>
                                <td id="btn_go" class="input_title" title='Choose your page from the suggestions below'>Make my Website</td>
                            </tr>
                            </table>
                        </div>
                        <div class="txt">It's free, automatic and instant. &nbsp;
                <!-- <a href="#"><span style=" color: #009dc4; text-decoration: underline;">Learn more</span></a></div> -->
                    </div>
                        <div class="social">
                            <ul>
                                <li><a target="_blank" href="http://twitter.com/otonomic" ><img src="images/twt.png" alt=" " /> </a></li>
                                <li><a target="_blank" href="http://facebook.com/otonomic" ><img src="images/fb2.png" alt=" " /></a></li>
                                <li><a target="_blank" href="https://www.linkedin.com/company/3104980" ><img src="images/in.png" alt=" " /></a></li>
                            </ul>
                        </div>
                        <div class="bottom_logo"><img src="images/bottom_logo.png" alt=" " /></div>
                </div>

                <?php include_once('../../../shared/fanpages/fanpage_autoload.php');?>
            </div>
        </div>
    </div>
</body>
</html>
