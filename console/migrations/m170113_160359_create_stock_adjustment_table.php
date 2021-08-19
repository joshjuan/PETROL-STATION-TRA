<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stock_adjustment`.
 */
class m170113_160359_create_stock_adjustment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('stock_adjustment', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'adjust_type'=>$this->integer()->notNull(),
            'qty'=>$this->decimal()->notNull(),
            'stock_change'=>$this->decimal()->notNull(),
            'amount'=>$this->decimal()->notNull(),
            'total_amount'=>$this->integer()->notNull(),
            'description'=>$this->string(200)->notNull(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'delete_status'=>$this->char(1),
            'auth_status'=>$this->char(1),
            'checker_id'=>$this->string(200)->notNull(),
            'checker_time'=>$this->dateTime()->notNull(),

        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-stock_adjustment-product_id',
            'stock_adjustment',
            'product_id'
        );


        $this->addForeignKey(
            'fk-stock_adjustment-product_id',
            'stock_adjustment',
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

        // drops foreign key for table `stock_adjustment`
        $this->dropForeignKey(
            'fk-stock_adjustment-product_id',
            'stock_adjustment'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-stock_adjustment-product_id',
            'stock_adjustment'
        );
        $this->dropTable('stock_adjustment');
    }
}
