<?php

namespace yuncms\attention\migrations;

use yii\db\Migration;

/**
 * Class M170827073216Create_user_tag_table
 */
class M170827073216Create_user_tag_table extends Migration
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
        $this->createTable('{{%user_tag}}', [
            'user_id' => $this->integer()->notNull()->comment('用户ID'),
            'tag_id' => $this->integer()->notNull()->comment('TAG_ID'),
        ], $tableOptions);
        $this->addPrimaryKey('', '{{%user_tag}}', ['user_id', 'tag_id']);
        $this->addForeignKey('user_tag_ibfk_1', '{{%user_tag}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_tag_ibfk_2', '{{%user_tag}}', 'tag_id', '{{%tag}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_tag}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M170827073216Create_user_tag_table cannot be reverted.\n";

        return false;
    }
    */
}
