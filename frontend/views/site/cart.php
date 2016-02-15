<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Custom;
use common\models\Member;
?>
<?php
if (!Yii::$app->user->isGuest) {
    $member = Member::findOne(Yii::$app->user->identity->id);
    echo Html::input('hidden', 'cart_limit', $member->memberProfiles[0]->max_cart_amount, ['id' => 'cart_limit']);
}
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>
                        <?php echo (isset($order) && !empty($order)) ? 'Order Details' : 'Shopping Cart' ?>
                    </h2>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="single-product-area">

    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="product-content-right">

                    <div class="woocommerce">

                        <?php echo Html::beginForm('/checkout'); ?>

                        <?php
                        echo $this->render('/partials/_productTable', [
                            'cart_items' => $cart_items,
                            'cart_json' => (isset($cart_json) && !empty($cart_json)) ? $cart_json : NULL,
                            'order' => (isset($order) && !empty($order)) ? $order : NULL,
                        ]);
                        ?>

                        <div class="cart-collaterals">

                            <div class="cart_totals ">
                                <h2>Cart Totals</h2>

                                <table cellspacing="0">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">BDT 0.00</span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>Free Shipping</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">BDT 0.00</span></strong> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <?php if (!isset($order) || empty($order)) { ?>
                            <div class="form-group">
                                <?php echo Html::input('submit', 'proceed', 'Proceed to Checkout', ['class' => 'checkout-button button alt wc-forward floatright']); ?>
                            </div>
                        <?php } ?>

                        <?php Html::endForm(); ?>


                    </div>                        
                </div>                    
            </div>
        </div>
    </div>
</div>