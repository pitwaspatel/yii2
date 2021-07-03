<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cm_files".
 *
 * @property int $id
 * @property string|null $file
 * @property int|null $type
 * @property int $articles_id
 */
class CmFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cm_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'articles_id'], 'integer'],
            [['articles_id'], 'required'],
            [['file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file' => 'File',
            'type' => 'Type',
            'articles_id' => 'Articles ID',
        ];
    }
}
