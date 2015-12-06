<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = $model->name;
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'date_create',
            'date_update',
            [
                'attribute' => 'preview',
                'value' => Yii::$app->params['fileUploadUrl'] . $model->preview,
                'format' => ['image',['width'=>'100']],
                'visible' => $model->preview ? true : false
            ],
            'date',
            [
                'attribute' => 'author_id',
                'value' => $model->author->getFullName()
            ],
        ],
    ]) ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
