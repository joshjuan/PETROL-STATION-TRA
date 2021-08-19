<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transferred_good`.
 */
class m170505_161321_create_transferred_good_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('transferred_good', [
            'id' => $this->primaryKey(),
            'transfer_date'=>$this->date()->notNull(),
            'store_id'=>$this->integer()->notNull(),
            'product_id'=>$this->integer()->notNull(),
            'qty'=>$this->decimal()->notNull(),
            'balance'=>$this->decimal()->notNull(),
            'horse_number'=>$this->string(200)->notNull(),
            'trailer_number'=>$this->string(200),
            'driver_name'=>$this->string(200),
            'driver_phonenumber'=>$this->string(200),
            'status'=>$this->integer(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),

        ]);
        // creates index for column `store_id`
        $this->createIndex(
            'idx-transferred_good-store_id',
            'transferred_good',
            'store_id'
        );


        $this->addForeignKey(
            'fk-transferred_good-store_id',
            'transferred_good',
            'store_id',
            'store',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            'idx-transferred_good-product_id',
            'transferred_good',
            'product_id'
        );


        $this->addForeignKey(
            'fk-transferred_good-product_id',
            'transferred_good',
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
        // drops foreign key for table `tbl_product`
        $this->dropForeignKey(
            'fk-transferred_good-store_id',
            'transferred_good'
        );

        // drops index for column `store_id`
        $this->dropIndex(
            'idx-transferred_good-store_id',
            'transferred_good'
        );

        // drops foreign key for table `tbl_product`
        $this->dropForeignKey(
            'fk-transferred_good-product_id',
            'transferred_good'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-transferred_good-product_id',
            'transferred_good'
        );
        $this->dropTable('transferred_good');
    }
}
