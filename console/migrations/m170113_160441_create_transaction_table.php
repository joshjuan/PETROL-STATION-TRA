<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transaction`.
 */
class m170113_160441_create_transaction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('transaction', [
            'id' => $this->primaryKey(),
            'trn_ref_no'=>$this->integer()->notNull(),
            'trn_dt'=>$this->date()->notNull(),
            'module'=>$this->char(2)->notNull(),
            'period'=>$this->string(3)->notNull(),
            'year'=>$this->string(10)->notNull(),
            'delete_stat'=>$this->char(1),
            'auth_status'=>$this->char(1),
            'trn_event'=>$this->char(3),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'checker_id'=>$this->string(200)->notNull(),
            'checker_time'=>$this->dateTime()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('transaction');
    }
}
