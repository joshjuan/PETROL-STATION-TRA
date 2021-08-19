<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_type`.
 */
class m170113_155021_create_product_type_table extends Migration
{
    /*
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_type', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(200)->notNull(),
            'description'=>$this->string(200)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_type');
    }
}
