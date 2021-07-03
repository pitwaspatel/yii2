<?php

namespace backend\modules\cmdata\controllers;

use backend\models\Category;
use backend\models\CmDataReportSearch;
use backend\models\CmFiles;
use backend\models\SubCategory;
use Yii;
use backend\models\CmData;
use backend\models\CmDataSearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\CmDataReport;
use backend\models\Articles;
use backend\models\Media;
use yii\web\UploadedFile;

/**
 * CmDataController implements the CRUD actions for CmData model.
 */
class CmDataController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CmData models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CmDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmData model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CmData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmData();
        $CmDataReportModel = new CmDataReport();
        $articleModel = new Articles();
        $mediaModel = new Media();
        $fileModel = new CmFiles();

        if ($model->load(Yii::$app->request->post()) &&
            $CmDataReportModel->load(Yii::$app->request->post()) &&
            $articleModel->load(Yii::$app->request->post())
//            $mediaModel->load(Yii::$app->request->post())
        ) {
            $transation = Yii::$app->db->beginTransaction();
            try {
                $flag = true;
                $mediaModel->name = $CmDataReportModel->name;
                $mediaModel->language = $CmDataReportModel->language;
                $mediaModel->apps_countries_id = $CmDataReportModel->apps_countries_id;
                $mediaModel->name = $CmDataReportModel->name;
                if (!$mediaModel->save()) {
                    $flag = false;
                    $transation->rollBack();
                } else {
                    if ($flag = $mediaModel->save()) {
                        $articleModel->sub_category_id = $model->sub_cat_id;
                        $articleModel->brand = $model->brand_id;
                        $articleModel->slogan = $model->slogan;
                        $articleModel->tags = $model->tag;
                        $articleModel->media_id = $mediaModel->id;
                        $articleModel->category_category_id = $model->category_id;
                        if (!$articleModel->save()) {
                            $flag = false;
                            $transation->rollBack();
                        } else {
                            if ($flag = $articleModel->save()) {
                                $model->article_id = $articleModel->id;
                                if (!$model->save()) {
                                    $flag = false;
                                    $transation->rollBack();
                                } else {
                                    if ($flag = $model->save()) {
                                        if ($model->file_id) {
                                            $fileModel->file = UploadedFile::getInstance($fileModel, 'file');
                                            $file_name = rand() . $fileModel->file->baseName . '.' . $fileModel->file->extension;
                                            $fileModel->file->saveAs('uploads/' . $file_name);
                                            $fileModel->file = $file_name;
                                            $fileModel->articles_id = $articleModel->id;
                                            if (!$fileModel->save()) {
                                                $flag = false;
                                                $transation->rollBack();
                                            } else {
                                                $flag = $fileModel->save();
                                            }
                                        }

                                        $model->cm_code = Yii::$app->params['cmCode'] . $model->id;
                                        $model->save(true, ['cm_code']);
                                        $CmDataReportModel->match_date = Yii::$app->formatter->asDate($CmDataReportModel->match_date, "Y-m-d");
                                        $CmDataReportModel->name = $mediaModel->name;
                                        $CmDataReportModel->sample_ID = $model->sample_ID;
                                        if (!$CmDataReportModel->save()) {
                                            $flag = false;
                                            $transation->rollBack();
                                        } else {
                                            $flag = $CmDataReportModel->save();
                                        }
                                    }
                                }

                            }
                        }
                    }
                }

            } catch (Exception $ex) {
                $transation->rollBack();
                Yii::$app->session->setFlash("error", "Data Saving Failed");

            }
            if ($flag) {
                $transation->commit();
                Yii::$app->session->setFlash("success", "Data Saved Successfully");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
//                print_r($model->errors);
//                print_r($CmDataReportModel->errors);
//                print_r($articleModel->errors);
//                print_r($mediaModel->errors);die;
                $transation->rollBack();
                Yii::$app->session->setFlash("error", "Data Saving Failed2");
            }

        }

        return $this->render('create', [
            'model' => $model,
            'CmDataReportModel' => $CmDataReportModel,
            'articleModel' => $articleModel,
        ]);
    }

    /**
     * Updates an existing CmData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $CmDataReportModel = new CmDataReport();
        $articleModel = new Articles();
        $mediaModel = new Media();
        $fileModel = new CmFiles();

        if ($model->load(Yii::$app->request->post()) &&
            $CmDataReportModel->load(Yii::$app->request->post()) &&
            $articleModel->load(Yii::$app->request->post())
//            $mediaModel->load(Yii::$app->request->post())
        ) {
            $transation = Yii::$app->db->beginTransaction();
            try {
                $flag = true;
                $mediaModel->name = $CmDataReportModel->name;
                $mediaModel->language = $CmDataReportModel->language;
                $mediaModel->apps_countries_id = $CmDataReportModel->apps_countries_id;
                $mediaModel->name = $CmDataReportModel->name;
                if (!$mediaModel->save()) {
                    $flag = false;
                    $transation->rollBack();
                } else {
                    if ($flag = $mediaModel->save()) {
                        $articleModel->sub_category_id = $model->sub_cat_id;
                        $articleModel->brand = $model->brand_id;
                        $articleModel->slogan = $model->slogan;
                        $articleModel->tags = $model->tag;
                        $articleModel->media_id = $mediaModel->id;
                        $articleModel->category_category_id = $model->category_id;
                        if (!$articleModel->save()) {
                            $flag = false;
                            $transation->rollBack();
                        } else {
                            if ($flag = $articleModel->save()) {
                                $model->article_id = $articleModel->id;
                                if (!$model->save()) {
                                    $flag = false;
                                    $transation->rollBack();
                                } else {
                                    if ($flag = $model->save()) {
                                        if ($model->file_id) {
                                            $fileModel->file = UploadedFile::getInstance($fileModel, 'file');
                                            $file_name = rand() . $fileModel->file->baseName . '.' . $fileModel->file->extension;
                                            $fileModel->file->saveAs('uploads/' . $file_name);
                                            $fileModel->file = $file_name;
                                            $fileModel->articles_id = $articleModel->id;
                                            if (!$fileModel->save()) {
                                                $flag = false;
                                                $transation->rollBack();
                                            } else {
                                                $flag = $fileModel->save();
                                            }
                                        }

                                        $model->cm_code = Yii::$app->params['cmCode'] . $model->id;
                                        $model->save(true, ['cm_code']);
                                        $CmDataReportModel->match_date = Yii::$app->formatter->asDate($CmDataReportModel->match_date, "Y-m-d");
                                        $CmDataReportModel->name = $mediaModel->name;
                                        $CmDataReportModel->sample_ID = $model->sample_ID;
                                        if (!$CmDataReportModel->save()) {
                                            $flag = false;
                                            $transation->rollBack();
                                        } else {
                                            $flag = $CmDataReportModel->save();
                                        }
                                    }
                                }

                            }
                        }
                    }
                }

            } catch (Exception $ex) {
                $transation->rollBack();
                Yii::$app->session->setFlash("error", "Data Saving Failed");

            }


            return $this->render('_form', [
                'model' => $model,
                'CmDataReportModel' => $CmDataReportModel,
                'articleModel' => $articleModel,

            ]);
        }
    }

    /**
     * Deletes an existing CmData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = CmDataReport::findOne($id)->delete();
        Yii::$app->session->setFlash("success", "Row Deleted Successfully");

        return $this->redirect(['index']);
    }

    public function actionDeleteAll()
    {
        $ids = Yii::$app->request->post('ids');
        if (!empty($ids)) {
            $filter_ids = array_filter($ids, fn($value) => !is_null($value) && $value !== '');

             CmDataReport::deleteAll(['id' => $filter_ids]);
            Yii::$app->session->setFlash("success", "Rows Deleted Successfully");
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash("error", "Rows Deletion Failed");
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the CmData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmData::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetBrandList($term = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($term)) {
            $query = new \yii\db\Query;
            $query->select(['brands.id AS id', 'name AS text'])
                ->from('brands')
                ->where(['like', 'name', $term])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        return $out;
    }

    public function actionGetTagList($term = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($term)) {
            $query = new \yii\db\Query;
            $query->select(['tag.name AS id', 'name AS text'])
                ->from('tag')
                ->where(['like', 'name', $term])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        return $out;
    }

    public function actionGetAdCodeList($term = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($term)) {
            $query = new \yii\db\Query;
            $query->select(['ad_codes.ad_code AS id', 'ad_code AS text'])
                ->from('ad_codes')
                ->where(['like', 'ad_code', $term])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        return $out;
    }

    public function actionGetCategoryList($term = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($term)) {
            $query = new \yii\db\Query;
            $query->select(['category.category_id AS id', 'name AS text'])
                ->from('category')
                ->where(['like', 'name', $term])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $category = Category::find($id);
            $out['results'] = ['id' => $category->name, 'text' => $category->name];
        }
        return $out;
    }

    public function actionGetMediaList($term = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($term)) {
            $query = new \yii\db\Query;
            $query->select(['media.id AS id', 'name AS text'])
                ->from('media')
                ->where(['like', 'name', $term])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $media = Media::find($id);
            $out['results'] = ['id' => $media->name, 'text' => $media->name];
        }
        return $out;
    }

    public function actionGetSubCategoryList($term, $category, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($term) && !is_null($category)) {
            $query = new \yii\db\Query;

            $query->select(['sub_category.id AS id', 'name AS text'])
                ->from('sub_category')
                ->where(['like', 'name', $term])
                ->andWhere(['category_category_id' => $category])
                ->limit(20);

            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);

        } elseif ($id > 0) {
            $subCat = SubCategory::findOne($id);
            $out['results'] = ['id' => $subCat->name, 'text' => $subCat->name];
        }
        return $out;
    }

    public function actionGetArticleList($term = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($term)) {
            $query = new \yii\db\Query;
            $query->select(['articles.id AS id', 'name AS title'])
                ->from('articles')
                ->where(['like', 'title', $term])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        return $out;
    }

    public function actionGetLanguageList($term = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($term)) {
            $query = new \yii\db\Query;
            $query->select(['languages.id AS id', 'name AS text'])
                ->from('languages')
                ->where(['like', 'name', $term])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        return $out;
    }

    public function actionGetCountryList($term = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($term)) {
            $query = new \yii\db\Query;
            $query->select(['apps_countries.id AS id', 'country_name AS text'])
                ->from('apps_countries')
                ->where(['like', 'country_name', $term])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        return $out;
    }
}

