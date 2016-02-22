<?php

namespace yiister\tm;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%yiister_target_model}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $class_name
 */
class TargetModel extends \yii\db\ActiveRecord
{
    /** @var array of TargetModel attributes */
    protected static $identityMap = [];

    /** @var array of validator rules */
    protected $generatedRules;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%yiister_target_model}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        if ($this->generatedRules === null) {
            $this->generatedRules = [
                [['name', 'class_name'], 'required'],
                [['name'], 'string', 'max' => 50],
                [['class_name'], 'string', 'max' => 255],
            ];
            $safeAttributes = [];
            foreach ($this->getTableSchema()->columns as $column) {
                if (in_array($column->name, ['id', 'name', 'class_name']) === false) {
                    $safeAttributes[] = $column->name;
                }
            }
            if (count($safeAttributes) > 0) {
                $this->generatedRules[] = [$safeAttributes, 'safe'];
            }
        }
        return $this->generatedRules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'class_name' => 'Class name',
        ];
    }

    /**
     * Create a new TargetModel.
     * @param string $className
     * @param string $name
     * @return static
     * @throws \Exception
     */
    public static function createModel($className, $name = null)
    {
        $targetModel = new static;
        $targetModel->class_name = $className;
        $targetModel->name = $name !== null ? $name : (new \ReflectionClass($className))->getShortName();
        if ($targetModel->save() === false) {
            throw new \Exception('Cannot save a new record');
        }
        return $targetModel;
    }

    /**
     * Get a TargetModel as array by className.
     * @param string | ActiveRecord $className
     * @return array
     * @throws \Exception
     */
    public static function getTargetModel($className)
    {
        if (is_object($className) === true) {
            $className = get_class($className);
        }
        $className = ltrim($className, '\\');
        if (isset(static::$identityMap[$className]) === false) {
            static::$identityMap[$className] = static::find()
                ->asArray(true)
                ->where(['class_name' => $className])
                ->one();
            if (static::$identityMap[$className] === null) {
                static::$identityMap[$className] = static::createModel($className)->toArray();
            }
        }
        return static::$identityMap[$className];
    }
}
