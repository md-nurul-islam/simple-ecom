<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\Custom;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = 'Order Details';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        echo Html::a(Yii::t('app', 'Cancel'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to cancel this order?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bill_number',
            [
                'attribute' => 'member_id',
                'value' => $model->member->memberProfiles[0]->name
            ],
            'total_amount',
            'total_payable',
            [
                'attribute' => 'has_due',
                'value' => Custom::getYesNoArray()[$model->has_due]
            ],
            'created_date',
            'updated_date',
            [
                'attribute' => 'status',
                'value' => Custom::getOrderStatusArray()[$model->status]
            ],
        ],
    ])
    ?>

</div>

<div class="clearfix"></div>

<div class="product-order-cart panel panel-default">

    <div class="panel-heading"><h3>Ordered Items</h3></div>

    <div class="panel-body">

        <?php if (!empty($model->carts)) { ?>
            <table class="table table-bordered table-condensed table-hover table-responsive">

                <thead>
                    <tr>
                        <th class="product-thumbnail">&nbsp;</th>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-subtotal">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grand_total = 0.00;
                    $total_items = 0;
                    foreach ($model->carts as $cart) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                $img_src = "/uploads/product_image/{$cart->product->resourcesProducts[0]->resources->value}";
                                echo Html::img($img_src, ['class' => 'thumb']);
                                ?>
                            </td>
                            <td><?php echo $cart->product->display_name; ?></td>
                            <td><?php echo $cart->product->selling_price; ?></td>
                            <td><?php echo $cart->quantity_sold; ?></td>
                            <td>
                                <?php
                                $sub_total = intval($cart->quantity_sold) * floatval($cart->product->selling_price);
                                echo number_format($sub_total, 2);
                                $grand_total += $sub_total;
                                $total_items += intval($cart->quantity_sold);
                                ?>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Totals: </th>
                        <th><?php echo $total_items; ?></th>
                        <th><?php echo number_format($grand_total, 2); ?></th>
                    </tr>
                </tfoot>

            </table>

        <?php } else { ?>
            <div class="alert alert-warning">
                No Items found
            </div>
        <?php } ?>

    </div>

    <div class="panel-footer">

    </div>

</div>
