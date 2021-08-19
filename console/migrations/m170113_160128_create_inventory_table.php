<?php

use yii\db\Migration;

/**
 * Handles the creation of table `inventory`.
 */
class m170113_160128_create_inventory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('inventory', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull()->unique(),
            'buying_price'=>$this->decimal()->notNull(),
            'selling_price'=>$this->decimal()->notNull(),
            'qty'=>$this->decimal()->notNull(),
            'min_level'=>$this->integer(),
            'last_updated'=>$this->dateTime(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'auth_status'=>$this->char(1),
            'checker_id'=>$this->string(200)->notNull(),
            'checker_time'=>$this->dateTime()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-inventory-product_id',
            'inventory',
            'product_id'
        );


        $this->addForeignKey(
            'fk-inventory-product_id',
            'inventory',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `inventory`
        $this->dropForeignKey(
            'fk-inventory-product_id',
            'inventory'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-inventory-product_id',
            'inventory'
        );
        $this->dropTable('inventory');
    }
}
