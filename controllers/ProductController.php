<?php

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

class ProductController extends AppController {
    public function actionView($id) {
        // $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if (empty($product)) { // item does not exist
            throw new \yii\web\HttpException(404, 'Такого продукта не существует.');
        }
        //или так
        // $product = Product::find()->with('category')->where(['id' => $id])-limit(1)->one();
        $hits = Product::find()->where(${['hit' => '1']})->limit(6)->all();
        $this->setMeta('My-shop | ' . $product->name, $product->keywords, $product->description);
        return $this->render('view',compact('product', 'hits'));
    } 
}