<?php

use app\models\Authors;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = 'Информация о книге';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту книгу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'author_id',
                'value' => $model->getAuthorName()
            ],
            [
                'attribute' => 'date',
                'value' => date("d/m/Y",  strtotime($model->date))
            ],
            [
                'attribute' => 'preview',
                'value' => $model->preview,
                'format' => ['image', ['width' => '200']],
            ],
            [
                'attribute' => 'date_create',
                'value' => date("d-m-Y в H:i:s",  strtotime($model->date_create))
            ],
            [
                'attribute' => 'date_update',
                'value' => date("d-m-Y в H:i:s",  strtotime($model->date_update))
            ],
        ],
    ]) ?>

</div>
