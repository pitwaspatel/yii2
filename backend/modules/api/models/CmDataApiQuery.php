<?php

namespace app\modules\api\models;

/**
 * This is the ActiveQuery class for [[CmDataApi]].
 *
 * @see CmDataApi
 */
class CmDataApiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmDataApi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmDataApi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
