<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaction}}`.
 */
class m210203_095334_create_transaction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'trn_date' => $this->date(),
            'trn_time' => $this->timestamp(),
            'transaction_id' => $this->integer(),
            'pump_number' => $this->integer(),
            'nozzel_number' => $this->integer(),
            'product_name' => $this->string(200),
            'volume' => $this->decimal(10,2),
            'price' => $this->decimal(10,2),
            'amount' => $this->decimal(20,2),
            'tax' => $this->decimal(10,2),
            'total_amount' => $this->decimal(20,2),
            'qr_code' => $this->text(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transaction}}');
    }
}
