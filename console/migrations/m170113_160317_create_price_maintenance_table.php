<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price_maintenance`.
 */
class m170113_160317_create_price_maintenance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('price_maintenance', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'price_type'=>$this->integer()->notNull(),
            'old_price'=>$this->decimal()->notNull(),
            'new_price'=>$this->decimal()->notNull(),
            'reason'=>$this->string(200)->notNull(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'auth_status'=>$this->char(1),
            'checker_id'=>$this->string(200)->notNull(),
            'checker_time'=>$this->dateTime()->notNull(),
        ]);


        // creates index for column `product_id`
        $this->createIndex(
            'idx-price_maintenance-product_id',
            'price_maintenance',
            'product_id'
        );


        $this->addForeignKey(
            'fk-price_maintenance-product_id',
            'price_maintenance',
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


        // drops foreign key for table `price_maintenance`
        $this->dropForeignKey(
            'fk-price_maintenance-product_id',
            'price_maintenance'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-price_maintenance-product_id',
            'price_maintenance'
        );
        $this->dropTable('price_maintenance');
    }
}
