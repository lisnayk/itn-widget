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
 * @property string $comment
 * @property integer $status
 * @property string $created
 * @property string $updated
 *
 * @property Logs[] $logs
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['id'], 'required'],
            [['id', 'status'], 'integer'],
            [['fname', 'comment'], 'string'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['sname', 'auth_key'], 'string', 'max' => 100],
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
            'sname' => 'Sname',
            'fname' => 'Fname',
            'auth_key' => 'Auth Key',
            'comment' => 'Comment',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Logs::className(), ['client_id' => 'id']);
    }
}
