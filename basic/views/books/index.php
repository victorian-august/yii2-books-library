<?php

use app\models\Authors;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books Library';
//$this->params['breadcrumbs'][] = $this->title;
Yii::$app->formatter->locale = 'ru-RU';

function YesToDate($date)
{
    $today = date('d.m.Y', time());
    $yesterday = date('d.m.Y', time() - 86400);
    $dbDate = date('d.m.Y', strtotime($date));
    $dbTime = date('H:i', strtotime($date));

    switch ($dbDate) {
        case $today :
            $output = 'Сегодня в ' . $dbTime;
            break;
        case $yesterday :
            $output = 'Вчера в ' . $dbTime;
            break;
        default :
            $output = $dbDate;
    }
    return $output;
}

?>
<div class="books-index">

    <!-- Default bootstrap modal windows -->
    <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalViewLabel"></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(['options' => ['class' => 'pjax-wrapper']]); ?>

    <? if ($message = \yii::$app->session->getFlash('message')) { ?>
        <script>
            alert('<?=$message?>');
        </script>
    <? } ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
            'id',
            [
                'label' => 'Название',
                'attribute' => 'name',
                'value' => 'name'
            ],
            [
                'label' => 'Превью',
                'attribute' => 'preview',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img($data->preview, [
                        'class' => 'preview',
                        'width' => '50',
//                        'onclick' => 'changeSizeImage(this)'
                    ]);
                }
            ],
            [
                'label' => 'Автор',
                'attribute' => 'author_id',
                'format' => 'html',
                'value' => function ($data) {
                    $a = ArrayHelper::map(Authors::find()->all(), 'id', function ($element) {
                        return $element['firstname'] . " " . $element['lastname'];
                    });
                    return $a[$data->author_id];
                }
            ],
            [
                'label' => 'Дата выхода книги',
                'attribute' => 'date',
                'format' => ['date', "php:j F Y"]
            ],
            [
                'label' => 'Дата добавления',
                'attribute' => 'date_create',
                'value' => function ($data) {
                    return YesToDate($data->date_create);
                }
            ],
            [
                'class' => yii\grid\ActionColumn::className('buttons'),
                'header' => 'Кнопки действий',
                'template' => '{update} {view} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = \yii\helpers\Url::toRoute(['/books/view', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => 'Посмотреть',
                            'data-pjax' => '0',
                            'class' => 'button-view'
                        ]);
                    }
                ]
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
