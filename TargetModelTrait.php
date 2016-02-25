<?php
/**
 * @copyright Copyright (c) 2015 Yiister
 * @license https://github.com/yiister/yii2-target-model/blob/master/LICENSE
 * @link https://github.com/yiister/yii2-target-model
 */

namespace yiister\tm;

trait TargetModelTrait
{
    public function getTargetModel()
    {
        return TargetModel::getTargetModel(get_class($this));
    }
}
