<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => 'id',
                'contentOptions' => ['style' => 'width: 38px;'],
            ],
            'name',
            [
                'attribute' => 'preview',
                'enableSorting' => false,
                'format' => 'html',
                'value' => function ($data) {
                    if (is_file(Yii::$app->params['fileUploadUrl'] . $data['preview'])) {
                        return Html::img(Yii::$app->params['fileUploadUrl'] . $data['preview'], ['width' => '60px']);
                    } else {
                        return Html::img(Yii::$app->params['fileUploadUrl'] . 'default.jpg', ['width' => '60px']);
                    }
                },
            ],
            [
                'attribute' => 'author_id',
                'value' => 'authorName',
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'long'],
            ],
            [
                'attribute' => 'date_update',
                'format' => ['date', 'long'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 70px;'],
            ],
        ]
    ]); ?>

</div>
<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
$this->registerJsFile('image-sizer.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs("$('table img').click(function(){ $(this).width() < 61 ? $(this).width(180) : $(this).width(60)});", yii\web\View::POS_LOAD, 'my-image');
$this->registerJs("modalView();openWindow();", yii\web\View::POS_LOAD, 'my-option-view');
?>
