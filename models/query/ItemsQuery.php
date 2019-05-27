<?php

namespace artsoft\portfolio\models\query;

/**
 * This is the ActiveQuery class for [[\artsoft\portfolio\models\Items]].
 *
 * @see \artsoft\portfolio\models\PortfolioItems
 */
class ItemsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \artsoft\portfolio\models\Items[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \artsoft\portfolio\models\Items|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
