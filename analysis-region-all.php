<?php

use common\models\DetiAnket;
use common\models\Director;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Формирование данных по региону и/или школе';

$itogArr = [];

?>

    <div class="list-patients-report-form container">
        <h5 class="text-center"><?= $this->title ?></h5>
        <?php
        $form = ActiveForm::begin();
        ?>
        <?=
        $this->render(
            '/report/_title-report',
            [
                'form' => $form,
                'modelReport' => $modelReport,
                'district_items' => $district_items,
                'hasAccessFederalDistrict' => true,

            ]
        ); ?>
        <div class="form-group row">
            <?= Html::submitButton('Показать', ['class' => 'btn btn-success main-color form-control col-12 mt-3']) ?>
        </div>
        <?php
        ActiveForm::end(); ?>

    </div>
<? if ($result) { ?>
    <div class="container">
        <?=
        $this->render(
            '/report/_print-region-all',
            [
                'str' => $str,
                'result' => $result,
                'resultAnlet3Class' => $resultAnlet3Class,
                'resultAnlet3Vse' => $resultAnlet3Vse,
            ]
        ); ?>
    </div>
<? } ?>