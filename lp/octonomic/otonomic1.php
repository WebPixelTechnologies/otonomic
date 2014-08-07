<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Otonomic </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">	
        <style>
            body{
                background: #211515;
            }

            /*.search_results{
                position: relative;
                left: -8px;
                top: 30px;
            }
            .make_my_website span.icon_clear{
                position: absolute;
                right: 0;
                top: 5px;
            }*/
            .search_results .close-search{ display: block !important;}
        </style>
    </head>
<body>
    <div class="wrapper">
        <div id="main" class="tb">
            <div class="container">
                <div class="top_wraper">
                    <h1 class="slogan">If only I had a website...</h1>
                    <div class="make_my_website">
                        <table class="table_form">
                        <tr class="form_input2">
                            <td>
                                <div style="position: relative" class="p2s_fanpages">
                                    <input id="main_search_box" type="text" class="input_type" value="" name="fName" placeholder="Enter your Facebook page name (or URL)">
                                    <div class="facebook_icon"></div>
                                    <div class="tb search-wrapper" id="search_wrapper_main"></div>
                                    <span class="icon_clear close-search"><img class="close-search" src="/shared/fanpages/images/close.png" width="32" height="32"/></span>
                                </div>
                            </td>
                            <td id="btn_go" class="input_title" title='Choose your page from the suggestions below'>Make my Website</td>
                        </tr>
                        </table>
                    </div>
                    <div class="txt">It's free, automatic and istant. &nbsp;<a href="#"><span style=" color: #009dc4; text-decoration: underline;">Learn more</span></a></div>
                </div>
                    <div class="social">
                        <ul>
                            <li><a href="#" ><img src="images/twt.png" alt=" " /> </a></li>
                            <li><a href="#" ><img src="images/fb2.png" alt=" " /></a></li>
                            <li><a href="#" ><img src="images/in.png" alt=" " /></a></li>
                        </ul>
                    </div>
                    <div class="bottom_logo"><img src="images/bottom_logo.png" alt=" " /></div>
            </div>
            <?php include_once('../../shared/fanpages/fanpage_autoload.php');?>
        </div>
    </div>
</body>
</html>
