<?php

use yii\db\Migration;

/**
 * Handles the creation of table `system_setup`.
 */
class m170113_160549_create_system_setup_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('system_setup', [
            'id' => $this->primaryKey(),
            'tax'=>$this->decimal(),
            'discount'=>$this->decimal(),
            'currency'=>$this->string(20),
            'shop_name'=>$this->string(200),
            'shop_category'=>$this->string(200),
            'maker_checker'=>$this->char(1),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('system_setup');
    }
}
