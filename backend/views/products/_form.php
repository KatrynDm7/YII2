<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="products-form">
    <?php $form = ActiveForm::begin(['options'=>['id' => 'product_form', 'data-pjax' => true, 'data-toggle' => 'validator', 'role' => 'form']]); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => 10]) ?>
        <?= $form->field($model, 'price')->textInput() ?>
        <?= $form->field($model, 'quantity')->textInput() ?>
        <div class="form-group field-products-email">
            <input type="hidden" id="products-email" class="form-control" name="Products[email]" value="<?=Yii::$app->user->identity->email ?>">
        </div>
        <div class="form-group field-products-user_id">
            <input type="hidden" id="products-id" class="form-control" name="Products[user_id]" value="<?=Yii::$app->user->identity->id ?>">
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>