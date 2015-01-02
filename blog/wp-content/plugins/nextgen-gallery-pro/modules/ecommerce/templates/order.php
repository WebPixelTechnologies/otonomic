<div class="ngg_pro_order_info">
    <table>
        <?php
        foreach ($images as $image):
            $item_count = count($image->items);
            $item       = array_shift($image->items);
            ?>
            <tr>
                <td class='ngg_order_image_column'>
                    <img src="<?php esc_attr_e($image->thumbnail_url)?>"
                         alt="<?php esc_attr_e($image->alttext)?>"
                         width="<?php esc_attr_e($image->dimensions['width'])?>"
                         height="<?php esc_attr_e($image->dimensions['height'])?>"/>
                </td>
                <td class='ngg_order_interior_parent'>
                    <table>
                        <tr>
                            <th><?php esc_html_e($i18n->quantity)?></th>
                            <th><?php esc_html_e($i18n->description)?></th>
                            <th class="ngg_order_price_column"><?php esc_html_e($i18n->price)?></th>
                            <th><?php esc_html_e($i18n->total)?></th>
                        </tr>
                        <tr class='ngg_order_separator'>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td>
                                <span><?php esc_html_e($item->quantity)?></span>
                            </td>
                            <td>
                                <?php esc_html_e($item->title)?>
                            </td>
                            <td class='ngg_order_price_column'>
                                <?php echo(M_NextGen_Pro_Ecommerce::get_formatted_price($item->price)) ?>
                            </td>
                            <td>
                                <?php echo(M_NextGen_Pro_Ecommerce::get_formatted_price($item->price * $item->quantity))?>
                            </td>
                        </tr>
                        <?php foreach ($image->items as $item): ?>
                            <tr>
                                <td>
                                    <span><?php esc_html_e($item->quantity)?></span>
                                </td>
                                <td>
                                    <?php esc_html_e($item->title)?>
                                </td>
                                <td class='ngg_order_price_column'>
                                    <?php echo(M_NextGen_Pro_Ecommerce::get_formatted_price($item->price)) ?>
                                </td>
                                <td>
                                    <?php echo(M_NextGen_Pro_Ecommerce::get_formatted_price($item->price * $item->quantity))?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
