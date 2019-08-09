<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ingredient_recipe}}`.
 */
class m190808_094431_create_ingredient_recipe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ingredient_recipe}}', [
            'ingredient_id' => $this->integer(),
            'recipe_id' => $this->integer(),
        ]);

        $this->addPrimaryKey(null, '{{%ingredient_recipe}}', ['ingredient_id', 'recipe_id']);
        $this->createIndex('recipe_id', '{{%ingredient_recipe}}', 'recipe_id');

        $this->addForeignKey(
            'ibfk__ingredient',
            '{{%ingredient_recipe}}',
            'ingredient_id',
            '{{%ingredient}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'ibfk__recipe',
            '{{%ingredient_recipe}}',
            'recipe_id',
            '{{%recipe}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('ibfk__ingredient', '{{%ingredient_recipe}}');
        $this->dropForeignKey('ibfk__recipe', '{{%ingredient_recipe}}');
        $this->dropTable('{{%ingredient_recipe}}');
    }
}
