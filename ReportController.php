<?php

namespace backend\controllers;

use common\models\AuthItem;
use common\models\ConsentCookies;
use common\models\DetiAnket;
use common\models\Director;
use common\models\FederalDistrict;
use common\models\Food;
use common\models\FoodOrganizer;
use common\models\LoadOrganizationCommon;
use common\models\Report;
use common\models\SignupForm2;
use common\models\Table1;
use common\models\UserAutorizationStatistic;
use common\models\Municipality;
use common\models\UserDownloadStatistics;
use common\models\UserDownloadStatisticsSearch;
use common\models\UserForm;
use Mpdf\Mpdf;
use Yii;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\ChangeForm;
use common\models\SignupForm;
use common\models\User;
use common\models\Organization;
use common\models\Region;
use yii\rbac\DbManager;

class ReportController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'analysis-region',
                            'analysis-region-new',
                            'analysis-region-all',
                            'analysis-region-all-new',
                            'offers-report',
                        ],
                        'allow' => true,
                        'roles' => [
                            'admin',
                        ],
                    ],
                ],
            ],

        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    use RegionReport;

    public function actionAnalysisRegionAll()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '7092M');
        ini_set("pcre.backtrack_limit", "5000000");

        $modelReport = new Report();
        $modelDirector = new Director();
        $modelFood = new Food();
        $modelDetiAnket = new DetiAnket();
        //$district_items = $this->getArrayDistrictItems(false); //без всех округоф федаральный!!!
        $district_items = ['v' => 'Все']; //пролучаем список областей!

        $district_items += $this->getArrayDistrictItems(false); //пролучаем список областей!

        $region_items = $this->getArrayRegionItems(Yii::$app->user->identity->federal_district_id,
            true); //пролучаем список областей!s
        $municipality_items = $this->getArrayMunicipalityItems(Yii::$app->user->identity->region_id,
            true); //пролучаем список областей!

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['Report'];
            $modelReport->load(Yii::$app->request->post());
            $year = 2024;
            $region_items = $this->getArrayRegionItems($post['federal_district_idReport'], true); //пролучаем список областей!
            $municipality_items = $this->getArrayMunicipalityItems($post['region_idReport'], true); //пролучаем список областей!

            $result = [];

            //'(SELECT COUNT(*) FROM `organization`
            // WHERE federal_district_id = ' . Yii::$app->user->identity->federal_district_id . '
            // and region_id = ' . Yii::$app->user->identity->region_id . '
            // and organization_type_id = 5
            // and id not in (1, 3, 4, 5, 6, 7, 10, 11)
            // and year = 2024
            // and registration_status = 1) AS `organization_2024`',

            //$school = (new \yii\db\Query())
            //    ->from('director')
            //    ->where($whereDirector)
            //    ->count();
            $str = 'Российская Федерация (все участники анкетирования)';

            if ($post['federal_district_idReport'] !== 'v') {
                $str = $district_items[$post['federal_district_idReport']];
            }

            $whereDirector = [];
            ($post['federal_district_idReport'] && $post['federal_district_idReport'] !== 'v') ? $whereDirector += ['organization.federal_district_id' => $post['federal_district_idReport']] : $whereDirector += [];
            ($post['region_idReport'] && $post['region_idReport'] !== 'v') ? $whereDirector += ['organization.region_id' => $post['region_idReport']] : $whereDirector += [];
            ($post['municipality_idReport'] && $post['municipality_idReport'] !== 'v') ? $whereDirector += ['organization.municipality_id' => $post['municipality_idReport']] : $whereDirector += [];
            $whereDirector += [
                'director.year' => $year,
            ];


            $rowsDirector = (new \yii\db\Query())
                ->from('director')
                ->join('left JOIN', 'director_table_4', 'director_table_4.id = director.table_4')
                ->join('left JOIN', 'director_table_5', 'director_table_5.id = director.table_5')
                ->join('left JOIN', 'director_table_6', 'director_table_6.id = director.table_6')
                ->join('left JOIN', 'director_table_7', 'director_table_7.id = director.table_7')
                ->join('left JOIN', 'director_table_11', 'director_table_11.id = director.table_11')
                ->join('left JOIN', 'director_table_18', 'director_table_18.id = director.table_18')
                ->join('left JOIN', 'director_table_19', 'director_table_19.id = director.table_19')
                ->join('left JOIN', 'director_table_20', 'director_table_20.id = director.table_20')
                ->join('left JOIN', 'director_table_21', 'director_table_21.id = director.table_21')
                ->join('left JOIN', 'director_table_23', 'director_table_23.id = director.table_23')
                ->join('left JOIN', 'director_table_25', 'director_table_25.id = director.table_25')
                ->join('left JOIN', 'director_table_26', 'director_table_26.id = director.table_26')
                ->join('left JOIN', 'director_table_27', 'director_table_27.id = director.table_27')
                ->join('left JOIN', 'director_table_28', 'director_table_28.id = director.table_28')
                ->join('left JOIN', 'director_table_29', 'director_table_29.id = director.table_29')
                ->join('left JOIN', 'director_table_30', 'director_table_30.id = director.table_30')
                ->join('left JOIN', 'director_table_31', 'director_table_31.id = director.table_31')
                ->join('left JOIN', 'director_table_32', 'director_table_32.id = director.table_32')
                ->join('left JOIN', 'director_table_33', 'director_table_33.id = director.table_33')
                ->join('inner JOIN', 'organization', 'organization.id = director.organization_id')
                ->where($whereDirector)
                ->all();

            foreach ($rowsDirector as $row) {
                $analysis = Director::for_printing_analysisAff($row, $modelDirector);

                $result['director']['count'] += 1;
                $result['director']['countTerrain'][$row['terrain']] += 1;
                $result['director']['countSize'][$row['size']] += 1;
                //$result['director']['organization'][$row['organization_id']]['title'] = $row['title'];
                //$result['director']['organization'][$row['organization_id']]['number'] = $row['number'];
                //$result['director']['organizationAnalysis'][$row['organization_id']] = $analysis;
                $result['director']['organizationAnalysisBall'][$row['region_id']] = $analysis['ball'];

                foreach ($analysis['ball'] as $key => $oneAnalis) {
                    $result['director']['comparisonIndicators'][$key][$row['region_id']] = $oneAnalis;
                }
                //$result['director']['organizationAnalysisBall111'][$row['organization_id']] = $analysis['ball']['ballVse'];


                $result['director']['calculatedIndicators']['field4_24'] += $row['field4_24'];

                $result['director']['calculatedIndicators']['field4_21'] += $row['field4_21'];
                $result['director']['calculatedIndicators']['field4_22'] += $row['field4_22'];
                $result['director']['calculatedIndicators']['field4_23'] += $row['field4_23'];

                $result['director']['calculatedIndicators']['field4_4'] += $row['field4_4'];

                $result['director']['calculatedIndicators']['field4_1'] += $row['field4_1'];
                $result['director']['calculatedIndicators']['field4_2'] += $row['field4_2'];
                $result['director']['calculatedIndicators']['field4_3'] += $row['field4_3'];

                $result['director']['calculatedIndicators']['field7_24'] += $row['field7_24'];

                $result['director']['calculatedIndicators']['field7_21'] += $row['field7_21'];
                $result['director']['calculatedIndicators']['field7_22'] += $row['field7_22'];
                $result['director']['calculatedIndicators']['field7_23'] += $row['field7_23'];

                $result['director']['calculatedIndicators']['field5_4'] += $row['field5_4'];
                $result['director']['calculatedIndicators']['field5_8'] += $row['field5_8'];
                $result['director']['calculatedIndicators']['field5_1'] += $row['field5_1'];
                $result['director']['calculatedIndicators']['field5_2'] += $row['field5_2'];
                $result['director']['calculatedIndicators']['field5_3'] += $row['field5_3'];
                $result['director']['calculatedIndicators']['field5_5'] += $row['field5_5'];
                $result['director']['calculatedIndicators']['field5_6'] += $row['field5_6'];
                $result['director']['calculatedIndicators']['field5_7'] += $row['field5_7'];
                $result['director']['calculatedIndicators']['field7_16'] += $row['field7_16'];
                $result['director']['calculatedIndicators']['field7_13'] += $row['field7_13'];
                $result['director']['calculatedIndicators']['field7_14'] += $row['field7_14'];
                $result['director']['calculatedIndicators']['field7_15'] += $row['field7_15'];
                $result['director']['calculatedIndicators']['field7_16_3'] += $row['field7_16_3'];


                $result['director']['calculatedIndicators']['field11_1'] += $row['field11_1'];
                $result['director']['calculatedIndicators']['field11_1_1'] += $row['field11_1_1'];
                $result['director']['calculatedIndicators']['field11_1_3'] += $row['field11_1_3'];

                $result['director']['calculatedIndicators']['field11_1_r'] += $row['field11_1_r'];
                $result['director']['calculatedIndicators']['field11_1_1_r'] += $row['field11_1_1_r'];
                $result['director']['calculatedIndicators']['field11_1_3_r'] += $row['field11_1_3_r'];

                $result['director']['calculatedIndicators']['field11_2'] += $row['field11_2'];
                $result['director']['calculatedIndicators']['field11_2_1'] += $row['field11_2_1'];
                $result['director']['calculatedIndicators']['field11_2_3'] += $row['field11_2_3'];

                $result['director']['calculatedIndicators']['field11_2_r'] += $row['field11_2_r'];
                $result['director']['calculatedIndicators']['field11_2_1_r'] += $row['field11_2_1_r'];
                $result['director']['calculatedIndicators']['field11_2_3_r'] += $row['field11_2_3_r'];

                $result['director']['calculatedIndicators']['field11_3'] += $row['field11_3'];
                $result['director']['calculatedIndicators']['field11_3_1'] += $row['field11_3_1'];
                $result['director']['calculatedIndicators']['field11_3_3'] += $row['field11_3_3'];
                $result['director']['calculatedIndicators']['field11_3_r'] += $row['field11_3_r'];
                $result['director']['calculatedIndicators']['field11_3_1_r'] += $row['field11_3_1_r'];
                $result['director']['calculatedIndicators']['field11_3_3_r'] += $row['field11_3_3_r'];

                $result['director']['calculatedIndicators']['field11_7'] += $row['field11_7'];
                $result['director']['calculatedIndicators']['field11_7_1'] += $row['field11_7_1'];
                $result['director']['calculatedIndicators']['field11_7_3'] += $row['field11_7_3'];

                unset($analysis);
            }

            unset($rowsDirector);
            unset($whereDirector);
            unset($row);
            //  print_r('<pre>');
            //  //print_r($analysis);
            //  print_r('<br><br><br>');
            //  print_r( $result['director']['comparisonIndicators']);
            //  exit();

            $whereFood = [];
            ($post['federal_district_idReport'] && $post['federal_district_idReport'] !== 'v') ? $whereFood += ['organization.federal_district_id' => $post['federal_district_idReport']] : $whereFood += [];
            ($post['region_idReport'] && $post['region_idReport'] !== 'v') ? $whereFood += ['organization.region_id' => $post['region_idReport']] : $whereFood += [];
            ($post['municipality_idReport'] && $post['municipality_idReport'] !== 'v') ? $whereFood += ['organization.municipality_id' => $post['municipality_idReport']] : $whereFood += [];
            $whereFood += [
                'food.year' => $year,
            ];
            $rowsFood = (new \yii\db\Query())
                ->from('food')
                ->join('left JOIN', 'food_table_6', 'food_table_6.id = food.table_6')
                ->join('left JOIN', 'food_table_7', 'food_table_7.id = food.table_7')
                ->join('left JOIN', 'food_table_8', 'food_table_8.id = food.table_8')
                ->join('left JOIN', 'food_table_9', 'food_table_9.id = food.table_9')
                ->join('left JOIN', 'food_table_10', 'food_table_10.id = food.table_10')
                ->join('left JOIN', 'food_table_11', 'food_table_11.id = food.table_11')
                ->join('left JOIN', 'food_table_12', 'food_table_12.id = food.table_12')
                ->join('left JOIN', 'food_table_13', 'food_table_13.id = food.table_13')
                ->join('inner JOIN', 'organization', 'organization.id = food.organization_id')
                ->join('inner JOIN', 'user', 'user.id = food.user_id')
                ->where($whereFood)
                ->all();
            foreach ($rowsFood as $row) {
                $analysis = Food::for_printing_analysisAff($row, $modelFood);
                $foodOrganizerAll =
                    //print_r('<pre>');
                    //print_r($row);
                    //print_r('<br><br><br>');
                    //print_r($foodOrganizerAll);
                    //exit();
                $result['food']['count'] += 1;
                if ($row['inn'] !== '') {
                    $result['food']['inn'][] = $row['inn'];
                    $result['food']['innSTR'] .= $row['inn'] . '; ';
                }
                $result['food']['organization'][$row['organization_id']]['title'] = $row['title'];
                $result['food']['organization'][$row['organization_id']]['number'] = $row['inn'];
                $result['food']['organization'][$row['organization_id']]['number2'] = $row['number'];
                $result['food']['organization'][$row['organization_id']]['inn'] = $row['inn'];
                $result['food']['organization'][$row['organization_id']]['FoodOrganizer'] = FoodOrganizer::find()->where(['user_id' => $row['id'], 'year' => $year])->count();
                $result['food']['FoodOrganizer'][] = FoodOrganizer::find()->where(['user_id' => $row['id'], 'year' => $year])->count();


                $result['food']['organizationAnalysisBall'][$row['region_id']] = $analysis['ball'];
                $result['food']['organizationAnalysisBallSort'][$row['region_id']] = $analysis['ball']['ballVse'];

                foreach ($analysis['ball'] as $key => $oneAnalis) {
                    $result['food']['comparisonIndicators'][$key][$row['region_id']] = $oneAnalis;
                }
                //$result['food']['organizationAnalysisBall111'][$row['organization_id']] = $analysis['ball']['ballVse'];
                // $result['food']['calculatedIndicators2']['field5'] += $analysis['analysis']['5_8_1_1'];
                // $result['food']['calculatedIndicators2']['field5'] += $analysis['analysis']['5_8_1_2'];
                // $result['food']['calculatedIndicators2']['field5'] += $analysis['analysis']['5_8_1_3'];
                // $result['food']['calculatedIndicators2']['field5'] += $analysis['analysis']['5_8_1_4'];
//
                // $result['food']['calculatedIndicators2']['field5_8'] += $analysis['analysis']['5_8_2'];
                // $result['food']['calculatedIndicators2']['field5_8'] += $analysis['analysis']['5_8_3'];
                // $result['food']['calculatedIndicators2']['field5_8'] += $analysis['analysis']['5_8_4'];
                // $result['food']['calculatedIndicators2']['field5_8'] += $analysis['analysis']['5_8_5'];
//
                // $result['food']['calculatedIndicators2']['5_8_6'] += $analysis['analysis']['5_8_6'];
                // $result['food']['calculatedIndicators2']['5_8_7'] += $analysis['analysis']['5_8_7'];

                //$result['food']['calculatedIndicators']['3_6_1'] += $row['3_6_1'];
                //$result['food']['calculatedIndicators']['3_6_1'] += $row['3_6_1'];
                unset($analysis);
            }

            unset($rowsFood);
            unset($whereFood);
            unset($row);

            $whereDeti = [];
            ($post['federal_district_idReport'] && $post['federal_district_idReport'] !== 'v') ? $whereDeti += ['organization.federal_district_id' => $post['federal_district_idReport']] : $whereDeti += [];
            ($post['region_idReport'] && $post['region_idReport'] !== 'v') ? $whereDeti += ['organization.region_id' => $post['region_idReport']] : $whereDeti += [];
            ($post['municipality_idReport'] && $post['municipality_idReport'] !== 'v') ? $whereDeti += ['organization.municipality_id' => $post['municipality_idReport']] : $whereDeti += [];
            $whereDeti += [
                'deti_anket.year' => $year,
            ];
            $rowsDeti = (new \yii\db\Query())
                ->from('deti_anket')
                ->join('left JOIN', 'deti_anket_table_18_27', 'deti_anket_table_18_27.id = deti_anket.table_18_27')
                ->join('left JOIN', 'deti_anket_table_28_34', 'deti_anket_table_28_34.id = deti_anket.table_28_34')
                ->join('left JOIN', 'deti_anket_table_35_44', 'deti_anket_table_35_44.id = deti_anket.table_35_44')
                ->join('left JOIN', 'deti_anket_table_45_48', 'deti_anket_table_45_48.id = deti_anket.table_45_48')
                ->join('inner JOIN', 'organization', 'organization.id = deti_anket.organization_id')
                ->where($whereDeti)
                ->all();
            $numAnket = 1;
            foreach ($rowsDeti as $row) {
                $analysis = DetiAnket::for_printing_analysisAff($row, $modelDetiAnket);


                if ($analysis['name']['imt_r'] == 'Дефицит массы тела') {
                    $weight_arr = 'dif';
                } elseif ($analysis['name']['imt_r'] == 'Недостаточный вес') {
                    $weight_arr = 'nedoststok';
                } elseif ($analysis['name']['imt_r'] == 'Нормальный вес') {
                    $weight_arr = 'norma';
                } elseif ($analysis['name']['imt_r'] == 'Избыточный вес') {
                    $weight_arr = 'izbitok';
                } elseif ($analysis['name']['imt_r'] == 'Ожирение') {
                    $weight_arr = 'ozirenie';
                } else {
                    $weight_arr = 'unaccounted';
                }
                if ($analysis['name']['imt_r'] != 'unaccounted') {
                    $result['deti']['calculatingQuantity']['countV']['imt'] += 1;
                    //$terrain = $analysis['name']['terrain']; //	0-сельская, 1-городская
                    $result['deti']['calculatingQuantity']['countV']['count'] += 1;
                    $result['deti']['calculatingQuantity']['countV']['terrain' . $analysis['name']['terrain']] += 1;
                    $result['deti']['calculatingQuantity']['countV'][$analysis['name']['field1_1']]['terrain' . $analysis['name']['terrain']] += 1;
                    $result['deti']['calculatingQuantity']['countV'][$analysis['name']['field1_1']]['vse'] += 1;
                    //1-малчик 2-девочка
                    $result['deti']['calculatingQuantity']['count' . $analysis['name']['sexStr']]['count'] += 1;
                    $result['deti']['calculatingQuantity']['count' . $analysis['name']['sexStr']]['vse'] += 1;
                    $result['deti']['calculatingQuantity']['count' . $analysis['name']['sexStr']]['terrain' . $analysis['name']['terrain']] += 1;

                }

                $result['deti']['organization'][$row['region_id']]['count'] += 1;
                $result['deti']['organization'][$row['region_id']]['field49_2_v2'] += ($row['field49_2_v2'] == 1) ? 1 : 0;
                $result['deti']['organization'][$row['region_id']]['field49_3_v2'] += ($row['field49_3_v2'] == 1) ? 1 : 0;
                $result['deti']['organization'][$row['region_id']]['field49_4_v2'] += ($row['field49_4_v2'] == 1) ? 1 : 0;
                $result['deti']['organization'][$row['region_id']]['field49_5_v2'] += ($row['field49_5_v2'] == 1) ? 1 : 0;
                $result['deti']['organization'][$row['region_id']]['field49_6_v2'] += ($row['field49_6_v2'] == 1) ? 1 : 0;
                $result['deti']['organization'][$row['region_id']]['field49_7_v2'] += ($row['field49_7_v2'] == 1) ? 1 : 0;
                $result['deti']['organization'][$row['region_id']]['field49_8_v2'] += ($row['field49_8_v2'] == 1) ? 1 : 0;
                $result['deti']['organization'][$row['region_id']]['field49_9_v2'] += ($row['field49_9_v2'] == 1) ? 1 : 0;
                $result['deti']['organization'][$row['region_id']]['field49_10_v2'] += ($row['field49_10_v2'] == 1) ? 1 : 0;

                if (
                    $analysis['name']['field1_1'] == 2 ||
                    $analysis['name']['field1_1'] == 5 ||
                    $analysis['name']['field1_1'] == 10
                ) {
                    $result['deti']['calculatingQuantity']['count' . $analysis['name']['sexStr']][$analysis['name']['field1_1']]['terrain' . $analysis['name']['terrain']] += 1;
                    $result['deti']['calculatingQuantity']['count' . $analysis['name']['sexStr']][$analysis['name']['field1_1']]['vse'] += 1;

                    $result['deti']['calculatingQuantity']['class'][$analysis['name']['field1_1']][$weight_arr]['count' . $analysis['name']['sexStr']]['count'] += 1;
                    $result['deti']['calculatingQuantity']['class'][$analysis['name']['field1_1']][$weight_arr]['count' . $analysis['name']['sexStr']]['terrain' . $analysis['name']['terrain']] += 1;
                    $result['deti']['calculatingQuantity']['class'][$analysis['name']['field1_1']][$weight_arr]['countV']['count'] += 1;
                    $result['deti']['calculatingQuantity']['class'][$analysis['name']['field1_1']][$weight_arr]['countV']['terrain' . $analysis['name']['terrain']] += 1;

                }

                if (
                    $analysis['name']['field1_1'] == 2 ||
                    $analysis['name']['field1_1'] == 5 ||
                    $analysis['name']['field1_1'] == 10
                ) {

                    $result['deti']['organizationClss'][$analysis['name']['field1_1']][$row['region_id']]['count'] += 1;
                    $result['deti']['organizationClss'][$analysis['name']['field1_1']][$row['region_id']]['field49_2_v2'] += ($row['field49_2_v2'] == 1) ? 1 : 0;
                    $result['deti']['organizationClss'][$analysis['name']['field1_1']][$row['region_id']]['field49_3_v2'] += ($row['field49_3_v2'] == 1) ? 1 : 0;
                    $result['deti']['organizationClss'][$analysis['name']['field1_1']][$row['region_id']]['field49_4_v2'] += ($row['field49_4_v2'] == 1) ? 1 : 0;
                    $result['deti']['organizationClss'][$analysis['name']['field1_1']][$row['region_id']]['field49_5_v2'] += ($row['field49_5_v2'] == 1) ? 1 : 0;
                    $result['deti']['organizationClss'][$analysis['name']['field1_1']][$row['region_id']]['field49_6_v2'] += ($row['field49_6_v2'] == 1) ? 1 : 0;
                    $result['deti']['organizationClss'][$analysis['name']['field1_1']][$row['region_id']]['field49_7_v2'] += ($row['field49_7_v2'] == 1) ? 1 : 0;
                    $result['deti']['organizationClss'][$analysis['name']['field1_1']][$row['region_id']]['field49_8_v2'] += ($row['field49_8_v2'] == 1) ? 1 : 0;
                    $result['deti']['organizationClss'][$analysis['name']['field1_1']][$row['region_id']]['field49_9_v2'] += ($row['field49_9_v2'] == 1) ? 1 : 0;
                    $result['deti']['organizationClss'][$analysis['name']['field1_1']][$row['region_id']]['field49_10_v2'] += ($row['field49_10_v2'] == 1) ? 1 : 0;
                }


                $result['deti']['calculatingQuantityORG'][$row['region_id']]['deti']['count' . $analysis['name']['sexStr']]['vse'] += 1;
                $result['deti']['calculatingQuantityORG'][$row['region_id']]['deti']['count' . $analysis['name']['sexStr']][$analysis['name']['field1_1']]['vse'] += 1;
                if (
                    $weight_arr == 'izbitok' ||
                    $weight_arr == 'ozirenie'
                ) {
                    $result['deti']['calculatingQuantityORG'][$row['region_id']]['deti']['count' . $analysis['name']['sexStr']][$analysis['name']['field1_1']][$weight_arr] += 1;
                    $result['deti']['calculatingQuantityORG'][$row['region_id']]['deti']['count' . $analysis['name']['sexStr']][$weight_arr] += 1;
                    //$result['deti']['calculatingQuantityORG'][$row['region_id']]['deti']['class'][$analysis['name']['field1_1']][$weight_arr]['count'.$analysis['name']['sexStr']] += 1;
                }


                $result['deti']['calculatingQuantity']['imt'][$weight_arr]['count' . $analysis['name']['sexStr']]['count'] += 1;
                $result['deti']['calculatingQuantity']['imt'][$weight_arr]['count' . $analysis['name']['sexStr']]['terrain' . $analysis['name']['terrain']] += 1;

                $result['deti']['calculatingQuantity']['imt'][$weight_arr]['countV']['count'] += 1;
                $result['deti']['calculatingQuantity']['imt'][$weight_arr]['countV']['terrain' . $analysis['name']['terrain']] += 1;

                if ($analysis['name']['imtStrWomen'] == 'Дефицит массы тела') {
                    $imtStrWomen = 'dif';
                } elseif ($analysis['name']['imtStrWomen'] == 'Нормальная масса тела') {
                    $imtStrWomen = 'norma';
                } elseif ($analysis['name']['imtStrWomen'] == 'Избыточная масса тела') {
                    $imtStrWomen = 'izbitok';
                } elseif ($analysis['name']['imtStrWomen'] == 'Ожирение') {
                    $imtStrWomen = 'ozirenie';
                } else {
                    $imtStrWomen = 'unaccounted';
                }
                if ($analysis['name']['imtStrMen'] == 'Дефицит массы тела') {
                    $imtStrMen = 'dif';
                } elseif ($analysis['name']['imtStrMen'] == 'Нормальная масса тела') {
                    $imtStrMen = 'norma';
                } elseif ($analysis['name']['imtStrMen'] == 'Избыточная масса тела') {
                    $imtStrMen = 'izbitok';
                } elseif ($analysis['name']['imtStrMen'] == 'Ожирение') {
                    $imtStrMen = 'ozirenie';
                } else {
                    $imtStrMen = 'unaccounted';
                }


                if ($analysis['name']['imtStrWomen'] != '') {
                    //$result['deti']['calculatingQuantity']['parent']['countV'] += 1;
                    //$result['deti']['calculatingQuantity']['parent']['terrain'.$analysis['name']['terrain']] += 1;

                    $result['deti']['calculatingQuantity']['parent']['imtWomen'][$imtStrWomen]['countV'] += 1;
                    $result['deti']['calculatingQuantity']['parent']['imtWomen'][$imtStrWomen]['terrain' . $analysis['name']['terrain']] += 1;
                    $result['deti']['calculatingQuantity']['parent']['countWomen']['countV'] += 1;
                    $result['deti']['calculatingQuantity']['parent']['countWomen']['terrain' . $analysis['name']['terrain']] += 1;

                    $result['deti']['calculatingQuantityORG'][$row['region_id']]['parentWomen']['vse'] += 1;
                    if (
                        $imtStrWomen == 'izbitok' ||
                        $imtStrWomen == 'ozirenie'
                    ) {
                        $result['deti']['calculatingQuantityORG'][$row['region_id']]['parentWomen'][$imtStrWomen] += 1;
                    }
                }
                if ($analysis['name']['imtStrMen']) {

                    $result['deti']['calculatingQuantity']['parent']['imtMen'][$imtStrMen]['countV'] += 1;
                    $result['deti']['calculatingQuantity']['parent']['imtMen'][$imtStrMen]['terrain' . $analysis['name']['terrain']] += 1;
                    $result['deti']['calculatingQuantity']['parent']['countMen']['countV'] += 1;
                    $result['deti']['calculatingQuantity']['parent']['countMen']['terrain' . $analysis['name']['terrain']] += 1;


                    $result['deti']['calculatingQuantityORG'][$row['region_id']]['parentMen']['vse'] += 1;
                    if (
                        $imtStrMen == 'izbitok' ||
                        $imtStrMen == 'ozirenie'
                    ) {
                        $result['deti']['calculatingQuantityORG'][$row['region_id']]['parentMen'][$imtStrMen] += 1;
                    }

                }

                foreach ($analysis['ball'] as $key => $oneAnalis) {
                    $result['deti']['comparisonIndicators'][$key][$numAnket] = $oneAnalis;
                    $result['deti']['comparisonIndicatorsClass'][$row['region_id']][$key][$numAnket] = $oneAnalis;
                    if (
                        $analysis['name']['field1_1'] == 2 ||
                        $analysis['name']['field1_1'] == 5 ||
                        $analysis['name']['field1_1'] == 10
                    ) {
                        $result['deti']['comparisonIndicators']['class'][$analysis['name']['field1_1']][$key][$numAnket] = $oneAnalis;
                        $result['deti']['comparisonIndicatorsClass2'][$analysis['name']['field1_1']][$row['region_id']][$key][$numAnket] = $oneAnalis;

                    }
                }

                $result['deti']['analysisText']['field45_1'] += $analysis['analysis']['field45_1'];
                $result['deti']['analysisText']['field45_2'] += $analysis['analysis']['field45_2'];
                $result['deti']['analysisText']['field45_3'] += $analysis['analysis']['field45_3'];
                $result['deti']['analysisText']['field45_4'] += $analysis['analysis']['field45_4'];
                $result['deti']['analysisText']['field45_5'] += $analysis['analysis']['field45_5'];
                $result['deti']['analysisText']['field45_6'] += $analysis['analysis']['field45_6'];
                $result['deti']['analysisText']['field45_7'] += $analysis['analysis']['field45_7'];
                $result['deti']['analysisText']['field45_8'] += $analysis['analysis']['field45_8'];
                $result['deti']['analysisText']['field45_9'] += $analysis['analysis']['field45_9'];
                $result['deti']['analysisText']['field45_10'] += $analysis['analysis']['field45_10'];
                $result['deti']['analysisText']['field45_11'] += $analysis['analysis']['field45_11'];
                $result['deti']['analysisText']['field45_12'] += $analysis['analysis']['field45_12'];
                $result['deti']['analysisText']['field45_13'] += $analysis['analysis']['field45_13'];
                $result['deti']['analysisText']['field45_14'] += $analysis['analysis']['field45_14'];
                $result['deti']['analysisText']['field45_15'] += $analysis['analysis']['field45_15'];
                $result['deti']['analysisText']['field45_16'] += $analysis['analysis']['field45_16'];
                $result['deti']['analysisText']['field45_17'] += $analysis['analysis']['field45_17'];
                $result['deti']['analysisText']['field45_18'] += $analysis['analysis']['field45_18'];
                $result['deti']['analysisText']['field45_19'] += $analysis['analysis']['field45_19'];
                $result['deti']['analysisText']['field45_20'] += $analysis['analysis']['field45_20'];
                $result['deti']['analysisText']['field45_21'] += $analysis['analysis']['field45_21'];
                $result['deti']['analysisText']['field45_22'] += $analysis['analysis']['field45_22'];
                $result['deti']['analysisText']['field45_23'] += $analysis['analysis']['field45_23'];
                $result['deti']['analysisText']['field45_24'] += $analysis['analysis']['field45_24'];
                $result['deti']['analysisText']['field45_25'] += $analysis['analysis']['field45_25'];
                $result['deti']['analysisText']['field45_26'] += $analysis['analysis']['field45_26'];
                $result['deti']['analysisText']['field45_27'] += $analysis['analysis']['field45_27'];

                $result['deti']['analysisTextGroup']['count'] += 1;
                $result['deti']['analysisTextGroup'][$weight_arr] += 1;
                $result['deti']['analysisTextGroup'][$row['field1_1']] += 1;

                $result['deti']['analysisTextGroup']['field32'] += ($row['field32'] == 1 || $row['field32'] == 97 || $row['field32'] == 98) ? 1 : 0;//32
                $result['deti']['analysisTextGroup']['field33'] += ($row['field33'] == 1 || $row['field33'] == 97 || $row['field33'] == 98) ? 1 : 0;//33
                $result['deti']['analysisTextGroup']['field34_1'] += ($row['field34_1'] == 1 || $row['field34_1'] == 97 || $row['field34_1'] == 98) ? 1 : 0;//34.1
                $result['deti']['analysisTextGroup']['field34_2'] += ($row['field34_2'] == 1 || $row['field34_2'] == 97 || $row['field34_2'] == 98 || $row['field34_7'] == 1 || $row['field34_7'] == 97 || $row['field34_7'] == 98) ? 1 : 0;//34.2
                $result['deti']['analysisTextGroup']['field34_3'] += ($row['field34_3'] == 1 || $row['field34_3'] == 97 || $row['field34_3'] == 98) ? 1 : 0;//34.3
                $result['deti']['analysisTextGroup']['field34_4'] += ($row['field34_4'] == 1 || $row['field34_4'] == 97 || $row['field34_4'] == 98) ? 1 : 0;//34.4
                $result['deti']['analysisTextGroup']['field34_5'] += ($row['field34_5'] == 1 || $row['field34_5'] == 97 || $row['field34_5'] == 98) ? 1 : 0;//34.5

                $result['deti']['analysisTextGroup']['field35_2'] += ($row['field35_2'] == 1 || $row['field35_2'] == 97 || $row['field35_2'] == 98) ? 1 : 0;//35.2
                $result['deti']['analysisTextGroup']['field35_4'] += ($row['field35_4'] == 1 || $row['field35_4'] == 97 || $row['field35_4'] == 98) ? 1 : 0;//35.4
                $result['deti']['analysisTextGroup']['field35_5'] += ($row['field35_5'] == 1 || $row['field35_5'] == 97 || $row['field35_5'] == 98) ? 1 : 0;//35.5

                $result['deti']['analysisTextGroup']['field49_2_v2'] += ($row['field49_2_v2'] == 1) ? 1 : 0;//51.1
                $result['deti']['analysisTextGroup']['field49_3_v2'] += ($row['field49_3_v2'] == 1) ? 1 : 0;//51.2
                $result['deti']['analysisTextGroup']['field49_4_v2'] += ($row['field49_4_v2'] == 1) ? 1 : 0;//51.3
                $result['deti']['analysisTextGroup']['field49_5_v2'] += ($row['field49_5_v2'] == 1) ? 1 : 0;//51.4
                $result['deti']['analysisTextGroup']['field49_6_v2'] += ($row['field49_6_v2'] == 1) ? 1 : 0;//51.5
                $result['deti']['analysisTextGroup']['field49_7_v2'] += ($row['field49_7_v2'] == 1) ? 1 : 0;//51.6
                $result['deti']['analysisTextGroup']['field49_8_v2'] += ($row['field49_8_v2'] == 1) ? 1 : 0;//51.7
                $result['deti']['analysisTextGroup']['field49_9_v2'] += ($row['field49_9_v2'] == 1) ? 1 : 0;//51.8
                $result['deti']['analysisTextGroup']['field49_10_v2'] += ($row['field49_10_v2'] == 1) ? 1 : 0;//51.9


                ////переписать - сдлеать что бы у организации был массив с ключом и искать по ключу и выяснять к какой организации относится
                //$result['deti']['organization'][$numAnket] = $row['region_id'];
                ////$result['deti']['organization'][$numAnket]['number'] = $row['number'];

                //$result['deti']['organization2'][$row['region_id']]['title'] = $row['title'];
                //$result['deti']['organization2'][$row['region_id']]['number'] = $row['number'];

                //Переделать новую структуру !!!
                //теперь брать id c номер анкеты => id организации и получать организацию и данные по ней из общего списка - сократим список


                /* foreach ($analysis['ball'] as $key => $oneAnalis){
                     $result['deti']['comparisonIndicators'][$key][$row['region_id']] = $oneAnalis;
                 }

                 $result['deti']['calculatedIndicators']['field4_24'] += $row['field4_24'];*/

                //   print_r('<pre>');
                //   print_r($result['deti']['calculatingQuantity']);
                //   print_r('<br><br><br>');
                //   print_r($analysis);
                //   exit();
                $numAnket++;
                unset($analysis);
            }

            unset($rowsDeti);
            unset($whereDeti);
            unset($row);

            $resultAnlet3Vse = [];
            foreach ($result['deti']['comparisonIndicatorsClass'] as $keyOrgan => $oneOrdanizate) {
                foreach ($oneOrdanizate as $keyBall => $oneBall) {
                    $max = max($oneBall);
                    $min = min($oneBall);
                    $averageValue = Director::calculation_average_value($max, $min);
                    $resultAnlet3Vse[$keyOrgan][$keyBall] = $averageValue;
                }
            }
            $resultAnlet3Class = [];
            foreach ($result['deti']['comparisonIndicatorsClass2'] as $keyClass => $oneClass) {
                foreach ($oneClass as $keyOrgan => $oneOrgan) {
                    foreach ($oneOrgan as $keyBall => $oneBall) {
                        $max = max($oneBall);
                        $min = min($oneBall);
                        $averageValue = Director::calculation_average_value($max, $min);
                        $resultAnlet3Class[$keyClass][$keyOrgan][$keyBall] = $averageValue;
                    }
                }
            }

            unset($result['deti']['comparisonIndicatorsClass']);
            unset($result['deti']['comparisonIndicatorsClass2']);


            //$arr = $result['director']['comparisonIndicators']['ballVse'];
            // asort($arr);
            // print_r('<pre>');
            // //print_r(asort($result['director']['comparisonIndicators']['ballVse']));
            // //print_r('<pre>');
            // print_r($arr);
            // exit();


            //  //print_r('<br><br><br>max');
            //  //print_r(array_keys($result['deti']['comparisonIndicators2']['ball_1'], max($result['deti']['comparisonIndicators2']['ball_1'])));
            //  //print_r('<br><br><br>min');
            //  //print_r(array_keys($result['deti']['comparisonIndicators2']['ball_1'], min($result['deti']['comparisonIndicators2']['ball_1'])));
            //  //print_r('<br><br><br>');
            //  //print_r('<br><br><br>');
            //  //print_r('<br><br><br>');
            //  print_r($result);

            //  print_r('<br><br><br>');
            //  print_r($result['deti']['comparisonIndicators']['class']);
            //  print_r('<br><br><br>');
            //  print_r($result['deti']['comparisonIndicators']['ball_1']);
            //  print_r('<br><br><br>');
            //  //print_r($result['deti']['organizationAnalysisBall']);
            //  //print_r('<br><br><br>');
            //  //print_r($result['deti']['organization']);
            //  print_r('<pre>');
            //  print_r($result['deti']['organization']);
            //  print_r('<br><br><br>');
            //  print_r($result['deti']['organizationClss']);
            //  exit();


        }

        if ($result) {
            $this->layout = false;
            $html = $this->render(
                '_print-region-all',
                [
                    'result' => $result,
                    'str' => $str,
                    'resultAnlet3Class' => $resultAnlet3Class,
                    'resultAnlet3Vse' => $resultAnlet3Vse,
                ]
            );
            $mpdf = new Mpdf([
                'margin_top' => 10,
                'margin_left' => 20,
                'margin_right' => 10,
                'margin_bottom' => 20,
                //'mirrorMargins' => true//для двухсторонней печати !
                //Установлено значение 1, в документе будут отображаться значения левого и правого полей на нечетных и четных страницах, т. е. они станут внутренними и внешними полями.
            ]);
            $mpdf->defaultfooterline = 0;
            $mpdf->setFooter('{PAGENO}', false);

            $mpdf->WriteHTML($html);
            $mpdf->Output('Анализ по ' . $str . '.pdf', 'I'); //D - скачает файл!
            //$mpdf->Output(': ' . $shop->name . '.pdf', 'I'); //D - скачает файл!
        }


        return $this->render('analysis-region-all', [
            'modelReport' => $modelReport,
            'district_items' => $district_items,
            'region_items' => $region_items,
            'municipality_items' => $municipality_items,
            'result' => $result,
            'str' => $str,
            'resultAnlet3Class' => $resultAnlet3Class,
            'resultAnlet3Vse' => $resultAnlet3Vse,
        ]);
    }

}