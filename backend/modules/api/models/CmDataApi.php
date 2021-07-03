<?php

namespace app\modules\api\models;

use Yii;
/**
* @OA\Schema(
*      schema="CmDataApi",
*      required={"article_id"},
*     @OA\Property(
*        property="id",
*        description="",
*        type="integer",
*        format="int64",
*    ),
*     @OA\Property(
*        property="product",
*        description="",
*        type="string",
*        maxLength=255,
*    ),
*     @OA\Property(
*        property="brand_id",
*        description="",
*        type="string",
*    ),
*     @OA\Property(
*        property="category_id",
*        description="",
*        type="integer",
*        format="int64",
*    ),
*     @OA\Property(
*        property="sub_cat_id",
*        description="",
*        type="integer",
*        format="int64",
*    ),
*     @OA\Property(
*        property="ad_form",
*        description="",
*        type="string",
*        maxLength=100,
*    ),
*     @OA\Property(
*        property="tag",
*        description="",
*        type="string",
*    ),
*     @OA\Property(
*        property="ad_code",
*        description="",
*        type="string",
*        maxLength=50,
*    ),
*     @OA\Property(
*        property="slogan",
*        description="",
*        type="string",
*        maxLength=250,
*    ),
*     @OA\Property(
*        property="file_id",
*        description="",
*        type="integer",
*        format="int64",
*    ),
*     @OA\Property(
*        property="sample_ID",
*        description="",
*        type="string",
*        maxLength=255,
*    ),
*     @OA\Property(
*        property="sample_status",
*        description="",
*        type="string",
*        maxLength=250,
*    ),
*     @OA\Property(
*        property="cm_code",
*        description="",
*        type="string",
*        maxLength=50,
*    ),
*     @OA\Property(
*        property="article_id",
*        description="",
*        type="integer",
*        format="int64",
*    ),
*     @OA\Property(
*        property="report_id_number",
*        description="",
*        type="string",
*        maxLength=255,
*    ),
* )
*/

/**
 * This is the model class for table "cm_data".
 *
 * @property int $id
 * @property string $product
 * @property string $brand_id
 * @property int $category_id
 * @property int $sub_cat_id
 * @property string $ad_form
 * @property string $tag
 * @property string $ad_code
 * @property string $slogan
 * @property int $file_id
 * @property string $sample_ID
 * @property string $sample_status
 * @property string $cm_code
 * @property int $article_id
 * @property string $report_id_number
 */
class CmDataApi extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => \yii2tech\ar\softdelete\SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'deleted_at' =>  time(),
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0
                ]
//                'replaceRegularDelete' => true
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' =>  time(),
            ],
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cm_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand_id', 'tag'], 'string'],
            [['category_id', 'sub_cat_id', 'file_id', 'article_id'], 'integer'],
            [['article_id'], 'required'],
            [['product', 'sample_ID', 'report_id_number'], 'string', 'max' => 255],
            [['ad_form'], 'string', 'max' => 100],
            [['ad_code', 'cm_code'], 'string', 'max' => 50],
            [['slogan', 'sample_status'], 'string', 'max' => 250],
            [['cm_code'], 'unique'],
            [['sample_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product' => 'Product',
            'brand_id' => 'Brand ID',
            'category_id' => 'Category ID',
            'sub_cat_id' => 'Sub Cat ID',
            'ad_form' => 'Ad Form',
            'tag' => 'Tag',
            'ad_code' => 'Ad Code',
            'slogan' => 'Slogan',
            'file_id' => 'File ID',
            'sample_ID' => 'Sample ID',
            'sample_status' => 'Sample Status',
            'cm_code' => 'Cm Code',
            'article_id' => 'Article ID',
            'report_id_number' => 'Report Id Number',
        ];
    }


    public static function find()
    {
    $query = parent::find();

    $query->attachBehavior('softDelete', \yii2tech\ar\softdelete\SoftDeleteQueryBehavior::className());

    return $query->notDeleted();
    }

    public function fields()
    {
        $fields = parent::fields();
        $customFields = [
            'created_at' => function ($model) {
                return \Yii::$app->formatter->asDatetime($model->created_at,'php:c');
            },
            'updated_at' => function ($model) {
                return \Yii::$app->formatter->asDatetime($model->updated_at,'php:c');
            },
        ];
        unset($fields['deleted_at']);

        return \yii\helpers\ArrayHelper::merge($fields, $customFields);
    }

    public function extraFields()
    {
        return [
            'creator',
            'updater'
        ];
    }

    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

}
