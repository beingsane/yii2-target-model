<?php

namespace yiister\tm;

trait TargetModelTrait
{
    public function getTargetModel()
    {
        return TargetModel::getTargetModel(get_class($this));
    }
}
