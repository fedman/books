<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 *
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'fullName' => 'Full Name'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['author_id' => 'id']);
    }
    
    /**
     * 
     * @return array
     */
    public static function getList()
    {
        $list = self::find()
                ->select(['id', 'name' => "CONCAT(firstname, ' ', lastname)"])
                ->asArray()->all();

        $optionsList = \yii\helpers\ArrayHelper::map($list, 'id', 'name');
        
        return $optionsList;
    }
    
    /**
     * Returns full name of author
     * 
     * @return string
     */
    public function getFullName() {
        return $this->firstname . ' ' . $this->lastname;
    }
}
