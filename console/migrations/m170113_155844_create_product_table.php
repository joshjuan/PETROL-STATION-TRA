<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m170113_155844_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'product_name'=>$this->string(200)->notNull(),
            'description'=>$this->text(),
            'category'=>$this->integer()->notNull(),
            'type_id'=>$this->integer()->notNull(),
            'status'=>$this->integer()->notNull(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),

        ]);

        // creates index for column `category`
        $this->createIndex(
            'idx-product-category',
            'product',
            'category'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-product-category',
            'product',
            'category',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `type_id`
        $this->createIndex(
            'idx-product-type_id',
            'product',
            'type_id'
        );

        // add foreign key for table `tbl_category`
        $this->addForeignKey(
            'fk-product-type_id',
            'product',
            'type_id',
            'product_type',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-product-category',
            'product'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-product-category',
            'product'
        );
        // drops foreign key for table `product_type`
        $this->dropForeignKey(
            'fk-product-type_id',
            'product'
        );

        // drops index for column `type_id`
        $this->dropIndex(
            'idx-product-type_id',
            'product'
        );
        $this->dropTable('product');
    }
}
