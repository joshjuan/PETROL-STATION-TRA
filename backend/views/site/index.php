<?php
$this->title = 'Home';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?= \hail812\adminlte3\widgets\Alert::widget([
                'type' => 'success',
                'body' => '<h3>Welcome to Petrol Station Information Management System!</h3>',
            ]) ?>
        </div>
    </div>
</div>