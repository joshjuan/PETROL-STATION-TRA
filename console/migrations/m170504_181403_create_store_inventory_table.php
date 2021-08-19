<?php

use yii\db\Migration;

/**
 * Handles the creation of table `store_inventory`.
 */
class m170504_181403_create_store_inventory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('store_inventory', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'buying_price'=>$this->decimal()->notNull(),
            'selling_price'=>$this->decimal()->notNull(),
            'qty'=>$this->decimal()->notNull(),
            'store_id'=>$this->integer()->notNull(),
            'last_updated'=>$this->dateTime(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-store_inventory-product_id',
            'store_inventory',
            'product_id'
        );


        $this->addForeignKey(
            'fk-store_inventory-product_id',
            'store_inventory',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `store_id`
        $this->createIndex(
            'idx-store_inventory-store_id',
            'store_inventory',
            'store_id'
        );


        $this->addForeignKey(
            'fk-store_inventory-store_id',
            'store_inventory',
            'store_id',
            'store',
            'id',
            'CASCADE'
        );


    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-store_inventory-product_id',
            'store_inventory'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-store_inventory-product_id',
            'store_inventory'
        );

        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-store_inventory-store_id',
            'store_inventory'
        );

        // drops index for column `store_id`
        $this->dropIndex(
            'idx-store_inventory-store_id',
            'store_inventory'
        );
        $this->dropTable('store_inventory');
    }
}
