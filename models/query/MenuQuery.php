<?php

namespace artsoft\portfolio\models\query;

/**
 * This is the ActiveQuery class for [[\artsoft\portfolio\models\Menu]].
 *
 * @see \artsoft\portfolio\models\Menu
 */
class MenuQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \artsoft\portfolio\models\Menu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \artsoft\portfolio\models\Menu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
