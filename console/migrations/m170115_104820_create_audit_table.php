<?php

use yii\db\Migration;

/**
 * Handles the creation of table `audit`.
 */
class m170115_104820_create_audit_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('audit', [
            'id' => $this->primaryKey(),
            'activity'=>$this->string(200),
            'module'=>$this->string(200),
            'action'=>$this->string(200),
            'maker'=>$this->string(200),
            'maker_time'=>$this->string(200)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('audit');
    }
}
