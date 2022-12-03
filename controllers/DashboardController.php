<?php

namespace app\controllers;

use app\models\Enroll;
use app\models\EnrollProgress;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use app\models\forms\ContactForm;
use app\models\forms\RegisterForm;
use app\models\Users;
use yii\web\HttpException;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class DashboardController extends Controller
{

    public $layout = 'dashboard';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $progress = [];
        $enrolls = Enroll::find()
            ->where(['enroll_userid' => Yii::$app->user->identity->user_id])
            ->Andwhere(['enroll_is_deleted' => 0])
            ->all();
        $student_enroll = Enroll::find()
            ->where(['enroll_is_deleted' => 0])
            ->Andwhere(['courses.course_trainer' => Yii::$app->user->identity->user_id])
            ->leftJoin('courses', 'courses.course_id = enroll.enroll_id')
            ->all();
        foreach ($enrolls as $key => $value) {
            $progress[] = EnrollProgress::findAll(['ep_enroll_id' => $value->enroll_id, 'ep_remark' => "quiz"]);
        }

        return $this->render('index', [
            'enrolls' => $enrolls,
            'student_enroll' => $student_enroll,
            'progress' => $progress,
        ]);
    }

    public function actionUpdateProfile()
    {
        $model = Users::findOne(Yii::$app->user->identity->user_id);

        if (!$model) {
            throw new HttpException(404, "User not found");
        }

        $model->scenario = Users::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post())) {
            $gambar = UploadedFile::getInstance($model, 'imageFile');

            if ($model->validate()) {
                $model->save();
                if (!empty($gambar)) {

                    if (!file_exists("uploads")) {
                        mkdir("uploads", 777, true);
                    }

                    $gambar->saveAs(Yii::getAlias('@webroot/uploads/') . $gambar->baseName . '.' . $gambar->extension);
                    $model->user_foto = 'uploads/' . $gambar->baseName . '.' . $gambar->extension;
                    $model->save(FALSE);
                }
            }

            $forms = Yii::$app->request->post('Users', null);
            if (isset($forms['user_pass']) && !empty($forms['user_pass'])) {
                $model->user_pass = Yii::$app->getSecurity()->generatePasswordHash($model->user_pass);
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update_profile', [
            'model' => $model,
        ]);
    }
}
