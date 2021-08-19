<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cart`.
 */
class m170130_113234_create_cart_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'price'=>$this->decimal(),
            'qty'=>$this->decimal(),
            'total'=>$this->decimal(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        $this->createIndex(
            'idx-cart-product_id',
            'cart',
            'product_id'
        );


        $this->addForeignKey(
            'fk-cart-product_id',
            'cart',
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
        $this->dropForeignKey(
            'fk-tbl_cart-product_id',
            'tbl_cart'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_cart-product_id',
            'cart'
        );
        $this->dropTable('cart');
    }
}
