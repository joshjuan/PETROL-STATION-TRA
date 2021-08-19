<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_adjustment`.
 */
class m170518_113604_create_adjustment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('adjustment', [
            'id' => $this->primaryKey(),
            'transferred_good_id'=>$this->integer()->notNull(),
            'total_qty'=>$this->decimal()->notNull(),
            'adjusted_stock'=>$this->decimal()->notNull(),
            'transferred_qty'=>$this->decimal()->notNull(),
            'comment'=>$this->string(200)->notNull(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        // creates index for column `sales_id`
        $this->createIndex(
            'idx-adjustment-transferred_good_id',
            'adjustment',
            'transferred_good_id'
        );


        $this->addForeignKey(
            'fk-adjustment-transferred_good_id',
            'adjustment',
            'transferred_good_id',
            'transferred_good',
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
            'fk-adjustment-transferred_good_id',
            'adjustment'
        );

        // drops index for column `transferred_good_id`
        $this->dropIndex(
            'idx-adjustment-transferred_good_id',
            'adjustment'
        );
        $this->dropTable('adjustment');
    }
}
