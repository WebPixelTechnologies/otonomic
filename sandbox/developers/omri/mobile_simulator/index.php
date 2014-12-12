<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    </head>

    <body>
        <div id="controller">
            <div>
                Url: <input id="otomobic-settings-url" type="text" />
            </div>

            <div>
                Header:
                <select id="otomobic-settings-header">
                    <option value="header1.png" selected="selected">#1</option>
                    <option value="header2.png">#2</option>
                </select>
            </div>

            <div>
                Footer:
                <select id="otomobic-settings-footer">
                    <option value="footer1.png" selected="selected">Human face</option>
                    <option value="footer2.png">Heart</option>
                    <option value="footer3.png">V mark</option>
                </select>
            </div>
        </div>

        <div id="main">
            <div id="mobile-container">
                <img id="mobile-img" src="images/iphone4.png">

                <div id="iframe">
                    <img id="otomobic-header" src="images/header1.png">
                    <iframe src="http://washingtonhair-charlenerapa.otonomic.com"></iframe>
                    <img id="otomobic-footer" src="images/footer1.png">
                </div>
            </div>

        </div>

        <script>
            jQuery(document).ready(function($) {
                $('#otomobic-settings-header').change(function() {
                    $('#otomobic-header').attr('src', 'images/'+$('#otomobic-settings-header option:selected').val());
                });

                $('#otomobic-settings-footer').change(function() {
                    $('#otomobic-footer').attr('src', 'images/'+$('#otomobic-settings-footer option:selected').val());
                });

                $('#otomobic-settings-url').blur(function() {
                    var url = $('#otomobic-settings-url').val();
                    url.replace('http://','').replace('https://','');
                    url = 'http://'+url;
                    $('iframe').attr('src', );
                });
            });
        </script>
    </body>
</html>

