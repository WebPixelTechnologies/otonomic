<ol>
    <li><?php echo($i18n->step_1)?></li>
    <li><?php echo($i18n->step_2)?></li>
    <li><?php echo($i18n->step_3)?></li>
    <li><?php echo($i18n->step_4)?></li>
    <li><?php echo($i18n->step_5)?></li>
</ol>
<h3 style="text-transform: uppercase"><?php echo ($i18n->additional_documentation)?></h3>
<ul>
    <?php foreach ($i18n->documentation_links as $link => $label): ?>
        <li><a target='_blank' href="<?php esc_attr_e($link)?>"><?php esc_html_e($label)?></a></li>
    <?php endforeach ?>
</ul>
<script type="text/javascript">
    jQuery(function($){
        $('.open_tab').click(function(e){
            e.preventDefault();
            $('#'+$(this).attr('rel')).click();
        });
    });
</script>