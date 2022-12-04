<?php

namespace app\controllers;

use Yii;
use DateTime;
use app\models\Node;
use app\models\Users;
use yii\web\Response;
use app\models\Enroll;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\EnrollProgress;
use yii\filters\AccessControl;
use app\models\forms\LoginForm;
use app\helpers\DashboardHelper;
use app\models\DataSensors;
use app\models\forms\ContactForm;
use app\models\forms\RegisterForm;

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

        $nodeId = Node::findOne(['node_id'=>1]);
        $nodes = ArrayHelper::map(Node::find()->all(), 'node_name', 'node_name');

        $start = Yii::$app->request->post('start') ? (new DateTime(Yii::$app->request->post('start')))->format('Y-m-d') : date('Y-m-d', strtotime((new DateTime())->format('Y-m-d') . ' - 1 month'));
        $end = Yii::$app->request->post('end') ? (new DateTime(Yii::$app->request->post('end')))->format('Y-m-d') : (new DateTime())->format('Y-m-d');
        $maintenance1 = DataSensors::findOne(['remark'=>$nodeId["node_name"]]);

        // var_dump($nodes);die;
        return $this->render('index', [
            'progress' => $progress,
            'nodeId' => $nodeId,
            'nodes' => $nodes,
            'start' => $start,
            'end' => $end,
            'maintenance1' => $maintenance1["modified_at"],
        ]);
    }

    public function actionDataPressure()
    {

        $request = Yii::$app->request;
        $start = $request->post('start') ? (new DateTime($request->post('start')))->format('Y-m-d') : date('Y-m-d', strtotime((new DateTime())->format('Y-m-d') . ' - 1 month'));
        $end = $request->post('end') ? (new DateTime($request->post('end')))->format('Y-m-d') : (new DateTime())->format('Y-m-d');
        $device = $request->post('device') ?  $request->post('device') : 'RO1';

        $pressurePerDay = null;
        $date = $s1 = $s2 = $s3 = $s4 = $s5 = $s6 = $s7 = $s8 = $s9 = [];

        $key = "pressurePerDay-$device-$start-$end";

        $pressurePerDay = DataSensors::find()
                                ->where(['remark'=>$device])
                                ->andFilterWhere(['between', 'modified_at', $start, $end])
                                ->orderBy(['modified_at'=> SORT_DESC])
                                ->limit(100)
                                ->all();

        if ($pressurePerDay && count($pressurePerDay) > 0) {
            foreach ($pressurePerDay as $a) {
                $date[] = $a['modified_at'];
                $s1[] = $a['s1'];
                $s2[] = $a['s2'];
                $s3[] = $a['s3'];
                $s4[] = $a['s4'];
                $s5[] = $a['s5'];
                $s6[] = $a['s6'];
                $s7[] = $a['s7'];
                $s8[] = $a['s8'];
                $s9[] = $a['s9'];
            }
        } else {
            $date[] = $end;
            $s1[] = 0;
            $s2[] = 0;
            $s3[] = 0;
            $s4[] = 0;
            $s5[] = 0;
            $s6[] = 0;
            $s7[] = 0;
            $s8[] = 0;
            $s9[] = 0;
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'date' => $date,
            's1' => $s1,
            's2' => $s2,
            's3' => $s3,
            's4' => $s4,
            's5' => $s5,
            's6' => $s6,
            's7' => $s7,
            's8' => $s8,
            's9' => $s9,
            'start' => $start,
            'end' => $end,
            'device' => $device,
        ];
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
