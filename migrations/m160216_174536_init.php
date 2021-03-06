<?php
/**
 * @copyright Copyright (c) 2015 Yiister
 * @license https://github.com/yiister/yii2-target-model/blob/master/LICENSE
 * @link https://github.com/yiister/yii2-target-model
 */

use yii\db\Migration;
use yiister\tm\TargetModel;

class m160216_174536_init extends Migration
{
    public function up()
    {
        $this->createTable(
            TargetModel::tableName(),
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(50)->notNull(),
                'class_name' => $this->string(255)->notNull(),
            ],
            'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
        );
        $this->createIndex('uq-target_model-class_name', TargetModel::tableName(), 'class_name', true);
    }

    public function down()
    {
        $this->dropTable(TargetModel::tableName());
    }
}
