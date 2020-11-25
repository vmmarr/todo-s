<?php

use app\models\Tareas;
use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TareasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tareas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tareas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Tarea', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row d-flex justify-content-center align-items-center">
    <?php
        foreach ($dataProvider->getModels() as $fila) : ?>   
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <?=Html::tag('h3', $fila['titulo'], ['class' => 'card-title'])?>
                        <?php
                            if(Yii::$app->user->identity->id ===1) {?>
                                <?=Html::tag('h6', $fila->usuario->username, ['class' => 'card-subtitle mb-2 text-muted'])?>
                        <?php } ?>
                        <?=Html::tag('p', $fila['descripcion'], ['class' => 'card-text'])?>
                        <?=Html::tag('p', $fila['vencimiento'], ['class' => 'card-text'])?>
                        <?=Html::a(Icon::show('trash', ['framework' => Icon::FA]), ['delete', 'id' => $fila['id']], [
                            'class' => 'dropdown-item',
                            'data' => [
                                'confirm' => '¿Eliminar tarea?',
                                'method' => 'post',
                            ],
                        ])?>
                    </div>
                </div>
            </div>
    <?php 
        endforeach;?>
</div>
    <?php Pjax::end(); ?>
    
</div>
