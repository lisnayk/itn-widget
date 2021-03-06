<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property integer $id
 * @property string $name
 * @property string $sname
 * @property string $fname
 * @property string $auth_key
 * @property string $access_token
 * @property string $comment
 * @property integer $status
 * @property string $created
 * @property string $updated
 * @property string $genAuthKey
 * @property Logs[] $logs
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $genAuthKey = false;
   
    
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [["name","status_id"], 'required'],
            [['id', 'status_id'], 'integer'],
            [['fname', 'comment'], 'string'],
            [['created', 'updated', "genAuthKey"], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['sname', 'auth_key',"access_token"], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'genAuthKey' => 'Сгенерировать ключ/токен аутенификации',
            'name' => 'Название',
            'sname' => 'Краткое название',
            'fname' => 'Полное название',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'comment' => 'Коментарий',
            'status' => 'Статус',
            'created' => 'Создан',
            'updated' => 'Обновлен',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Logs::className(), ['client_id' => 'id']);
    }
    
    public function getStatus(){
        return $this->hasOne(Statuses::className(), ["id"=>"status_id"]);
    }
}
