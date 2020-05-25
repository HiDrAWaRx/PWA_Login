<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_rol".
 *
 * @property int $idRol
 * @property int $idUser
 *
 * @property Rol $idRol0
 * @property User $idUser0
 */
class UserRol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_rol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRol', 'idUser'], 'required'],
            [['idRol', 'idUser'], 'integer'],
            [['idRol', 'idUser'], 'unique', 'targetAttribute' => ['idRol', 'idUser']],
            [['idRol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['idRol' => 'id']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRol' => 'Id Rol',
            'idUser' => 'Id User',
        ];
    }

    /**
     * Gets query for [[IdRol0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdRol0()
    {
        return $this->hasOne(Rol::className(), ['id' => 'idRol']);
    }

    /**
     * Gets query for [[IdUser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
