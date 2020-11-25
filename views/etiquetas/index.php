<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EtiquetasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Etiquetas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etiquetas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Etiqueta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row d-flex justify-content-center">
    <?php
        foreach ($dataProvider->getModels() as $fila) : ?>   
            <div class="col-2">
                <div class="card">
                    <?=Html::tag('p', $fila['etiqueta'], ['class' => 'text-center mb-0'])?>
                </div>
            </div>
    <?php 
        endforeach;?>

    <?php Pjax::end(); ?>

</div>
