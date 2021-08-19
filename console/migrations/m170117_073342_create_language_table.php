<?php

use yii\db\Migration;

/**
 * Handles the creation of table `language`.
 */
class m170117_073342_create_language_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('language', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(100)->unique(),
            'language_code'=>$this->char(5),
            'status'=>$this->string(20)->notNull(),
        ]);
        $this->insert('language',array(
            'title'=>'English',
            'language_code' =>'en',
            'status' => 'default',
        ));
        $this->insert('language',array(
            'title'=>'Swahili',
            'language_code' =>'sw',
            'status' => 'active',
        ));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('language');
    }
}
