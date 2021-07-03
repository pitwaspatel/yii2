<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $iso_639-1
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['name'], 'filter','filter'=>'trim'],
            [['name'], 'string', 'max' => 49],
            [['iso_639-1'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'iso_639-1' => 'Iso 639 1',
        ];
    }
}
