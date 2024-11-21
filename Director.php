<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "director".
 *
 * @property int $id
 * @property int $user_id
 * @property int $organization_id
 * @property string $table_4
 * @property string $table_5
 * @property string $create_at
 */
class Director extends \yii\db\ActiveRecord
{
    public $editing_id_anket;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'director';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'user_id',
                    'organization_id',
                    'federal_district_id',
                    'region_id',
                    'municipality_id',
                    'year',
                    'table_4',
                    'table_5',
                    'table_6',
                    'table_7',
                    'table_11',
                    'table_18',
                    'table_19',
                    'table_20',
                    'table_21',
                    'table_23',
                    'table_25',
                    'table_26',
                    'table_27',
                    'table_28',
                    'table_29',
                    'table_30',
                    'table_31',
                    'table_32',
                    'table_33',
                    'school_menu',
                    'field30_1_1',
                    'field30_1_2',
                    'field30_1_3',
                    'field30_2_1',
                    'field30_2_2',
                    'field30_2_3',
                    'field30_3_1',
                    'field30_4_2',
                    'field30_5_3',

                    'field31_1_1',
                    'field31_1_2',
                    'field31_2_1',
                    'field31_2_2',
                    'field31_3_1',
                    'field31_3_2',
                    'field31_1_d',
                    'field31_2_d',
                    'field31_3_d',
                    'field31_4_d',
                    'field31_5_d',
                    'field31_6_d',
                    'field31_7_d',
                    'field31_8_d',
                    'field31_9_d',
                    'field31_10_d',
                    'field31_11_d',
                    'field31_12_d',
                    'field31_13_d',
                    'field31_14_d',
                    'field32',
                    'last_question',
                ], 'required'],
            [[
                'user_id',
                'organization_id',
                'field31_1_1',
                'field31_1_2',
                'field31_2_1',
                'field31_2_2',
                'field31_3_1',
                'field31_3_2',
                'field31_1',
                'field31_2',
                'field31_3',
                'field31_4',
                'field31_5',
                'field31_6',
                'field31_7',
                'field31_8',
                'field31_9',
                'field31_10',
                'field31_11',
                'field31_12',
                'field31_13',
                'field31_14',
                ], 'integer', 'min' => '0','message'=>'Вносимое значение должно быть числовым'
            ],  [[
                'field30_1_1',
                'field30_1_2',
                'field30_1_3',

                'field30_2_1',
                'field30_2_2',
                'field30_2_3',

                'field30_3_1',
                'field30_4_2',
                'field30_5_3',
                ], 'integer', 'min' => '0', 'max' => '100','message'=>'Вносимое значение должно быть числовым'
            ],
            [
                [
                    'field31_1_1',
                    'field31_1_2',
                    'field31_2_1',
                    'field31_2_2',
                    'field31_3_1',
                ], function ($attribute, $params) {
                $sum =
                    $this->field31_1_1 +
                    $this->field31_1_2 +
                    $this->field31_2_1 +
                    $this->field31_2_2 +
                    $this->field31_3_1;
                if ($sum > 1) {
                    $this->addError($attribute, 'Проверьте правильность внесения, в столбце может быть только один ответ: "ДА" ');
                }
            }
            ],
            [
                [
                    'field31_3_2',
                    'field31_1',
                    'field31_2',
                    'field31_3',
                    'field31_4',
                ], function ($attribute, $params) {
                $sum =
                    $this->field31_3_2 +
                    $this->field31_1 +
                    $this->field31_2 +
                    $this->field31_3 +
                    $this->field31_4;
                if ($sum > 1) {
                    $this->addError($attribute, 'Проверьте правильность внесения, в столбце может быть только один ответ: "ДА" ');
                }
            }
            ],
            [
                [
                    'field31_10',
                    'field31_11',
                    'field31_12',
                    'field31_13',
                    'field31_14',
                ], function ($attribute, $params) {
                $sum =
                    $this->field31_10 +
                    $this->field31_11 +
                    $this->field31_12 +
                    $this->field31_13 +
                    $this->field31_14;
                if ($sum > 1) {
                    $this->addError($attribute, 'Проверьте правильность внесения, в столбце может быть только один ответ: "ДА" ');
                }
            }
            ],

            [['interviewer_fio', 'create_at', 'update_at'], 'safe'],
            [['table_4', 'table_5'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код анкеты',
            'user_id' => 'User ID',
            'organization_id' => 'Organization ID',
            'table_4' => '',
            'table_5' => '',
            'table_6' => '',
            'table_7' => '',
            'table_8' => '',
            'table_9' => '',
            'table_10' => '',
            'table_11' => '',
            'table_12' => '',
            'table_13' => '',
            'table_14' => '',
            'table_15' => '',
            'table_16' => '',
            'table_17' => '',
            'table_18' => '',
            'table_19' => '',
            'table_20' => '',
            'table_21' => '',
            'table_22' => '',
            'table_23' => '',
            'table_24' => '',
            'table_25' => '',
            'table_26' => '',
            'table_27' => '',
            'table_28' => '',
            'table_29' => '',
            'table_30' => '',
            'table_31' => '',
            'table_32' => '',
            'table_33' => '',

            'field30_1_1' => '',
            'field30_1_2' => '',
            'field30_1_3' => '',
            'field30_2_1' => '',
            'field30_2_2' => '',
            'field30_2_3' => '',

            'field31_1_1' => '',
            'field31_1_2' => '',
            'field31_2_1' => '',
            'field31_2_2' => '',
            'field31_3_1' => '',
            'field31_3_2' => '',
            'field31_1' => '',
            'field31_2' => '',
            'field31_3' => '',
            'field31_4' => '',
            'field31_5' => '',
            'field31_6' => '',
            'field31_7' => '',
            'field31_8' => '',
            'field31_9' => '',
            'field31_10' => '',
            'field31_11' => '',
            'field31_12' => '',
            'field31_13' => '',
            'field31_14' => '',
            'field32' => '',
            'interviewer_fio' => 'ФИО, внесшего информацию в базу ',
            'school_menu' => '29. По какому основному меню работает школа ',
            'create_at' => 'Дата заполнения анкеты',
            'update_at' => 'Дата hредактирования анкеты',
            'last_question' => '32.	Пользуетесь ли Вы в своей работе обучающими (просветительскими) программами Роспотребнадзора по вопросам здорового питания, а также печатной продукцией (плакаты, брошюры, буклеты, памятки и др.) и видеороликами по вопросам здорового питания, разработанными в рамках реализации ФП «Укрепление общественного здоровья» (НП Демография)?',

        ];
    }

    public static function for_printing_analysisNew($arr)
    {
        $result = [];
        $result['name'] = [];
        $result['name']['create_at'] = $arr['create_at'];
        $result['name']['title'] = $arr['title'];
        $result['name']['federal_district_id'] = $arr['federal_district_id'];
        $result['name']['region_id'] = $arr['region_id'];
        $result['name']['municipality_id'] = $arr['municipality_id'];
        $result['name']['number'] = $arr['number'];
        $result['name']['terrain'] = $arr['terrain'];
        $result['name']['size'] = $arr['size'];
        $result['name']['school_capacity'] = $arr['school_capacity'];
        $result['name']['school_1_4_project'] = $arr['field3'];
        $result['name']['school_5_9_project'] = $arr['field3_1'];
        $result['name']['school_10_11_project'] = $arr['field3_2'];
        $result['name']['school_1_4_power'] = $arr['field4_21'];
        $result['name']['school_5_9_power'] = $arr['field4_22'];
        $result['name']['school_10_11_power'] = $arr['field4_23'];

        //ball - 1 = 10 баллов
        $result['ball']['ball_1']['4_1_1'] += ($arr['field4_1_1'] == 1) ? 1 : (($arr['field4_1_5'] == 1) ? 0.5 : 0);;
        $result['ball']['ball_1']['4_1_2'] += ($arr['field4_1_2'] == 1) ? 1 : (($arr['field4_1_6'] == 1) ? 0.5 : 0);;
        $result['ball']['ball_1']['4_1_3'] += ($arr['field4_1_3'] == 1) ? 1 : (($arr['field4_1_7'] == 1) ? 0.5 : 0);;
        $result['ball']['ball_1']['4_1_4'] += ($arr['field4_1_4'] == 1) ? 1 : (($arr['field4_1_8'] == 1) ? 0.5 : 0);;
        $result['ball']['ball_1']['4_2_2'] += ($arr['field4_2_2'] == 2) ? 0 : 1;
        $result['ball']['ball_1']['4_2_3'] += ($arr['field4_2_3'] == 2) ? 0 : 1;
        $result['ball']['ball_1']['4_4_2'] += ($arr['field4_4_1'] == 1) ? 1 : (($arr['field4_4_2'] == 1) ? 0.5 : 0);
        $result['ball']['ball_1']['4_4_5'] += ($arr['field4_4_4'] == 1) ? 1 : (($arr['field4_4_5'] == 1) ? 0.5 : 0);
        $result['ball']['ball_1']['4_4_8'] += ($arr['field4_4_7'] == 1) ? 1 : (($arr['field4_4_8'] == 1) ? 0.5 : 0);
        $result['ball']['ball_1']['4_5_1'] += ($arr['field4_5_1'] == 4) ? 0 : (($arr['field4_5_1'] == 3) ? 0.5 : 1);
        //ball - 2 = 5 баллов
        $result['ball']['ball_2']['5_1_1'] += ($arr['field5_1_1'] == 1 && $arr['field5_2_1'] == 1) ? 1 : (($arr['field5_1_1'] == 1 || $arr['field5_2_1'] == 1) ? 0.5 : 0);
        $result['ball']['ball_2']['5_1_2'] += ($arr['field5_1_2'] == 1 && $arr['field5_2_2'] == 1) ? 1 : (($arr['field5_1_2'] == 1 || $arr['field5_2_2'] == 1) ? 0.5 : 0);
        $result['ball']['ball_2']['5_1_3'] += ($arr['field5_1_3'] == 1 && $arr['field5_2_3'] == 1) ? 1 : (($arr['field5_1_3'] == 1 || $arr['field5_2_3'] == 1) ? 0.5 : 0);
        $vitamins = $arr['field21_3'] +$arr['field21_5'] +$arr['field21_7'] +$arr['field21_9'] +$arr['field21_11'];
        $mineral = $arr['field21_4'] +$arr['field21_6'] +$arr['field21_8'] +$arr['field21_10'] +$arr['field21_12'];
        $result['ball']['ball_2']['vitamins'] += ($vitamins >= 2) ? 1 : (($vitamins == 1) ? 0.5 : 0);
        $result['ball']['ball_2']['mineral'] += ($mineral >= 2) ? 1 : (($mineral == 1) ? 0.5 : 0);
        //ball - 3 = 6 баллов
        $result['ball']['ball_3']['7_1_1'] += ($arr['field7_3_1'] == 1) ? 0 : (($arr['field7_2_1'] == 1) ? 0.5 : (($arr['field7_1_1'] == 1) ? 1 : 0));
        $result['ball']['ball_3']['7_1_2'] += ($arr['field7_3_2'] == 1) ? 0 : (($arr['field7_2_2'] == 1) ? 0.5 : (($arr['field7_1_2'] == 1) ? 1 : 0));
        $result['ball']['ball_3']['7_1_3'] += ($arr['field7_3_3'] == 1) ? 0 : (($arr['field7_2_3'] == 1) ? 0.5 : (($arr['field7_1_3'] == 1) ? 1 : 0));
        $result['ball']['ball_3']['8_1_1'] += ($arr['field8_1'] == 1) ? 1 : (($arr['field8_4'] == 1) ? 0.5 : 0);
        $result['ball']['ball_3']['8_1_2'] += ($arr['field8_2'] == 1) ? 1 : (($arr['field8_5'] == 1) ? 0.5 : 0);
        $result['ball']['ball_3']['8_1_3'] += ($arr['field8_3'] == 1) ? 1 : (($arr['field8_6'] == 1) ? 0.5 : 0);


        //ball - 4 = 12 баллов
        //12. Охват горячим питанием (РАССЧЕТНЫЙ в %)
        $field12_1_1_4 = ($arr['field4_1'] != 0) ? ($arr['field7_21']/$arr['field4_1']) * 100 : 0;
        $field12_1_5_9 = ($arr['field4_2'] != 0) ? ($arr['field7_22']/$arr['field4_2']) * 100 : 0;
        $field12_1_10_11 = ($arr['field4_3'] != 0) ? ($arr['field7_23']/$arr['field4_3']) * 100 : 0;
        $field12_1_111 =
            ($arr['field4_1'] != 0 || $arr['field4_2'] != 0 ||$arr['field4_3'])
                ? (
                    ($arr['field7_21'] + $arr['field7_22'] + $arr['field7_23'])/
                    ($arr['field4_1'] + $arr['field4_2'] + $arr['field4_3'])
                ) * 100
                : 0;
        //$result['analysis']['field12_1_111'] = $field12_1_111;
        $field12_1_1_4_n = ($field12_1_1_4 >= 100) ? 100 : $field12_1_1_4;
        $field12_1_5_9_n = ($field12_1_5_9 >= 100) ? 100 : $field12_1_5_9;
        $field12_1_10_11_n = ($field12_1_10_11 >= 100) ? 100 : $field12_1_10_11;
        $field12_1_111_n = ($field12_1_111 >= 100) ? 100 : $field12_1_111;
        //$result['analysis']['field12_1_1_4'] = $field12_1_1_4_n;
        //$result['analysis']['field12_1_5_9'] = $field12_1_5_9_n;
        //$result['analysis']['field12_1_10_11'] = $field12_1_10_11_n;
        //12. Охват горячим питанием (ОЦЕНОЧНЫЙ в %)
        $result['ball']['ball_4']['12_1_1'] += ($field12_1_1_4_n >= 90) ? 2 : (($field12_1_1_4_n >= 80) ? 1 : 0);
        $result['ball']['ball_4']['12_1_2'] += ($field12_1_5_9_n >= 90) ? 2 : (($field12_1_5_9_n >= 80) ? 1 : 0);
        $result['ball']['ball_4']['12_1_3'] += ($field12_1_10_11_n >= 90) ? 2 : (($field12_1_10_11_n >= 80) ? 1 : 0);

        //12. Охват горячим двухразовым горячим питанием (РАССЧЕТНЫЙ
        $field12_4_1_4_n = $arr['field5_1'] + $arr['field5_5'];
        $field12_4_5_9_n = $arr['field5_2'] + $arr['field5_6'];
        $field12_4_10_11_n = $arr['field5_3'] + $arr['field5_7'];

        $field12_4_1_4 = ($field12_4_1_4_n != 0) ? (($arr['field7_13']+$arr['field7_17']) / $field12_4_1_4_n) * 100 : 0;
        $field12_4_5_9 = ($field12_4_5_9_n != 0) ? (($arr['field7_14']+$arr['field7_18']) / $field12_4_5_9_n) * 100 : 0;
        $field12_4_10_11 = ($field12_4_10_11_n != 0) ? (($arr['field7_15']+$arr['field7_19']) / $field12_4_10_11_n) * 100 : 0;

        $field12_4_4_1_4_n = ($field12_4_1_4 >= 100) ? 100 : $field12_1_1_4;
        $field12_4_4_5_9_n = ($field12_4_5_9 >= 100) ? 100 : $field12_1_5_9;
        $field12_4_4_10_11_n = ($field12_4_10_11 >= 100) ? 100 : $field12_1_10_11;
        $field12_4_111 =
            ($field12_4_1_4_n != 0 || $field12_4_5_9_n != 0 ||$field12_4_10_11_n)
                ? (
                    ($arr['field7_13']+$arr['field7_17'] + $arr['field7_14']+$arr['field7_18'] + $arr['field7_15']+$arr['field7_19'])/
                    ($field12_4_1_4_n + $field12_4_5_9_n + $field12_4_10_11_n)
                ) * 100
                : 0;
        //$result['analysis']['field12_4_111'] = $field12_4_111;

        //$result['analysis']['field12_4_1_4'] = $field12_4_4_1_4_n;
        //$result['analysis']['field12_4_5_9'] = $field12_4_4_5_9_n;
        //$result['analysis']['field12_4_10_11'] = $field12_4_4_10_11_n;

        $result['ball']['ball_4']['12_3_1'] += ($field12_4_4_1_4_n >= 90) ? 2 : (($field12_4_4_1_4_n >= 80) ? 1 : 0);
        $result['ball']['ball_4']['12_3_2'] += ($field12_4_4_5_9_n >= 90) ? 2 : (($field12_4_4_5_9_n >= 80) ? 1 : 0);
        $result['ball']['ball_4']['12_3_3'] += ($field12_4_4_10_11_n >= 90) ? 2 : (($field12_4_4_10_11_n >= 80) ? 1 : 0);


        //ball - 5 = 12 баллов
        $result['ball']['ball_5']['field13_1_1_4'] += ($arr['field6_9'] == 1 && $arr['field11_1'] > 0) ? 0.5 : ((($arr['field6_9'] == 0 ||$arr['field6_9'] == 1) && $arr['field11_1'] == 0) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_1_5_9'] += ($arr['field6_10'] == 1 && $arr['field11_1_1'] > 0) ? 0.5 : ((($arr['field6_10'] == 0 ||$arr['field6_10'] == 1) && $arr['field11_1_1'] == 0) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_1_10_11'] += ($arr['field6_11'] == 1 && $arr['field11_1_3'] > 0) ? 0.5 : ((($arr['field6_11'] == 0 ||$arr['field6_11'] == 1) && $arr['field11_1_3'] == 0) ? 0.25 : 0);

        $field13_1_1_4_n = ($arr['field11_1'] != 0) ? ($arr['field11_1_r']/$arr['field11_1']) * 100 : 0;
        $field13_1_5_9_n = ($arr['field11_1_1'] != 0) ? ($arr['field11_1_1_r']/$arr['field11_1_1']) * 100 : 0;
        $field13_1_10_11_n = ($arr['field11_1_3'] != 0) ? ($arr['field11_1_3_r']/$arr['field11_1_3']) * 100 : 0;
        $result['ball']['ball_5']['field13_1_1_4_2_n'] += ($field13_1_1_4_n >= 90) ? 0.5 : (($field13_1_1_4_n >= 80) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_1_5_9_2_n'] += ($field13_1_5_9_n >= 90) ? 0.5 : (($field13_1_5_9_n >= 80) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_1_10_11_2_n'] += ($field13_1_10_11_n >= 90) ? 0.5 : (($field13_1_10_11_n >= 80) ? 0.25 : 0);


        $result['ball']['ball_5']['field13_2_1_4'] += ($arr['field6_13'] == 1 && $arr['field11_2'] > 0) ? 0.5 : ((($arr['field6_13'] == 0 ||$arr['field6_13'] == 1) && $arr['field11_2'] == 0) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_2_5_9'] += ($arr['field6_14'] == 1 && $arr['field11_2_1'] > 0) ? 0.5 : ((($arr['field6_14'] == 0 ||$arr['field6_14'] == 1) && $arr['field11_2_1'] == 0) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_2_10_11'] += ($arr['field6_15'] == 1 && $arr['field11_2_3'] > 0) ? 0.5 : ((($arr['field6_15'] == 0 ||$arr['field6_15'] == 1) && $arr['field11_2_3'] == 0) ? 0.25 : 0);
        $field13_2_1_4_n = ($arr['field11_2'] != 0) ? ($arr['field11_2_r']/$arr['field11_2']) * 100 : 0;
        $field13_2_5_9_n = ($arr['field11_2_1'] != 0) ? ($arr['field11_2_1_r']/$arr['field11_2_1']) * 100 : 0;
        $field13_2_10_11_n = ($arr['field11_2_3'] != 0) ? ($arr['field11_2_3_r']/$arr['field11_2_3']) * 100 : 0;

        $result['ball']['ball_5']['field13_2_1_4_2_n'] = ($field13_2_1_4_n >= 90) ? 0.5 : (($field13_2_1_4_n >= 80) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_2_5_9_2_n'] = ($field13_2_5_9_n >= 90) ? 0.5 : (($field13_2_5_9_n >= 80) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_2_10_11_2_n'] = ($field13_2_10_11_n >= 90) ? 0.5 : (($field13_2_10_11_n >= 80) ? 0.25 : 0);

        $result['ball']['ball_5']['field13_3_1_4'] += ($arr['field6_17'] == 1 && $arr['field11_3'] > 0) ? 0.5 : ((($arr['field6_17'] == 0 ||$arr['field6_17'] == 1) && $arr['field11_3'] == 0) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_3_5_9'] += ($arr['field6_18'] == 1 && $arr['field11_3_1'] > 0) ? 0.5 : ((($arr['field6_18'] == 0 ||$arr['field6_18'] == 1) && $arr['field11_3_1'] == 0) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_3_10_11'] += ($arr['field6_19'] == 1 && $arr['field11_3_3'] > 0) ? 0.5 : ((($arr['field6_19'] == 0 ||$arr['field6_19'] == 1) && $arr['field11_3_3'] == 0) ? 0.25 : 0);

        $field13_3_1_4_n = ($arr['field11_3'] != 0) ? ($arr['field11_3_r']/$arr['field11_3']) * 100 : 0;
        $field13_3_5_9_n = ($arr['field11_3_1'] != 0) ? ($arr['field11_3_1_r']/$arr['field11_3_1']) * 100 : 0;
        $field13_3_10_11_n = ($arr['field11_3_3'] != 0) ? ($arr['field11_3_3_r']/$arr['field11_3_3']) * 100 : 0;
        $result['ball']['ball_5']['field13_3_1_4_2_n'] = ($field13_3_1_4_n >= 90) ? 0.5 : (($field13_3_1_4_n >= 80) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_3_5_9_2_n'] = ($field13_3_5_9_n >= 90) ? 0.5 : (($field13_3_5_9_n >= 80) ? 0.25 : 0);
        $result['ball']['ball_5']['field13_3_10_11_2_n'] = ($field13_3_10_11_n >= 90) ? 0.5 : (($field13_3_10_11_n >= 80) ? 0.25 : 0);


        //ball - 5_1 = 3 баллов
        $result['ball']['ball_5_1']['field13_4_1_4'] += ($arr['field6_33'] == 1 && $arr['field11_7'] > 0) ? 0.5 : ((($arr['field6_33'] == 0 ||$arr['field6_33'] == 1) && $arr['field11_7'] == 0) ? 0.25 : 0);
        $result['ball']['ball_5_1']['field13_4_5_9'] += ($arr['field6_34'] == 1 && $arr['field11_7_1'] > 0) ? 0.5 : ((($arr['field6_34'] == 0 ||$arr['field6_34'] == 1) && $arr['field11_7_1'] == 0) ? 0.25 : 0);
        $result['ball']['ball_5_1']['field13_4_10_11'] += ($arr['field6_35'] == 1 && $arr['field11_3_3'] > 0) ? 0.5 : ((($arr['field6_35'] == 0 ||$arr['field6_35'] == 1) && $arr['field11_7_3'] == 0) ? 0.25 : 0);

        $field13_4_1_4_n = ($arr['field11_7'] != 0) ? ($arr['field11_7_r']/$arr['field11_7']) * 100 : 0;
        $field13_4_5_9_n = ($arr['field11_7_1'] != 0) ? ($arr['field11_7_1_r']/$arr['field11_7_1']) * 100 : 0;
        $field13_4_10_11_n = ($arr['field11_7_3'] != 0) ? ($arr['field11_7_3_r']/$arr['field11_7_3']) * 100 : 0;

        $result['ball']['ball_5_1']['field13_4_1_4_2_n'] += ($field13_4_1_4_n >= 90) ? 0.5 : (($field13_4_1_4_n >= 80) ? 0.25 : 0);
        $result['ball']['ball_5_1']['field13_4_5_9_2_n'] += ($field13_4_5_9_n >= 90) ? 0.5 : (($field13_4_5_9_n >= 80) ? 0.25 : 0);
        $result['ball']['ball_5_1']['field13_4_10_11_2_n'] += ($field13_4_10_11_n >= 90) ? 0.5 : (($field13_4_10_11_n >= 80) ? 0.25 : 0);


        //ball - 6 = 9.5 баллов
        $result['ball']['ball_6']['6_1_1_4'] += ($arr['field25_1'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_5_9'] += ($arr['field25_8'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_10_11'] += ($arr['field25_15'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_1_1_1_4'] += ($arr['field25_1_1'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_1_1_5_9'] += ($arr['field25_9'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_1_1_10_11'] += ($arr['field25_16'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_3_1_4'] += ($arr['field25_3'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_3_5_9'] += ($arr['field25_11'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_3_10_11'] += ($arr['field25_18'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_5_1_4'] += ($arr['field25_5'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_5_5_9'] += ($arr['field25_12'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_5_10_11'] += ($arr['field25_19'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_6_1_4'] += ($arr['field25_6'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_6_5_9'] += ($arr['field25_13'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_6_10_11'] += ($arr['field25_20'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_7_1_4'] += ($arr['field25_7'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_7_5_9'] += ($arr['field25_14'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_7_10_11'] += ($arr['field25_21'] == 1) ? 0.5 : 0;
        $result['ball']['ball_6']['6_1_2_1_4'] += ($arr['field25_2'] == 1) ? 0.15 : 0;
        $result['ball']['ball_6']['6_1_2_5_9'] += ($arr['field25_10'] == 1) ? 0.15 : 0;
        $result['ball']['ball_6']['6_1_2_10_11'] += ($arr['field25_17'] == 1) ? 0.15 : 0;

        //ball - 7 = 18.5 баллов
        $result['ball']['ball_7']['field31_1_1_4'] += ($arr['field31_1'] >= 5) ? 0.5 : (($arr['field31_1'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_1_5_9'] += ($arr['field31_11'] >= 5) ? 0.5 : (($arr['field31_11'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_1_10_11'] += ($arr['field31_21'] >= 5) ? 0.5 : (($arr['field31_21'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_2_1_4'] += ($arr['field31_2'] >= 4) ? 0.5 : (($arr['field31_2'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_2_5_9'] += ($arr['field31_12'] >= 4) ? 0.5 : (($arr['field31_12'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_2_10_11'] += ($arr['field31_22'] >= 4) ? 0.5 : (($arr['field31_22'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_3_1_4'] += ($arr['field31_3'] > 0) ? -1 : 0;
        $result['ball']['ball_7']['field31_3_5_9'] += ($arr['field31_13'] > 0) ? -1 : 0;
        $result['ball']['ball_7']['field31_3_10_11'] += ($arr['field31_23'] > 0) ? -1 : 0;
        $result['ball']['ball_7']['field31_4_1_4'] += ($arr['field31_4'] >= 4) ? 0.5 : (($arr['field31_4'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_4_5_9'] += ($arr['field31_14'] >= 4) ? 0.5 : (($arr['field31_14'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_4_10_11'] += ($arr['field31_24'] >= 4) ? 0.5 : (($arr['field31_24'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_5_1_4'] += ($arr['field31_5'] > 0) ? -1 : 0;
        $result['ball']['ball_7']['field31_5_5_9'] += ($arr['field31_15'] > 0) ? -1 : 0;
        $result['ball']['ball_7']['field31_5_10_11'] += ($arr['field31_25'] > 0) ? -1 : 0;
        $result['ball']['ball_7']['field31_7_1_4'] += ($arr['field31_7'] >= 2) ? 0.5 : (($arr['field31_7'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_7_5_9'] += ($arr['field31_17'] >= 2) ? 0.5 : (($arr['field31_17'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_7_10_11'] += ($arr['field31_27'] >= 2) ? 0.5 : (($arr['field31_27'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_9_1_4'] += ($arr['field31_9'] >= 2) ? 0.5 : (($arr['field31_9'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_9_5_9'] += ($arr['field31_19'] >= 2) ? 0.5 : (($arr['field31_19'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field31_9_10_11'] += ($arr['field31_29'] >= 2) ? 0.5 : (($arr['field31_29'] >= 1) ? 0.25 : 0);
        $result['ball']['ball_7']['field32_1_1_4'] += ($arr['field32_1'] >= 10) ? 1 : (($arr['field32_1'] >= 1) ? 0.5 : 0);
        $result['ball']['ball_7']['field32_1_5_9'] += ($arr['field32_7'] >= 10) ? 1 : (($arr['field32_7'] >= 1) ? 0.5 : 0);
        $result['ball']['ball_7']['field32_1_10_11'] += ($arr['field32_13'] >= 10) ? 1 : (($arr['field32_13'] >= 1) ? 0.5 : 0);
        $result['ball']['ball_7']['field32_2_1_4'] += ($arr['field32_2'] >= 5) ? 1 : (($arr['field32_2'] >= 1) ? 0.5 : 0);
        $result['ball']['ball_7']['field32_2_5_9'] += ($arr['field32_8'] >= 5) ? 1 : (($arr['field32_8'] >= 1) ? 0.5 : 0);
        $result['ball']['ball_7']['field32_2_10_11'] += ($arr['field32_14'] >= 5) ? 1 : (($arr['field32_14'] >= 1) ? 0.5 : 0);
        $result['ball']['ball_7']['field32_5_1_4'] += ($arr['field32_3'] > 0) ? -1 : 0;
        $result['ball']['ball_7']['field32_5_5_9'] += ($arr['field32_9'] > 0) ? -1 : 0;
        $result['ball']['ball_7']['field32_5_10_11'] += ($arr['field32_15'] > 0) ? -1 : 0;
        $result['ball']['ball_7']['field32_6_1_4'] += ($arr['field32_4'] >= 3) ? 1 : (($arr['field32_4'] >= 1) ? 0.5 : 0);
        $result['ball']['ball_7']['field32_6_5_9'] += ($arr['field32_10'] >= 3) ? 1 : (($arr['field32_10'] >= 1) ? 0.5 : 0);
        $result['ball']['ball_7']['field32_6_10_11'] += ($arr['field32_16'] >= 3) ? 1 : (($arr['field32_16'] >= 1) ? 0.5 : 0);
        $result['ball']['ball_7']['field32_7_1_4'] += ($arr['field32_5'] > 0) ? -1 : 0;
        $result['ball']['ball_7']['field32_7_5_9'] += ($arr['field32_11'] > 0) ? -1 : 0;
        $result['ball']['ball_7']['field32_7_10_11'] += ($arr['field32_17'] > 0) ? -1 : 0;


        //ball - 8 = 5 баллов
        $result['ball']['ball_8']['field31_10_1_4'] += ($arr['field31_10_d'] == '1') ? 1 : (($arr['field31_5_d'] == 1) ? 0.5 : 0);
        $result['ball']['ball_8']['field31_10_1_4_v'] += ($arr['field31_11_d'] == '1') ? 1 : (($arr['field31_6_d'] == 1) ? 0.5 : 0);
        $result['ball']['ball_8']['field31_10_5_9'] += ($arr['field31_12_d'] == '1') ? 1 : (($arr['field31_7_d'] == 1) ? 0.5 : 0);
        $result['ball']['ball_8']['field31_10_5_9_v'] += ($arr['field31_13_d'] == '1') ? 1 : (($arr['field31_8_d'] == 1) ? 0.5 : 0);
        $result['ball']['ball_8']['field31_10_10_11'] += ($arr['field31_14_d'] == '1') ? 1 : (($arr['field31_9_d'] == 1) ? 0.5 : 0);

        //ball - 9 = 7 баллов
        $result['ball']['ball_9']['field27_1'] += ($arr['field27_1'] == 1) ? 1 : 0;
        $result['ball']['ball_9']['field27_2'] += ($arr['field27_2'] == 1) ? 1 : 0;
        $result['ball']['ball_9']['field27_3'] += ($arr['field27_3'] == 1) ? 1 : 0;
        $result['ball']['ball_9']['field27_4'] += ($arr['field27_4'] == 1) ? 1 : 0;
        $result['ball']['ball_9']['field27_5'] += ($arr['field27_5'] == 1) ? 0.5 : 0;
        $result['ball']['ball_9']['field27_6'] += ($arr['field27_6'] == 1) ? 0.5 : 0;
        $result['ball']['ball_9']['field27_7'] += ($arr['field27_7'] == 1) ? -0.5 : 0;
        $result['ball']['ball_9']['field27_9'] += ($arr['field27_9'] == 1) ? 0.5 : 0;
        $result['ball']['ball_9']['field27_11'] += ($arr['field27_11'] == 1) ? -0.5 : 0;
        $result['ball']['ball_9']['field27_12'] += ($arr['field27_12'] == 1) ? -0.5 : 0;
        $result['ball']['ball_9']['field27_13'] += ($arr['field27_13'] == 1) ? 0.5 : 0;
        $result['ball']['ball_9']['field27_14'] += ($arr['field27_14'] == 1) ? 0.5 : 0;
        $result['ball']['ball_9']['field27_15'] += ($arr['field27_15'] == 1) ? -0.5 : 0;
        $result['ball']['ball_9']['field27_8'] += ($arr['field27_8'] == 1) ? 0.5 : 0;

        //ball - 10 = 5 баллов
        $result['ball']['ball_10']['field29_1_1_4'] += ($arr['field29_1'] == 1) ? 1 : 0;
        $result['ball']['ball_10']['field29_1_5_9'] += ($arr['field29_2'] == 1) ? 1 : 0;
        $result['ball']['ball_10']['field29_1_10_11'] += ($arr['field29_3'] == 1) ? 1 : 0;
        $result['ball']['ball_10']['field29_5_1_4'] += ($arr['field29_5'] == 1) ? 1 : 0;
        $result['ball']['ball_10']['field29_5_5_9'] += ($arr['field29_6'] == 1) ? 0.5 : 0;
        $result['ball']['ball_10']['field29_5_10_11'] += ($arr['field29_7'] == 1) ? 0.5 : 0;

        //ball - 11 = 7 баллов
        $result['ball']['ball_11']['field20_1'] += ($arr['field20_1'] == 1) ? 1 : 0;
        $result['ball']['ball_11']['field20_2'] += ($arr['field20_2'] == 1) ? 1 : 0;
        $result['ball']['ball_11']['field20_3'] += ($arr['field20_3'] == 1) ? 0.5 : 0;
        $result['ball']['ball_11']['field20_4'] += ($arr['field20_4'] == 1) ? 1 : 0;
        $result['ball']['ball_11']['field20_5'] += ($arr['field20_5'] == 1) ? 1 : 0;
        $result['ball']['ball_11']['field20_6'] += ($arr['field20_6'] == 1) ? 1 : 0;
        $result['ball']['ball_11']['field20_7'] += ($arr['field20_7'] == 1) ? 0.5 : 0;
        $result['ball']['ball_11']['field20_8'] += ($arr['field20_8'] == 1) ? 1 : 0;

        $result['analysis']['field4_24'] += $arr['field4_24'];
        $result['analysis']['field4_21'] += $arr['field4_21'];
        $result['analysis']['field4_22'] += $arr['field4_22'];
        $result['analysis']['field4_23'] += $arr['field4_23'];

        $result['analysis']['field7_24'] += $arr['field7_24'];
        $result['analysis']['field7_21'] += $arr['field7_21'];
        $result['analysis']['field7_22'] += $arr['field7_22'];
        $result['analysis']['field7_23'] += $arr['field7_23'];

        $result['analysis']['field5_4'] += $arr['field5_4'];
        $result['analysis']['field5_8'] += $arr['field5_8'];
        $result['analysis']['field5_1'] += $arr['field5_1'];
        $result['analysis']['field5_2'] += $arr['field5_2'];
        $result['analysis']['field5_3'] += $arr['field5_3'];
        $result['analysis']['field5_5'] += $arr['field5_5'];
        $result['analysis']['field5_6'] += $arr['field5_6'];
        $result['analysis']['field5_7'] += $arr['field5_7'];

        $result['analysis']['field7_16'] += $arr['field7_16'];
        $result['analysis']['field7_16_3'] += $arr['field7_16_3'];

        $result['analysis']['field11_1'] += $arr['field11_1'];
        $result['analysis']['field11_1_1'] += $arr['field11_1_1'];
        $result['analysis']['field11_1_3'] += $arr['field11_1_3'];

        $result['analysis']['field11_7'] += $arr['field11_7'];
        $result['analysis']['field11_7_1'] += $arr['field11_7_1'];
        $result['analysis']['field11_7_3'] += $arr['field11_7_3'];

        $result['analysis']['field11_3'] += $arr['field11_3'];
        $result['analysis']['field11_3_1'] += $arr['field11_3_1'];
        $result['analysis']['field11_3_3'] += $arr['field11_3_3'];

        $result['analysis']['field11_3_r'] += $arr['field11_3_r'];
        $result['analysis']['field11_3_1_r'] += $arr['field11_3_1_r'];
        $result['analysis']['field11_3_3_r'] += $arr['field11_3_3_r'];

        $result['analysis']['field11_2'] += $arr['field11_2'];
        $result['analysis']['field11_2_1'] += $arr['field11_2_1'];
        $result['analysis']['field11_2_3'] += $arr['field11_2_3'];

        $result['analysis']['field11_2_r'] += $arr['field11_2_r'];
        $result['analysis']['field11_2_1_r'] += $arr['field11_2_1_r'];
        $result['analysis']['field11_2_3_r'] += $arr['field11_2_3_r'];


        //print_r('<pre>');
        //print_r($result);
        //print_r('<br><br><br>');
        //print_r(array_sum($result['ball']));
        //exit();

        //ball - 1 = 16 баллов
        //ball - 2 = 12 баллов
        //ball - 3 = 33 баллов
        //ball - 4 = 18 баллов
        //ball - 5 = 21 баллов
        $result['ball']['ballVse']['ball_1'] = (($sum1 = array_sum($result['ball']['ball_1'])) <= 10) ? $sum1 : 10;
        $result['ball']['ballVse']['ball_2'] = (($sum2 = array_sum($result['ball']['ball_2'])) <= 5) ? $sum2 : 5;
        $result['ball']['ballVse']['ball_3'] = (($sum3 = array_sum($result['ball']['ball_3'])) <= 6) ? $sum3 : 6;
        $result['ball']['ballVse']['ball_4'] = (($sum4 = array_sum($result['ball']['ball_4'])) <= 12) ? $sum4 : 12;
        $sum5 = array_sum($result['ball']['ball_5']);
        $sum5_1 = array_sum($result['ball']['ball_5_1']);
        $result['ball']['ballVse']['ball_5'] = (($sum5+$sum5_1) <= 12) ? $sum5+$sum5_1 : 12;
        $result['ball']['ballVse']['ball_5_1'] = ($sum5_1 <= 3) ? $sum5_1 : 3;
        $sum6 = array_sum($result['ball']['ball_6']);
        $result['ball']['ballVse']['ball_6'] = (($sum6 + 0.05) <= 9.5) ? $sum6 + 0.05 : 9.5;
        $sum7 = array_sum($result['ball']['ball_7']);
        $result['ball']['ballVse']['ball_7'] = (($sum7 + 2) <= 18.5) ? $sum7 + 2 : 18.5;
        $result['ball']['ballVse']['ball_8'] = (($sum8 = array_sum($result['ball']['ball_8'])) <= 5) ? $sum8 : 5;
        $result['ball']['ballVse']['ball_9'] = (($sum9 = array_sum($result['ball']['ball_9'])) <= 7) ? $sum9 : 7;
        $result['ball']['ballVse']['ball_10'] = (($sum10 = array_sum($result['ball']['ball_10'])) <= 5) ? $sum10 : 5;
        $result['ball']['ballVse']['ball_11'] = (($sum11 = array_sum($result['ball']['ball_11'])) <= 7) ? $sum11 : 7;

        $result['ball']['ballVse']['ballVse'] = (($sum = array_sum($result['ball']['ballVse'])) <= 100) ? $sum : 100;

        return $result;
    }

    public static function for_printing_analysisAff($arr, $model)
    {

        $result = $model->for_printing_analysisNew($arr);

        $result['ball']['ball_1'] += $result['analysis']['range_food1'];
        $result['ball']['ball_1'] += $result['analysis']['range_food2'];
        $result['ball']['ball_1'] += $result['analysis']['range_food3'];
        $result['ball']['ball_1'] += $result['analysis']['range_food4'];
        $result['ball']['ball_1'] += $result['analysis']['main_menu_dishes'];
        $result['ball']['ball_1'] += $result['analysis']['foods_enriched'];
        $result['ball']['ball_1'] += $result['analysis']['organized_nutrition_coverage1'];
        $result['ball']['ball_1'] += $result['analysis']['organized_nutrition_coverage2'];
        $result['ball']['ball_1'] += $result['analysis']['organized_nutrition_coverage3'];
        $result['ball']['ball_1'] += $result['analysis']['field4_5_1'];

        $result['ball']['ball_2'] += $result['analysis']['field5_1_4'];
        $result['ball']['ball_2'] += $result['analysis']['field5_5_9'];
        $result['ball']['ball_2'] += $result['analysis']['field5_10_11'];
        $result['ball']['ball_2'] += $result['analysis']['vitamins'];
        $result['ball']['ball_2'] += $result['analysis']['mineral'];

        $result['ball']['ball_3'] += $result['analysis']['field7_1_4'];
        $result['ball']['ball_3'] += $result['analysis']['field7_5_9'];
        $result['ball']['ball_3'] += $result['analysis']['field7_10_11'];
        $result['ball']['ball_3'] += $result['analysis']['field8_1_4'];
        $result['ball']['ball_3'] += $result['analysis']['field8_5_9'];
        $result['ball']['ball_3'] += $result['analysis']['field8_10_11'];
        $result['ball']['ball_3'] += $result['analysis']['field8_10_11'];
        
        $result['ball']['ball_4'] += $result['analysis']['field12_2_1_4'];
        $result['ball']['ball_4'] += $result['analysis']['field12_2_5_9'];
        $result['ball']['ball_4'] += $result['analysis']['field12_2_10_11'];
        $result['ball']['ball_4'] += $result['analysis']['field12_5_1_4'];
        $result['ball']['ball_4'] += $result['analysis']['field12_5_5_9'];
        $result['ball']['ball_4'] += $result['analysis']['field12_5_10_11'];

        $result['ball']['ball_5'] += $result['analysis']['field13_1_1_4'];
        $result['ball']['ball_5'] += $result['analysis']['field13_1_5_9'];
        $result['ball']['ball_5'] += $result['analysis']['field13_1_10_11'];
        $result['ball']['ball_5'] += $result['analysis']['field13_1_10_11'];
        $result['ball']['ball_5'] += $result['analysis']['field13_1_1_4_2_n'];
        $result['ball']['ball_5'] += $result['analysis']['field13_1_5_9_2_n'];
        $result['ball']['ball_5'] += $result['analysis']['field13_1_10_11_2_n'];
        $result['ball']['ball_5'] += $result['analysis']['field13_2_1_4'];
        $result['ball']['ball_5'] += $result['analysis']['field13_2_5_9'];
        $result['ball']['ball_5'] += $result['analysis']['field13_2_10_11'];
        $result['ball']['ball_5'] += $result['analysis']['field13_2_1_4_2_n'];
        $result['ball']['ball_5'] += $result['analysis']['field13_2_5_9_2_n'];
        $result['ball']['ball_5'] += $result['analysis']['field13_2_10_11_2_n'];
        $result['ball']['ball_5'] += $result['analysis']['field13_3_1_4'];
        $result['ball']['ball_5'] += $result['analysis']['field13_3_5_9'];
        $result['ball']['ball_5'] += $result['analysis']['field13_3_10_11'];
        $result['ball']['ball_5'] += $result['analysis']['field13_3_1_4_2_n'];
        $result['ball']['ball_5'] += $result['analysis']['field13_3_5_9_2_n'];
        $result['ball']['ball_5'] += $result['analysis']['field13_3_10_11_2_n'];
        $result['ball']['ball_5'] += $result['analysis']['field13_3_10_11_2_n'];

        $result['ball']['ball_5'] += $result['analysis']['field13_4_1_4'];
        $result['ball']['ball_5_1'] += $result['analysis']['field13_4_1_4'];

        $result['ball']['ball_5'] += $result['analysis']['field13_4_5_9'];
        $result['ball']['ball_5_1'] += $result['analysis']['field13_4_5_9'];

        $result['ball']['ball_5'] += $result['analysis']['field13_4_10_11'];
        $result['ball']['ball_5_1'] += $result['analysis']['field13_4_10_11'];

        $result['ball']['ball_5'] += $result['analysis']['field13_4_1_4_2_n'];
        $result['ball']['ball_5_1'] += $result['analysis']['field13_4_1_4_2_n'];

        $result['ball']['ball_5'] += $result['analysis']['field13_4_5_9_2_n'];
        $result['ball']['ball_5_1'] += $result['analysis']['field13_4_5_9_2_n'];

        $result['ball']['ball_5'] += $result['analysis']['field13_4_10_11_2_n'];
        $result['ball']['ball_5_1'] += $result['analysis']['field13_4_10_11_2_n'];

        $result['ball']['ball_6'] = 0.05;
        $result['ball']['ball_6'] += $result['analysis']['field25_1_1_4'];
        $result['ball']['ball_6'] += $result['analysis']['field25_1_5_9'];
        $result['ball']['ball_6'] += $result['analysis']['field25_1_10_11'];
        $result['ball']['ball_6'] += $result['analysis']['field25_1_1_1_4'];
        $result['ball']['ball_6'] += $result['analysis']['field25_1_1_5_9'];
        $result['ball']['ball_6'] += $result['analysis']['field25_1_1_10_11'];
        $result['ball']['ball_6'] += $result['analysis']['field25_3_1_4'];
        $result['ball']['ball_6'] += $result['analysis']['field25_3_5_9'];
        $result['ball']['ball_6'] += $result['analysis']['field25_3_10_11'];
        $result['ball']['ball_6'] += $result['analysis']['field25_5_1_4'];
        $result['ball']['ball_6'] += $result['analysis']['field25_5_5_9'];
        $result['ball']['ball_6'] += $result['analysis']['field25_5_10_11'];
        $result['ball']['ball_6'] += $result['analysis']['field25_6_1_4'];
        $result['ball']['ball_6'] += $result['analysis']['field25_6_5_9'];
        $result['ball']['ball_6'] += $result['analysis']['field25_6_10_11'];
        $result['ball']['ball_6'] += $result['analysis']['field25_7_1_4'];
        $result['ball']['ball_6'] += $result['analysis']['field25_7_5_9'];
        $result['ball']['ball_6'] += $result['analysis']['field25_7_10_11'];
        $result['ball']['ball_6'] += $result['analysis']['field25_2_1_4'];
        $result['ball']['ball_6'] += $result['analysis']['field25_2_5_9'];
        $result['ball']['ball_6'] += $result['analysis']['field25_2_10_11'];

        $result['ball']['ball_7'] = 2;
        $result['ball']['ball_7'] += $result['analysis']['field31_1_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field31_1_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field31_1_10_11'];
        $result['ball']['ball_7'] += $result['analysis']['field31_2_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field31_2_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field31_2_10_11'];
        $result['ball']['ball_7'] += $result['analysis']['field31_3_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field31_3_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field31_3_10_11'];
        $result['ball']['ball_7'] += $result['analysis']['field31_4_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field31_4_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field31_4_10_11'];
        $result['ball']['ball_7'] += $result['analysis']['field31_5_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field31_5_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field31_5_10_11'];
        $result['ball']['ball_7'] += $result['analysis']['field31_7_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field31_7_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field31_7_10_11'];
        $result['ball']['ball_7'] += $result['analysis']['field31_9_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field31_9_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field31_9_10_11'];
        $result['ball']['ball_7'] += $result['analysis']['field32_1_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field32_1_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field32_1_10_11'];
        $result['ball']['ball_7'] += $result['analysis']['field32_2_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field32_2_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field32_2_10_11'];
        $result['ball']['ball_7'] += $result['analysis']['field32_5_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field32_5_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field32_5_10_11'];
        $result['ball']['ball_7'] += $result['analysis']['field32_6_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field32_6_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field32_6_10_11'];
        $result['ball']['ball_7'] += $result['analysis']['field32_7_1_4'];
        $result['ball']['ball_7'] += $result['analysis']['field32_7_5_9'];
        $result['ball']['ball_7'] += $result['analysis']['field32_7_10_11'];

        $result['ball']['ball_8'] += $result['analysis']['field31_10_1_4'];
        $result['ball']['ball_8'] += $result['analysis']['field31_10_1_4_v'];
        $result['ball']['ball_8'] += $result['analysis']['field31_10_5_9'];
        $result['ball']['ball_8'] += $result['analysis']['field31_10_5_9_v'];
        $result['ball']['ball_8'] += $result['analysis']['field31_10_10_11'];

        $result['ball']['ball_9'] += $result['analysis']['field27_1'];
        $result['ball']['ball_9'] += $result['analysis']['field27_2'];
        $result['ball']['ball_9'] += $result['analysis']['field27_3'];
        $result['ball']['ball_9'] += $result['analysis']['field27_4'];
        $result['ball']['ball_9'] += $result['analysis']['field27_5'];
        $result['ball']['ball_9'] += $result['analysis']['field27_6'];
        $result['ball']['ball_9'] += $result['analysis']['field27_7'];
        $result['ball']['ball_9'] += $result['analysis']['field27_9'];
        $result['ball']['ball_9'] += $result['analysis']['field27_11'];
        $result['ball']['ball_9'] += $result['analysis']['field27_12'];
        $result['ball']['ball_9'] += $result['analysis']['field27_13'];
        $result['ball']['ball_9'] += $result['analysis']['field27_14'];
        $result['ball']['ball_9'] += $result['analysis']['field27_15'];
        $result['ball']['ball_9'] += $result['analysis']['field27_8'];

        $result['ball']['ball_10'] += $result['analysis']['field29_1_1_4'];
        $result['ball']['ball_10'] += $result['analysis']['field29_1_5_9'];
        $result['ball']['ball_10'] += $result['analysis']['field29_1_10_11'];
        $result['ball']['ball_10'] += $result['analysis']['field29_5_1_4'];
        $result['ball']['ball_10'] += $result['analysis']['field29_5_5_9'];
        $result['ball']['ball_10'] += $result['analysis']['field29_5_10_11'];

        $result['ball']['ball_11'] += $result['analysis']['field20_1'];
        $result['ball']['ball_11'] += $result['analysis']['field20_2'];
        $result['ball']['ball_11'] += $result['analysis']['field20_3'];
        $result['ball']['ball_11'] += $result['analysis']['field20_4'];
        $result['ball']['ball_11'] += $result['analysis']['field20_5'];
        $result['ball']['ball_11'] += $result['analysis']['field20_6'];
        $result['ball']['ball_11'] += $result['analysis']['field20_7'];
        $result['ball']['ball_11'] += $result['analysis']['field20_8'];

        $result['ball']['ballVse'] = (array_sum($result['ball']) > 100) ? 100 : array_sum($result['ball']);

        return $result;

    }

    public static function printingArrayUnique($arr, $nameArr = []) {
        //array_unique()
        $str = '';
        $arrUnique = [];
        if($nameArr != []){
            foreach ($arr as $one){
                if($nameArr[$one]['number']){
                    //$str .= $nameArr[$one]['number'] . ';<br>';
                    $arrUnique[] = $nameArr[$one]['number'];
                }
            }
            foreach (array_unique($arrUnique) as $one){
                    $str .= $one . ';<br>';
            }
        } else {
            foreach ($arr as $one){
                $str .= $one . ';<br>';
            }
        }

        return ($str != '') ? substr($str, 0,-5) : '-';
    }

}
