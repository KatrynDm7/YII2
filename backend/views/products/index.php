<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\UnauthorizedHttpException;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php if (!Yii::$app->user->isGuest): ?>

    <?php $this->title = 'My products'; ?>

    <div class="products-index">

        <h1><?= Html::encode($this->title) ?>. Logged in as <?= Yii::$app->user->identity->email; ?></h1>

        <?php Pjax::begin(['options' => ['id' => 'products', 'class' => 'pjax-wraper', 'data-pjax' => true]]) ?>
            <p><?= Html::button('create', ['class' => 'btn btn-success', 'value' => Url::to(['products/create']), 'id' => 'modalButton'])?></p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'id',
                        'contentOptions' => ['class' => 'id text-center'],
                        'headerOptions' => ['class' => 'id text-center']
                    ],
                    [
                        'attribute' => 'name',
                        'contentOptions' => ['class' => 'name text-center'],
                        'headerOptions' => ['class' => 'name text-center']
                    ],
                    [
                        'attribute' => 'price',
                        'contentOptions' => ['class' => 'price text-center'],
                        'headerOptions' => ['class' => 'price text-center'],
                        'value' => 'price'
                    ],
                    [
                        'attribute' => 'quantity',
                        'contentOptions' => ['class' => 'quantity text-center'],
                        'headerOptions' => ['class' => 'quantity text-center'],
                    ],
                    [
                        'attribute' => 'created_at',
                        'contentOptions' => ['class' => 'created_at text-center'],
                        'headerOptions' => ['class' => 'created_at text-center'],
                        'format' => ['date', 'php:Y-d-m']
                    ],
                    [
                        'attribute' => 'user_id',
                        'contentOptions' => ['class' => 'user_id text-center'],
                        'headerOptions' => ['class' => 'user_id text-center']
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'contentOptions' => ['class' => 'actions text-center'],
                        'headerOptions' => ['class' => 'actions text-center']
                    ]
                ],
            ]); ?>
        <?php Pjax::end(); ?>

        <?= Html::a('All products', \yii\helpers\Url::to(['view'])); ?>
    </div>

    <?php Modal::begin(['options' =>['id' => 'modal']]);?>
        <?php Pjax::begin(['options' => ['id' => 'ajax_product', 'data-pjax' => true]]) ?>
            <div id='modalContent'></div>
        <?php Pjax::end(); ?>
    <?php Modal::end(); ?>
<?php else: ?>
    <?php throw new UnauthorizedHttpException('You must log in'); ?>
<?php endif; ?>
