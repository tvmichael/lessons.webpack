<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'MiniSite';
?>
<div class="site-index">
    <h1>База даних</h1>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <p>
                    <a href="<?php Url::to(['data-base/add-table-product']);?>">Додати таблицю товарів</a>
                </p>
            </div>
        </div>
    </div>
</div>
