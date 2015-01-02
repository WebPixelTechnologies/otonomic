<ol>
    <li><?php echo($i18n->step_1)?></li>
    <li><?php echo($i18n->step_2)?></li>
    <li><?php echo($i18n->step_3)?></li>
    <li><?php echo($i18n->step_4)?></li>
    <li><?php echo($i18n->step_5)?></li>
</ol>
<script type="text/javascript">
    jQuery(function($){
        $('.open_tab').click(function(e){
            e.preventDefault();
            $('#'+$(this).attr('rel')).click();
        });
    });
</script>