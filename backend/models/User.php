<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $full_name
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property string|null $verification_token
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 *
 * @property UserRol[] $userRols
 * @property Rol[] $idRols
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'full_name', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'status'], 'required'],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['username', 'full_name', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['password_reset_token', 'email'], 'unique', 'targetAttribute' => ['password_reset_token', 'email']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'full_name' => 'Full Name',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'verification_token' => 'Verification Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[UserRols]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserRols()
    {
        return $this->hasMany(UserRol::className(), ['idUser' => 'id']);
    }

    /**
     * Gets query for [[IdRols]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdRols()
    {
        return $this->hasMany(Rol::className(), ['id' => 'idRol'])->viaTable('user_rol', ['idUser' => 'id']);
    }
}
