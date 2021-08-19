<?php
if (!Yii::$app->user->isGuest) {
?>
<aside class="main-sidebar sidebar-light-gray-dark elevation-4 " style="background: darkgrey; color: lightgrey">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link text-center" style="background: darkgoldenrod">

        <span class="brand-text font-weight-light" ><b>Web Psms</b></span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">

            <?php

            echo \hail812\adminlte3\widgets\Menu::widget([
                'items' => [
                    ['label' => 'SUPERMARKET SECTION', 'header' => true],
                    [
                        'label' => 'POS',
                        'icon' => 'fas fa-plus-square',
                        'items' => [
                            ['label' => 'New Session', 'url' => ['pos-sale/cart'], 'iconStyle' => 'far'],
                            ['label' => 'POS Sales', 'url' => ['pos-sale/index'], 'iconStyle' => 'far'],

                        ]
                    ],

                    [
                        'label' => 'Products',
                        'icon' => 'fas fa-plus-square',
                        'items' => [
                            ['label' => 'Products', 'url' => ['product/index'], 'iconStyle' => 'far'],
                            ['label' => 'Suppliers', 'url' => ['supplier/index'],'iconStyle' => 'far'],
                            ['label' => 'Inventory', 'url' => ['inventory/index'],'iconStyle' => 'far'],
                            ['label' => 'Product Type', 'url' => ['product-type/index'],'iconStyle' => 'far'],
                            ['label' => 'Categories', 'url' => ['category/index'],'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Purchases',
                        'icon' => 'fas fa-plus-square',
                        'items' => [
                            ['label' => 'Request for Quotations', 'url' => ['request-quotation/requests'], 'iconStyle' => 'far'],
                            ['label' => 'Purchase Orders', 'url' => ['request-quotation/orders'],'iconStyle' => 'far'],
                            ['label' => 'Bills', 'url' => ['request-quotation/bills'],'iconStyle' => 'far'],
                            ['label' => 'Payments', 'url' => ['request-quotation/payments'],'iconStyle' => 'far'],
                        ]
                    ],
                    ['label' => 'PETROL STATION SECTION', 'header' => true],
                    [
                        'label' => 'Configuration',
                        'icon' => 'fas fa-plus-square',
                        'items' => [
                            ['label' => 'Company', 'url' => ['company/index'], 'iconStyle' => 'far'],
                            ['label' => 'Pumps', 'url' => ['pump/index'], 'iconStyle' => 'far'],
                            ['label' => 'Grades', 'url' => ['grade/index'],'iconStyle' => 'far'],
                            ['label' => 'Nozzels', 'url' => ['nozzel/index'],'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Pump Control',
                        'icon' => 'fas fa-plus-square',
                        'items' => [
                            ['label' => 'Pump status', 'url' => ['pump/view-status']],
                            ['label' => 'Change Price', 'url' => ['grade/change-price']],
                        ]
                    ],
                    [
                        'label' => 'Reports',
                        'icon' => 'fas fa-plus-square',
                        'items' => [
                            ['label' => 'Sales', 'url' => ['report/sales']],
                            ['label' => 'Z - Reports', 'url' => ['report/z-report']],
                        ]
                    ],

                    ['label' => 'STAFF MANAGEMENT SECTION', 'header' => true],
                    [
                        "label" =>Yii::t('app','Employees'),
                        "url" =>  "#",
                        //  'visible' => yii::$app->user->can('manageUser'),
                        'icon' =>  'fas fa-plus-square',
                        "items" => [

                            [
                                //'visible' => (Yii::$app->user->identity->username == 'admin'),
                                "label" => "New Employee",
                                "url" => ["/employee/create"],
                                "icon" => "user",
                            ],

                            [
                                //'visible' => (Yii::$app->user->identity->username == 'admin'),
                                "label" => "Employees",
                                "url" => ["/employee/index"],
                                "icon" => "user",
                            ],

                                    [
                                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                                        "label" => "New Department",
                                        "url" => ["/department/create"],
                                        "icon" => "lock",
                                    ],
                                    [
                                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                                        "label" => "Departments",
                                        "url" => ["/department/index"],
                                        "icon" => "lock",
                                    ],


                        ]
                    ],
                    [
                        "label" =>Yii::t('app','Shift Management'),
                        "url" =>  "#",
                        //  'visible' => yii::$app->user->can('manageUser'),
                        'icon' =>  'fas fa-plus-square',
                        "items" => [

                            [
                                //'visible' => (Yii::$app->user->identity->username == 'admin'),
                                "label" => "New Shift",
                                "url" => ["/shift/create"],
                                "icon" => "lock",
                            ],
                            [
                                //'visible' => (Yii::$app->user->identity->username == 'admin'),
                                "label" => "Shifts",
                                "url" => ["/shift/index"],
                                "icon" => "lock",
                            ],


                        ]
                    ],

                    [
                        "label" =>Yii::t('app','Access Management'),
                        "url" =>  "#",
                      //  'visible' => yii::$app->user->can('manageUser'),
                        'icon' => 'lock',
                        "items" => [

                            [
                                //'visible' => (Yii::$app->user->identity->username == 'admin'),
                                "label" => "Users",
                                "url" => ["/user/index"],
                                "icon" => "user",
                            ],

                            [
                                'visible' => (Yii::$app->user->identity->username == 'admin'),
                                'label' => Yii::t('app', 'Manager Permissions'),
                                'url' => ['/auth-item/index'],
                                'icon' => 'lock',
                            ],
                            [
                                //'visible' => (Yii::$app->user->identity->username == 'admin'),
                                'label' => Yii::t('app', 'Manage User Roles'),
                                'url' => ['/role/index'],
                                'icon' => 'lock',
                            ],
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

    <?php
}
?>