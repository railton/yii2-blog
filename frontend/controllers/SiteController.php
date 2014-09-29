<?php
namespace frontend\controllers;

use Yii;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new \frontend\models\NoticiaSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionNoticia($id)
    {
        $model = \common\models\Noticia::findOne($id);
        
        $comentarioList = \common\models\Comentario::find()
                ->where(['noti_codigo'=>$id, 'cosi_codigo' => 2])
                ->orderBy('come_data_criacao DESC')->all();

        $comentario = new \common\models\Comentario();
        
        $comentario->cosi_codigo = 1;
        $comentario->noti_codigo = $id;
        $comentario->usua_codigo = Yii::$app->user->id;

        if ($comentario->load(Yii::$app->request->post()) && $comentario->save()) {
            return $this->redirect(['noticia', 'id' => $id]);
        } else {
            return $this->render('noticia', [
                'model' => $model,
                'comentario' => $comentario,
                'comentarioList' => $comentarioList,
            ]);
        }  
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
