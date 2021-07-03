<?php
namespace frontend\controllers;

use common\models\User;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;

/**
 * Class UserController
 */
/**
 * @OA\Info(
 *   version="1.0",
 *   title="Application API",
 *   description="Server - Mobile app API",
 *   @OA\Contact(
 *     name="John Smith",
 *     email="john@example.com",
 *   ),
 * ),
 * @OA\Server(
 *   url="https://example.com/api",
 *   description="main server",
 * )
 * @OA\Server(
 *   url="https://dev.example.com/api",
 *   description="dev server",
 * )
 */

class DefaultController extends Controller
{
    /**
     * @OA\Get(path="/",
     *   summary="Handshake",
     *   tags={"handshake"},
     *   @OA\Parameter(
     *     name="access-token",
     *     in="header",
     *     required=false,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Returns Hello object",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/Hello"),
     *     ),
     *   ),
     * )
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $dataProvider;
    }
}
?>