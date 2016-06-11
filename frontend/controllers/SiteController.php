<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Cookie;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use common\helpers\Custom;
use common\models\Product;
use common\models\Manufacturer;
use common\models\Order;
use common\models\Cart;
use common\models\Category;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup', 'cart', 'shop', 'category', 'manufacturer', 'item'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'checkout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
    public function actionIndex() {

        $model_product = new Product();
        $model_manufacturer = new Manufacturer();

        $home_slider_product = $model_product->find()->getHomeSliderProduct()->all();
        $top_ten_products = $model_product->find()->getLatestTenProducts()->all();

        $top_ten_manufacturer = $model_manufacturer->find()
                ->where('status =:status', [':status' => 1])
                ->limit(Custom::getCustomConfig()['max_allowed_manufacturer'])
                ->all();

        return $this->render('index', [
                    'home_slider_product' => $home_slider_product,
                    'top_ten_products' => $top_ten_products,
                    'top_ten_manufacturer' => $top_ten_manufacturer,
        ]);
    }

    public function actionCheckout() {
        $user_id = 0;

        if (Yii::$app->user->isGuest) {
            return $this->redirect('/login');
        }

        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->identity->id;
        }

        $cart_json = [];

        if (isset($_COOKIE["cart_{$user_id}"])) {
            $cart_json = Json::decode($_COOKIE["cart_{$user_id}"]);
        } elseif (isset($_COOKIE["cart_0"])) {
            $cart_json = Json::decode($_COOKIE["cart_0"]);
        } else {
            return $this->redirect('/shop');
            Yii::$app->end();
        }

        $ar_product_id = array_keys($cart_json);
        $cart_items = Product::find()->where(['in', 'id', $cart_json])->all();

        if (isset($_POST) && !empty($_POST['place_order'])) {

            $grand_total = 0.00;
            $grand_total_purchase_price = 0.00;

            foreach ($cart_items as $ci) {
                $unit_price = floatval($ci->selling_price);
                $qty = intval($cart_json[$ci->id]['qty']);
                $row_total = $unit_price * $qty;
                $grand_total += $row_total;

                $unit_purchase_price = floatval($ci->purchase_price);
                $row_total_purchase_price = $unit_purchase_price * $qty;
                $grand_total_purchase_price += $row_total_purchase_price;
            }




            $order = new Order();
            $order->bill_number = Custom::getUniqueId(0, 6);
            $order->member_id = $user_id;
            $order->total_amount = $grand_total;
            $order->total_payable = $grand_total;
            $order->payment_method = $_POST['payment_method'];
            $order->beforeSave(true);

            if ($order->validate() && $order->insert()) {
                $product = '';
                foreach ($cart_items as $ci) {
                    $unit_price = floatval($ci->selling_price);
                    $qty = intval($cart_json[$ci->id]['qty']);
                    $row_total = $unit_price * $qty;
                    $product .= "{$ci->id},";

                    $cart = new Cart;
                    $cart->order_id = $order->id;
                    $cart->product_id = $ci->id;
                    $cart->unit_selling_price = $ci->selling_price;
                    $cart->quantity_sold = $qty;
                    $cart->subtotal_payable = $row_total;
                    $cart->subtotal_paid = $row_total;
                    $cart->beforeSave(true);
                    $cart->insert();
                }
            }

            $sale_amount = $grand_total - $grand_total_purchase_price;

            $app_root = \Yii::getAlias('@approot');
            include("{$app_root}/affiliate/controller/record-sale.php");
            
            $cookies = Yii::$app->response->cookies;
            if (isset($_COOKIE['cart_' . $user_id])) {
                $cookies->remove('cart_' . $user_id);
                unset($cookies['cart_' . $user_id]);
            }
            if (isset($_COOKIE['cart_0'])) {
                $cookies->remove('cart_0');
                unset($cookies['cart_0']);
            }

            return $this->redirect(['/member/order', 'id' => $order->id]);
        }

        return $this->render('checkout', [
                    'cart_items' => $cart_items,
                    'cookie_data' => $cart_json,
        ]);
    }

    public function actionItem($id, $name = '') {

        $query = Product::find();
        $query->andWhere('status = :s AND is_private = :p', [':s' => 1, ':p' => 0]);
        $query->andWhere('id = :i', [':i' => $id]);
        $query->orderBy('id DESC');
        $data = $query->one();

        return $this->render('productDetail', [
                    'data' => $data,
        ]);
    }

    public function actionCategory($id = 0, $name = '') {

        $is_parent = FALSE;
        $category = Category::findOne($id);

        if (empty($category->parent_id)) {
            $is_parent = TRUE;
        }

        if ($is_parent) {
            $children = Category::find()->getChildCategories($category->id)->all();
            $category_ids = array_map(function($child) {
                return $child->id;
            }, $children);
            $category_ids[] = $category->id;
        }

        $query = Product::find();
        $query->joinWith(['productCategories']);
        $query->andWhere(['in', 'product_category.category_id', $category_ids]);
        $query->andWhere('status = :s AND is_private = :p', [':s' => 1, ':p' => 0]);
        $query->orderBy('id DESC');
        $pageTile = "Items Available in : {$category->display_name}";

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category', [
                    'dataProvider' => $dataProvider,
                    'pageTile' => $pageTile,
        ]);
    }

    public function actionManufacturer($id, $name = '') {

        $manufacturer = Manufacturer::findOne($id);

        $query = Product::find();
        $query->joinWith(['productManufacturers']);
        $query->andWhere(['in', 'product_manufacturer.manufacturer_id', $id]);
        $query->andWhere('status = :s AND is_private = :p', [':s' => 1, ':p' => 0]);
        $query->orderBy('id DESC');
        $pageTile = "Items Available in : {$manufacturer->name}";

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category', [
                    'dataProvider' => $dataProvider,
                    'pageTile' => $pageTile,
        ]);
    }

    public function actionCart() {

        $user_id = 0;
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->identity->id;
            $email = Yii::$app->user->identity->email;
        }

        $cart_json = [];
        if (isset($_COOKIE['cart_' . $user_id])) {
            $cart_json = Json::decode($_COOKIE['cart_' . $user_id]);
        }
        if (isset($_COOKIE['cart_0'])) {
            $cart_json = Json::decode($_COOKIE['cart_0']);
        }
        $ar_product_id = array_keys($cart_json);
        $cart_items = Product::find()->where(['in', 'id', $cart_json])->all();

        $affiliate = \frontend\models\ApMembers::find()->getAffiliateByEmail(Yii::$app->user->identity->email)->one();
        // add a new cookie to track affiliate sale
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'ap_ref_tracking',
            'value' => $affiliate->id,
        ]));

        return $this->render('cart', [
                    'cart_items' => $cart_items,
                    'cart_json' => $cart_json
        ]);
    }

    public function actionShop() {

        $query = Product::find();
        $query->andWhere('status = :s AND is_private = :p', [':s' => 1, ':p' => 0]);
        $query->orderBy('id DESC');
        $pageTile = "All Available Items";

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category', [
                    'dataProvider' => $dataProvider,
                    'pageTile' => $pageTile,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $cookies = Yii::$app->response->cookies;
            if (isset($_COOKIE['cart_' . Yii::$app->user->identity->id])) {
                return $this->redirect('/cart');
            }
            if (isset($_COOKIE['cart_0'])) {
                return $this->redirect('/cart');
            } else {
                return $this->goBack();
            }
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {

        $cookies = Yii::$app->response->cookies;
        $user_id = Yii::$app->user->identity->id;

        if (isset($_COOKIE['cart_' . $user_id])) {
            $cookies->remove('cart_' . $user_id);
            unset($cookies['cart_' . $user_id]);
        }
        if (isset($_COOKIE['cart_0'])) {
            $cookies->remove('cart_0');
            unset($cookies['cart_0']);
        }

        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $user_id = Yii::$app->user->identity->id;
                    $cookies = Yii::$app->response->cookies;
                    if (isset($_COOKIE['cart_' . $user_id])) {
                        return $this->redirect('/cart');
                    }
                    if (isset($_COOKIE['cart_0'])) {
                        return $this->redirect('/cart');
                    }

                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
