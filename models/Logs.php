<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $client_id
 * @property string $comment
 * @property string $logtime
 * @property string $created
 * @property string $remoteIp
 * @property string $romoteAddr
 * @property string $remoteHost
 * @property string $remotePort
 * @property string $httpAgent
 *
 * @property Clients $client
 * @property Events $client0
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'event_id', 'client_id'], 'integer'],
            [['comment'], 'string'],
            [['logtime', 'created'], 'safe'],
            [['remoteIp'], 'string', 'max' => 45],
            [['romoteAddr'], 'string', 'max' => 50],
            [['remoteHost', 'httpAgent'], 'string', 'max' => 255],
            [['remotePort'], 'string', 'max' => 10],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'client_id' => 'Client ID',
            'comment' => 'Comment',
            'logtime' => 'Logtime',
            'created' => 'Created',
            'remoteIp' => 'Remote Ip',
            'romoteAddr' => 'Romote Addr',
            'remoteHost' => 'Remote Host',
            'remotePort' => 'Remote Port',
            'httpAgent' => 'Http Agent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient0()
    {
        return $this->hasOne(Events::className(), ['id' => 'client_id']);
    }
}
