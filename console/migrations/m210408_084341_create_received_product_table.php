<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%received_product}}`.
 */
class m210408_084341_create_received_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%received_product}}', [
            'id' => $this->primaryKey(),
            'received_date' => $this->date()->notNull(),
            'purchase_order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->decimal(20,2)->notNull(),
            'received' => $this->decimal(20,2)->notNull(),
            'balance' => $this->decimal(20,2)->notNull(),
            'status' => $this->integer(),
            'maker' => $this->string(200),
            'maker_time' => $this->dateTime()
        ]);


        // creates index for column `purchase_order_id`
        $this->createIndex(
            'idx-received_product-purchase_order_id',
            'received_product',
            'purchase_order_id'
        );


        $this->addForeignKey(
            'fk-received_product-purchase_order_id',
            'received_product',
            'purchase_order_id',
            'request_quotation',
            'id',
            'CASCADE'
        );


        // creates index for column `product_id`
        $this->createIndex(
            'idx-received_product-product_id',
            'received_product',
            'product_id'
        );


        $this->addForeignKey(
            'fk-received_product-product_id',
            'received_product',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%received_product}}');
    }
}
