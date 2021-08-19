<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_quotation_item}}`.
 */
class m210405_073429_create_request_quotation_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_quotation_item}}', [
            'id' => $this->primaryKey(),
            'request_quotation_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'description' => $this->string(200),
            'quantity' => $this->integer()->notNull(),
            'unit_price' => $this->decimal(20,2)->notNull(),
            'tax' => $this->decimal(20,2),
            'sub_total' => $this->decimal(20,2),
            'maker' => $this->string(200),
            'maker_time' => $this->dateTime()
        ]);


        // creates index for column `request_quotation_id`
        $this->createIndex(
            'idx-request_quotation_item-request_quotation_id',
            'request_quotation_item',
            'request_quotation_id'
        );


        $this->addForeignKey(
            'fk-request_quotation_item-request_quotation_id',
            'request_quotation_item',
            'request_quotation_id',
            'request_quotation',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request_quotation_item}}');
    }
}
