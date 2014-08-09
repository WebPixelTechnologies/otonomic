<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.admin_panel.css">

    <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
    <script src="js/bootstrap.modal.js"></script>
</head>

<body>
    <div id="fbManagePagesModal" class="modal fade step-modal-box in animateIn" role="dialog" aria-hidden="false" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div>
                    <!-- Header -->
                    <div class="modal-header">
                        <iframe src="//www.facebook.com/plugins/facepile.php?app_id=575528525876858&amp;href=https%3A%2F%2Fwww.facebook.com%2Fotonomic&amp;action&amp;width=530&amp;height=60&amp;max_rows=1&amp;colorscheme=dark&amp;size=medium&amp;show_count=true&amp;appId=575528525876858" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:530px; height:60px;" allowTransparency="true"></iframe>
                    </div>
                    <!-- Content -->
                    <div id="fbCancel-modal" class="modal-body">
                        <h3>As we said before...</h3>
                        <p>In order to save your website it's important to verify that you are the admin of the Facebook page.</p>
                        <p><strong>Don't worry!</strong> We won't misuse this privilege in any way.</p>
                        <div class="modal-btns text-right">
                            <div id="close-btn" class="btn btn-default">
                                <img src="images/fb_no.png">Don't save my site</div>
                            <div id="yes-btn" class="btn btn-success">
                                <img src="images/fb_yes.png">OK! Save my site</div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer">
                        <div class="pull-left">
                            <img class="footer-logo" src="images/footer_logo.png">
                        </div>
                        <div class="footer-text pull-left">
                            <p><strong>otonomic</strong> will not use your personal Facebook data under any circumstances without your permission. We just need to confirm you own the page.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>