<?php

namespace backend\controllers;

use Yii;
use common\models\Noticia;
use backend\models\NoticiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * NoticiaController implements the CRUD actions for Noticia model.
 */
class NoticiaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'delete-imagem' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Noticia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoticiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Noticia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Noticia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Noticia();
        
        $model->nosi_codigo = 1;
        $model->noti_imagem = false;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            // Upload da imagem
            $model->noti_imagem_upload = UploadedFile::getInstance($model, 'noti_imagem_upload');

            if ($model->noti_imagem_upload instanceof UploadedFile) { 
                
                // Converte imagem para png utilizando a extensão Imagine https://github.com/yiisoft/yii2-imagine
                if(Image::thumbnail($model->noti_imagem_upload->tempName, 400, 300)
                                ->save(Yii::getAlias('@frontend/web/images/') . $model->noti_codigo . ".png")){
                    $model->noti_imagem = true;
                    $model->save();
                }
                
            }
            
            return $this->redirect(['view', 'id' => $model->noti_codigo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Noticia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            // Upload da imagem
            $model->noti_imagem_upload = UploadedFile::getInstance($model, 'noti_imagem_upload');

            if ($model->noti_imagem_upload instanceof UploadedFile) { 
                
                // Converte imagem para png utilizando a extensão Imagine https://github.com/yiisoft/yii2-imagine
                if(Image::thumbnail($model->noti_imagem_upload->tempName, 400, 300)
                                ->save(Yii::getAlias('@frontend/web/images/') . $model->noti_codigo . ".png")){
                    $model->noti_imagem = true;
                    $model->save();
                }
                
            }
            
            return $this->redirect(['view', 'id' => $model->noti_codigo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Noticia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionDeleteImagem($id)
    {
        if(unlink(Yii::getAlias('@frontend/web/images/').$id.'.png')){
            $model = $this->findModel($id);
            $model->noti_imagem = false;
            $model->save();
        }
        return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * Finds the Noticia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Noticia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Noticia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
