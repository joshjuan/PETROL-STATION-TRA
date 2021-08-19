<?php

use yii\db\Migration;

/**
 * Handles the creation of table `supplier`.
 */
class m170113_155021_create_supplier_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('supplier', [
            'id' => $this->primaryKey(),
            'supplier_name'=>$this->string(200)->notNull(),
            'email'=>$this->string(200),
            'phone_number'=>$this->string(200)->notNull(),
            'location'=>$this->string(200),

        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        $this->dropTable('supplier');
    }
}
