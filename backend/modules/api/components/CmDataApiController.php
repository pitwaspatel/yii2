<?php

namespace backend\modules\api\components;

use Yii;
use app\modules\api\models\CmDataApi;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * @OA\Tag(
 *   name="CmDataApi",
 *   description="Everything about your CmDataApi",
 *   @OA\ExternalDocumentation(
 *     description="更多相关",
 *     url="http://dakara.cn"
 *   )
 * )
 */
class CmDataApiController extends Controller
{
    public $modelClass = 'app\modules\api\models\CmDataApi';





    /**
     * @OA\Get(
     *     path="/cm-data-api",
     *     summary="查询 CmDataApi",
     *     tags={"CmDataApi"},
     *     description="",
     *     operationId="findCmDataApi",
     *     @OA\Parameter(
     *         name="ids",
     *         in="query",
     *         description="逗号隔开的 id",
     *         required=false,
     *         @OA\Schema(
     *           type="string",
     *           @OA\Items(type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="查询成功",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/CmDataApi")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="无效的id",
     *     ),
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CmDataApi::find()->with('creator')->with('updater'),
        ]);
        return $dataProvider;
    }

    /**
     * @OA\Get(
     *     path="/cm-data-api/{id}",
     *     summary="通过ID显示详情",
     *     description="",
     *     operationId="getCmDataApiById",
     *     tags={"CmDataApi"},
     *     @OA\Parameter(
     *         description="id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/CmDataApi")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="无效的ID"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="没有找到相应资源"
     *     ),
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * @OA\Post(
     *     path="/cm-data-api",
     *     tags={"CmDataApi"},
     *     operationId="addCmDataApi",
     *     summary="添加",
     *     description="",
     *   @OA\RequestBody(
     *       required=true,
     *       description="创建 CmDataApi 对象",
     *       @OA\JsonContent(ref="#/components/schemas/CmDataApi"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/CmDataApi")
     *       )
     *   ),
     *     @OA\Response(
     *         response=201,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/CmDataApi")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="无效的输入",
     *     ),
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionCreate()
    {
        $model = new CmDataApi();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
        return $model;
    }

    /**
     * @OA\Put(
     *     path="/cm-data-api/{id}",
     *     tags={"CmDataApi"},
     *     operationId="updateCmDataApiById",
     *     summary="更新指定ID数据",
     *     description="",
     *     @OA\Parameter(
     *         description="id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *   @OA\RequestBody(
     *       required=true,
     *       description="更新 CmDataApi 对象",
     *       @OA\JsonContent(ref="#/components/schemas/CmDataApi"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/CmDataApi")
     *       )
     *   ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/CmDataApi")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="无效的ID",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="没有找到相应资源",
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="数据验证异常",
     *     ),
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->getBodyParams(), '') && $model->save()) {
            Yii::$app->response->setStatusCode(200);
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        return $model;
    }

    /**
     * @OA\Delete(
     *     path="/cm-data-api/{id}",
     *     summary="删除CmDataApi",
     *     description="",
     *     operationId="deleteCmDataApi",
     *     tags={"CmDataApi"},
     *     @OA\Parameter(
     *         description="需要删除数据的ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="没有找到相应资源"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="无效的ID"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="没有找到相应资源"
     *     ),
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->softDelete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }
        Yii::$app->getResponse()->setStatusCode(204);
    }

    /**
     * Finds the CmDataApi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmDataApi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmDataApi::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested CmDataApi does not exist.');
    }
}
