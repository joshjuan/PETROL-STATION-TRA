<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_quotation}}`.
 */
class m210405_072343_create_request_quotation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_quotation}}', [
            'id' => $this->primaryKey(),
            'reference_number' => $this->string(200)->notNull(),
            'order_date' => $this->date()->notNull(),
            'supplier_id' => $this->integer()->notNull(),
            'sub_total_amount' => $this->decimal(20,2),
            'tax' => $this->decimal(20,2),
            'total_amount' => $this->decimal(20,2),
            'status' => $this->integer()->notNull(),
            'maker' => $this->string(200),
            'maker_time' => $this->dateTime()

        ]);


        // creates index for column `supplier_id`
        $this->createIndex(
            'idx-request_quotation-supplier_id',
            'request_quotation',
            'supplier_id'
        );


        $this->addForeignKey(
            'fk-request_quotation-supplier_id',
            'request_quotation',
            'supplier_id',
            'supplier',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request_quotation}}');
    }
}
