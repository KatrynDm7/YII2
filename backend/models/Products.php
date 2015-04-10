<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property float $price
 * @property integer $quantity
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 * @property integer $email
 *
 * @property User $user
 */
class Products extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['quantity'], 'default', 'value' => 0],
            [['quantity'], 'number', 'min' => 0],
            [['quantity', 'user_id'], 'integer'],
            [['price'], 'number', 'min' => 0],
            [['name'], 'string', 'max' => 10],
            [['email'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'email' => 'Owner',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
