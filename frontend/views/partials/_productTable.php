<?php

use yii\helpers\Html;
use yii\helpers\Url;

//use common\helpers\Custom;
?>

<table cellspacing="0" class="shop_table cart">

    <thead>
        <tr>
            <?php if (!isset($order) || empty($order)) { ?>
                <th class="product-remove">&nbsp;</th>
            <?php } ?>
            <th class="product-thumbnail">&nbsp;</th>
            <th class="product-name">Product</th>
            <th class="product-price">Price</th>
            <th class="product-quantity">Quantity</th>
            <th class="product-subtotal">Total</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($cart_items as $ci) { ?>
            <tr class="cart_item">
                <?php if (!isset($order) || empty($order)) { ?>
                    <td class="product-remove">
                        <?php echo Html::a('×', 'javascript:void(0);', ['class' => 'remove', 'title' => 'Remove this item']); ?>
                    </td>
                <?php } ?>

                <td class="product-thumbnail">
                    <?php
                    $img = Html::img("/uploads/product_image/{$ci->resourcesProducts[0]->resources->value}", ['class' => 'shop_thumbnail', 'alt' => $ci->name]);
                    $url = Url::to(['/item', 'id' => $ci->id, 'name' => Html::encode($ci->name)]);
                    echo Html::a($img, $url);
                    ?>
                </td>

                <td class="product-name">
                    <?php echo Html::a("{$ci->display_name}", $url); ?>
                </td>

                <td class="product-price">
                    <span class="amount">
                        BDT <?php echo $ci->selling_price; ?>
                    </span> 
                </td>

                <td class="product-quantity">
                    <div class="quantity buttons_added">
                        <?php // var_dump($cart_json); exit;?>
                        <?php if (!isset($order) || empty($order)) { ?>
                            <input class="product_id" name="product_id" type="hidden" value="<?php echo $ci->id; ?>">
                            <input type="button" value="-" class="minus">
                            <input name="quantity" type="number" step="1" min="0" value="<?php echo $cart_json[$ci->id]['qty'];?>" title="Qty" class="input-text qty text" size="4">
                            <input type="button" value="+" class="plus">
                        <?php } else { ?>
                            <?php
                            foreach ($order->carts as $cart) {
                                if ($cart->product_id == $ci->id) {
                                    ?>
                                    <input name="quantity" type="hidden" step="1" min="0" value="<?php echo $cart->quantity_sold; ?>" title="Qty" class="input-text qty text" size="4">
                                    <?php echo $cart->quantity_sold; ?>
                                    <?php
                                }
                            }
                            ?>
                        <?php } ?>
                    </div>
                </td>

                <td class="product-subtotal">
                    <span class="amount"></span> 
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>