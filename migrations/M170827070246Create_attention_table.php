<?php

namespace yuncms\attention\migrations;

use yii\db\Migration;

/**
 * Class M170827070246Create_attention_table
 */
class M170827070246Create_attention_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /**
         * 用户关注表
         */
        $this->createTable('{{%attentions}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'model' => $this->string()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('{{%attentions_ibfk_1}}', '{{%attentions}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
        $this->createIndex('attentions_index', '{{%attentions}}', ['model_id', 'model'], false);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%attentions}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M170827070246Create_attention_table cannot be reverted.\n";

        return false;
    }
    */
}
