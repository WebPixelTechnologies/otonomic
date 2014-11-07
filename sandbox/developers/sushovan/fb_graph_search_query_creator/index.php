<?php

function create_query($data) {
    $field1 = explode("\n", $data['field1']);
    $field2 = explode("\n", $data['field2']);
    $field3 = explode("\n", $data['field3']);

    $result = '';

    $search = ['<field1>', '<field2>', '<field3>'];

    foreach($field1 as $field1_item) {
        foreach($field2 as $field2_item) {
            foreach($field3 as $field3_item) {
                $replace = [trim($field1_item), trim($field2_item), trim($field3_item)];
                $result .= str_replace($search, $replace, $data['query'])."\r\n";
            }
        }
    }
    return $result;
}

if(!empty($_POST)) {
    echo "<pre>".create_query($_POST)."</pre>";
    return;
}
?>

<!doctype html>
<html>
	<head>
		<title>Facebook Graph Search Query Creator</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

        <style>
            #main {padding:5px 20px;}
        </style>
	</head>
	<body>
        <div id="main">
            <h1>Facebook Graph Search Query Creator</h1>
            <?php if(!empty($msg)):?>
                <div><?=$msg?></div>
            <?php endif;?>

            <form role="form" method="post" action="#">
                <div class="form-group">
                    <label for="query">Query</label>
                    <input type="text" class="form-control" id="query" name="query"
                           placeholder="People who work as <field1> and live in <field2>"
                           value="People who work as <field1> and live in <field2>"
                    >
                </div>

                <button type="submit" class="btn btn-default">Submit</button>

                <div class="form-group">
                    <label for="field1">field1</label>
                    <textarea class="form-control" id="field1" name="field1" placeholder="massage therapist"></textarea>
                </div>

                <div class="form-group">
                    <label for="field2">field2</label>
                    <textarea class="form-control" id="field2" name="field2" placeholder="manhattan, new york"></textarea>
                </div>

                <div class="form-group">
                    <label for="field3">field3</label>
                    <textarea class="form-control" id="field3" name="field3" placeholder="females"></textarea>
                </div>

            </form>
        </div>
	</body>
</html>
