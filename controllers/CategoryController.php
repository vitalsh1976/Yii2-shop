<?php

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController {
    public function actionIndex() {
        $hits = Product::find()->where(${['hit' => '1']})->limit(6)->all();
        $this->setMeta('My-shop');
        return $this->render('index', compact('hits'));
    }
    public function actionView($id) {
        // $id = Yii::$app->request->get('id');
        $category = Category::findOne($id);
        
        if (empty($category)) { // item does not exist
            throw new \yii\web\HttpException(404, 'Такой категории не существует.');
        }
        // $products = Product::find()->where(['category_id' => $id])->all();
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount'=>$query->count(), 'pageSize' => 3, 'forcePageParam' =>false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        $this->setMeta('My-shop | ' . $category->name, $category->keywords, $category->description);
        return $this->render('view', compact('products', 'pages', 'category'));
    }
    public function actionSearch() {
        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta('My-shop | Поиск ' . $q);
        if (!$q) return $this->render('search');
        $category = Category::findOne($id);
        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount'=>$query->count(), 'pageSize' => 3, 'forcePageParam' =>false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        
        return $this->render('search', compact('products', 'pages', 'q'));
    }
}