<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php  echo $form->field($model, 'author_id')
            ->dropDownList(app\models\Authors::getList(), 
                ['prompt' => 'автор', 'style' => 'width:300px;float:left;margin-right:20px'])
            ->label(false) ?>

    <?php  echo $form->field($model, 'name')
            ->label(false)
            ->textInput(['style' => 'width:300px;', 'placeHolder' => 'название книги']) ?>
    
    <?php 
        echo '<label class="control-label" style="float:left;margin-top:10px;margin-right:10px;">Дата выхода книги:</label>';
        echo '<div style="width:400px;float:left;">';
        echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'fromDate',
            'attribute2' => 'toDate',
            'options' => ['placeholder' => '31/12/2014'],
            'options2' => ['placeholder' => '31/02/2015'],
            'type' => DatePicker::TYPE_RANGE,
            'form' => $form,
            'separator' => 'до',
            'pluginOptions' => [
                'format' => 'dd/mm/yyyy',
                'autoclose' => true,
                'class' => 'ssss'
            ]
        ]);
        echo '</div>';
    ?>
    
    <div class="form-group" style="float: right;">
        <?= Html::submitButton('искать', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('сбросить', ['class' => 'btn btn-default', 'onclick' => 'window.location.href = "' . yii\helpers\Url::toRoute('books/index') . '";return false;']) ?>
    </div>
    <div class="clearfix" ></div>

    <?php ActiveForm::end(); ?>

</div>
