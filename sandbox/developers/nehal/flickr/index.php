<?php
    include_once 'flickr_class.php';
    $f = new Flickr();
    $licenses = $f->getLicenseInfo();
?>
<html>
    <head>
        <title>Flickr Image search</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
        <script src="//masonry.desandro.com/masonry.pkgd.min.js" type="text/javascript"></script>
        <script src="//imagesloaded.desandro.com/imagesloaded.pkgd.min.js" type="text/javascript"></script>
        <style>
            .item{float: left;margin: 5px;}
        </style>

    </head>
    <body>
        <form method="post" action="index.php">
            <table width="600">
                <tr>
                    <td width="20%">Search Keywords</td>
                    <td width="80%"><textarea name="tags" id="tags" cols="100" rows="5" ><?php echo isset($_POST['tags'])?$_POST['tags']:''; ?></textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><i>Please provide comma seperated search keywords</i></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>License</td>
                    <td>
                        <select name="license" id="license">
                            <?php foreach($licenses as $license): ?>
                            <option value="<?php echo $license->id ?>"><?php echo $license->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Records</td>
                    <td>
                        <select name="limit" id="limit">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="submit" value="Search Images" /></td>
                </tr>
            </table>
        </form>

        <?php if(isset($_POST['submit'])): ?>
            <div id="flickr_images">
                <div id="container">
                    <?php
                    $tags = $_POST['tags'];
                    $license = $_POST['license'];
                    $limit = $_POST['limit'];
                    $result = $f->search($tags, $license, $limit);

                    if(!empty($result))
                    foreach($result as $photo){
                        echo '<div class="item">';
                        echo '<a href="'.$photo['link'].'" target="_blank">';
                        echo '<img title="'. $photo['title'].'" src="'. $photo['url'].'"/>';
                        echo '</a></div>';
                    }
                    ?>
                </div>
                <script type="text/javascript">
                    document.getElementById('license').value = "<?php echo $_POST['license'];?>";
                    document.getElementById('limit').value = "<?php echo $_POST['limit'];?>";

                    $(document).ready(function(){
                        // with jQuery
                        var options = new Object();
                        options.itemSelector = '.item';

                        var $container = $('#container').masonry(options);

                        // initialize Masonry after all images have loaded
                        $container.imagesLoaded( function() {
                            $container.masonry(options);
                        });
                    });

                </script>
            </div>
        <?php endif; ?>
    </body>
</html>