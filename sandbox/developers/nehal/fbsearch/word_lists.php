<?php
ini_set('max_execution_time', 600000); //increase max_execution_time to 10 min if data set is very large

if(!isset($_POST["submit"]) || !isset($_FILES["file"])) {
    header('location:index.php');exit;
}

//if there was an error uploading the file
if ($_FILES["file"]["error"] > 0) {
    echo 'Return Code: ' . $_FILES["file"]["error"] . '<br />';
    echo 'No input file specified.<br/>';
    echo 'Please <a href="index.php">retry</a>';
    exit;

} else {
    //Store file in directory "upload" with the name of "uploaded_file.txt"
    //$storagename = $_FILES["file"]["name"];
    $storagename = 'synonyms_' . time().'.csv';
    move_uploaded_file($_FILES["file"]["tmp_name"], "tmp/upload/" . $storagename);

    //include class files
    require_once 'class_loader.php';

    //$fbs = new FbSearch();
    $syn = new Synonyms();
    $data = $syn->read_csv($storagename);
}
?>

<html>
<head>
    <title>List of keywords</title>
    <style type="text/css">
        .left{ float: left; }
        .right{ float: right; }
        .clear{clear:both}
        table { border-collapse:collapse;}
        table, th, td{ border: 1px solid black;}
        td{padding: 0 10px}
        tr:hover {background-color: #CFF;}
    </style>
</head>

<body>
    <div class="left" style="width: 30%">
        <table width="80%">
            <tr>
                <td>Upload:</td>
                <td><?php echo $_FILES["file"]["name"] ?></td>
            </tr>
            <tr>
                <td>Type:</td>
                <td><?php echo $_FILES["file"]["type"] ?></td>
            </tr>
            <tr>
                <td>Size:</td>
                <td><?php echo ($_FILES["file"]["size"] / 1024) . ' Kb' ?></td>
            </tr>
            <tr>
                <td>Stored:</td>
                <td><?php echo 'upload/'.$_FILES["file"]["name"] ?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Search Fanpages</td>
                <td>
                    <input type="button" id="fetch_data" value="Get Data from Facebook">
                    <input type="button" id="pause" value="Pause requests" style="display: none">
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;<div class="loader" style="display: none"><img src="img/ajax-loader.gif">&nbsp;Please wait...</div></td>
            </tr>
            <tr>
                <td>Download zip file</td>
                <td><input type="button" id="get_data" value="Download bundle"></td>
            </tr>
        </table>
    </div>

    <div class="left" style="width: 70%">
        <table width="100%">
            <tr>
                <th>Sr.No</th>
                <th>Keyword</th>
                <th>Synonyms</th>
                <th width="50">Status</th>
                <th width="250">File</th>
                <th>Found Fanpages</th>
            </tr>
            <?php $ii = 0; ?>
            <?php foreach($data as $keyword => $synonyms): ?>
                <?php foreach($synonyms as $key): ?>
                <tr id="index_<?php echo $ii; ?>" class="keyword <?php echo $keyword; ?>" data-index="<?php echo $ii; ?>" data-keyword="<?php echo $keyword;?>" data-synonym="<?php echo $key;?>">
                    <td><?php echo $ii; ?></td>
                    <td><?php echo $keyword; ?></td>
                    <td><?php echo $key; ?></td>
                    <td id="status_<?php echo $ii; ?>"></td>
                    <td id="file_<?php echo $ii; ?>"></td>
                    <td id="records_<?php echo $ii; ?>"></td>
                </tr>
                <?php $ii++; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </table>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var current = 0;
            var ajaxes = [];
            var isPause = false;

            $("#fetch_data").click(function(){
                $(".loader").show();
                $.each($(".keyword:not(.success)"), function(key, value){
                    var $this = $(this);

                    var obj = new Object();
                    obj.index = $this.data('index');
                    // obj.synonym = $this.data('synonym');
                    obj.keyword = $this.data('keyword');

                    ajaxes.push(obj);
                    //getbetchFile(index, keyword, synonym);
                });

                //console.log(ajaxes);
                isPause = false;
                setInterval(function() { getbetchFile(); }, 400);
                $("#fetch_data").hide();
                $("#pause").show().val("Pause");

            });

            $("#pause").click(function(){
                isPause = true;
                $("#pause").val("Pausing...");
            });

            $("#get_data").click(function(){
                $.ajax({
                    url : 'get_data.php',
                    data : {action : 'zip'},
                    dataType: 'json',
                    method : 'post',
                    success:function(response){
                        console.log(response);
                        document.location.href = 'download_zip.php?zip_file='+response.file;
                    }
                });
            });

            function getbetchFile(){

                /*if(current > 5){
                    $(".loader").hide();
                    $("#fetch_data").show();
                    $("#pause").hide();
                    return false;
                }*/

                if(isPause){
                    $(".loader").hide();
                    $("#fetch_data").show();
                    $("#pause").hide();
                    return false;
                }

                var data = ajaxes[current];
                if(typeof data == 'undefined'){
                    $(".loader").hide();
                    return false;
                }
                <?php if(isset($_REQUEST['filename'])): ?>
                    data.filename = "<?= $_REQUEST['filename']?>";
                <?php endif; ?>

                (function(data, index) {
                    $.ajax({
                        url : 'get_data.php',
                        data : data,
                        dataType: 'json',
                        method : 'post',
                        success:function(response){
                            $("#status_"+index).html("<img src='img/success.png'>");
                            $("#file_"+index).html(response.file);
                            $("#records_"+index).html(response.data_count);
                            $("#index_"+index).addClass('success');
                        }
                    });
                }) (data, current);

                current++;
            }
        });
    </script>
</body>
</html>