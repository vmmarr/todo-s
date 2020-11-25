<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Etiquetatareas */

$this->title = 'Create Etiquetatareas';
$this->params['breadcrumbs'][] = ['label' => 'Etiquetatareas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etiquetatareas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
