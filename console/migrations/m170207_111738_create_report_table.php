<?php

use yii\db\Migration;

/**
 * Handles the creation of table `report`.
 */
class m170207_111738_create_report_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('report', [
            'id' => $this->primaryKey(),
            'report_name'=>$this->string(200)->notNull(),
            'module'=>$this->integer(),
            'path'=>$this->string(200),
            'status'=>$this->integer(),
        ]);

        // creates index for column `module`
        $this->createIndex(
            'idx-report-module',
            'report',
            'module'
        );


        // add foreign key for table `system_module`
        $this->addForeignKey(
            'fk-report-module',
            'report',
            'module',
            'system_module',
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
            'fk-report-module',
            'report'
        );

        // drops index for column `report`
        $this->dropIndex(
            'idx-report-module',
            'report'
        );
        $this->dropTable('report');
    }
}
