<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Custom;
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping Cart</h2>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <?php if (!empty($cart_items)) { ?>
                            <h3 id="order_review_heading">Your order</h3>
                            <div style="position: relative;" id="order_review">
                                <table class="shop_table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $grand_total = 0.00;
                                        foreach ($cart_items as $ci) {
                                            ?>
                                            <tr>
                                                <td class="product-name">
                                                    <?php echo $ci->display_name; ?> <strong class="product-quantity">× <?php
                                                    $qty = $cookie_data[$ci->id]['qty'];
                                                    echo $qty;
                                                    ?></strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">
                                                        <?php
                                                        $row_total = $qty * $ci->selling_price;
                                                        $grand_total += $row_total;
                                                        echo Custom::getCurrencySymbol()['bdt'] . ' ' . number_format($row_total, 2);
                                                        ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                    <tfoot>

                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td>
                                                <span class="amount">
                                                    <?php echo Custom::getCurrencySymbol()['bdt'] . ' ' . number_format($grand_total, 2); ?>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>Free Shipping</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td>
                                                <strong>
                                                    <span class="amount">
                                                        <?php echo Custom::getCurrencySymbol()['bdt'] . ' ' . number_format($grand_total, 2); ?>
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>
                                        
                                    </tfoot>
                                </table>

                                <?php echo Html::beginForm('/checkout', 'post', ['name' => 'place_order']); ?>
                                <div id="payment">
                                    <ul class="payment_methods methods">
                                        <li class="payment_method_bacs">
                                            <input type="radio" id="payment_method_bacs" class="input-radio" name="payment_method" value="1" checked="checked" data-order_button_text="">
                                            <label for="payment_method_bacs">Direct Bank Transfer </label>
                                            <div class="payment_box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                                <p><strong>Bank Details</strong></p>
                                                <p>Bank: Bangu Bank</p>
                                                <p>Account Name: Simple Commerce</p>
                                                <p>Account Number: 4204-2042-0420</p>
                                            </div>
                                        </li>                                        
                                        <li class="payment_method_paypal">
                                            <input type="radio" id="payment_method_paypal" class="input-radio" name="payment_method" value="0" data-order_button_text="Proceed">
                                            <label for="payment_method_paypal">Cash on Delivery</label>
                                        </li>
                                    </ul>

                                    <div class="form-row place-order">
                                        <input type="submit" class="button alt" name="place_order" id="place_order" value="Place order" data-value="Place order">
                                    </div>

                                    <div class="clear"></div>

                                </div>
                                <?php Html::endForm(); ?>


                            </div>
                        <?php } else { ?>
                            <h3 id="order_review_heading">No items found in the cart.</h3>
                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>