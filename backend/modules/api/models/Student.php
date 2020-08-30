<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $email
 * @property int|null $pocket_money
 * @property string $password
 * @property int|null $is_deleted
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'password'], 'required'],
            [['pocket_money', 'is_deleted'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'pocket_money' => 'Pocket Money',
            'password' => 'Password',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
