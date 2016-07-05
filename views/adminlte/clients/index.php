<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-index">
    <div class="box">
        <div class="box-header">
            <p>
                <?= Html::a('Добавит', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="box-body">

            <?php Pjax::begin(); ?>    <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions'=>[
                    'class'=>"table table-bordered table-hover dataTable",
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn', "header"=>"№"],
                    //'id',
                    'name',
                    //'sname',
                    //'fname:ntext',
                    'auth_key',
                    // 'comment:ntext',
                    
                    [
                        'attribute' => 'status',
                        'value' => 'status.name',
                    ],
                     'created',
                    // 'updated',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

