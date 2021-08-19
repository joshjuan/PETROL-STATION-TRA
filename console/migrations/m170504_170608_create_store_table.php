<?php

use yii\db\Migration;

/**
 * Handles the creation of table `store`.
 */
class m170504_170608_create_store_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('store', [
            'id' => $this->primaryKey(),
            'store_name'=>$this->string(200)->notNull(),
            'store_keeper'=>$this->string(200)->notNull(),

        ]);



    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('store');
    }
}
