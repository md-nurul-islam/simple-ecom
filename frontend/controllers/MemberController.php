<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Cookie;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\MemberProfile;
use common\helpers\Custom;
use common\models\Product;
use common\models\Manufacturer;
use common\models\Order;
use common\models\Cart;
use common\models\Member;

/**
 * Site controller
 */
class MemberController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['profile', 'orders', 'order', 'cancel', 'cart_amount'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionProfile() {

        $model = Member::findOne(Yii::$app->user->identity->id);

        return $this->render('profile', [
                    'model' => $model,
        ]);
    }

    public function actionCart_amount() {

        $model = MemberProfile::find()->where('member_id = :mid', [':mid' => Yii::$app->user->identity->id])->one();

        if (isset($_POST['MemberProfile']) && !empty($_POST['MemberProfile'])) {
            $model->attributes = $_POST['MemberProfile'];
            $model->beforeSave(false);

            if ($model->validate() && $model->save()) {
                return $this->redirect('profile');
            }
        }

        return $this->render('_form', [
                    'model' => $model,
        ]);
    }

    public function actionOrders() {

        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->where('member_id = :mid', [':mid' => Yii::$app->user->identity->id])->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('orders', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOrder($id) {

        $order = Order::findOne($id);

        $product_ids = [];
        if (!empty($order)) {
            foreach ($order->carts as $cart) {
                $product_ids[] = $cart->product_id;
            }
        }

        $cart_items = Product::find()->where(['in', 'id', $product_ids])->all();

        return $this->render('/site/cart', [
                    'cart_items' => $cart_items,
                    'order' => $order,
        ]);
    }

    public function actionCancel($id) {
        $order = Order::findOne($id);
        $order->status = -1;
        $order->update();

        return $this->redirect('orders');
    }

}
