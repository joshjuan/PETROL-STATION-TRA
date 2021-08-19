<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Web Psms</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">

            <?php
            echo \hail812\adminlte3\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Configuration',
                        'icon' => 'tachometer-alt',
                        'items' => [
                            ['label' => 'Company', 'url' => ['company/index'], 'iconStyle' => 'far'],
                            ['label' => 'Pumps', 'url' => ['pump/index'], 'iconStyle' => 'far'],
                            ['label' => 'Grades', 'iconStyle' => 'far'],
                            ['label' => 'Nozzels', 'iconStyle' => 'far'],
                        ]
                    ],
                    ['label' => 'Sales', 'url' => ['sales/index']],
                    [
                        'label' => 'Settings',
                        'items' => [
                            ['label' => 'Users', 'url' => ['user/index'], 'iconStyle' => 'far'],
                            ['label' => 'Permissions', 'iconStyle' => 'far'],
                            ['label' => 'Roles', 'iconStyle' => 'far'],
                        ]
                    ],

                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>