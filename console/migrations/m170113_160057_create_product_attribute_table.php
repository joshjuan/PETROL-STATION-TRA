<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_attribute`.
 */
class m170113_160057_create_product_attribute_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_attribute', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'attribute_name'=>$this->string(20)->notNull(),
            'quantity'=>$this->decimal()->notNull()
        ]);


        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_attribute-product_id',
            'product_attribute',
            'product_id'
        );


        $this->addForeignKey(
            'fk-product_attribute-product_id',
            'product_attribute',
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
        // drops foreign key for table `product_attribute`
        $this->dropForeignKey(
            'fk-product_attribute-product_id',
            'product_attribute'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_attribute-product_id',
            'product_attribute'
        );

        $this->dropTable('product_attribute');
    }
}
