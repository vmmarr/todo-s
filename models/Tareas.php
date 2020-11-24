<?php

namespace app\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "tareas".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descripcion
 * @property int $usuario_id
 * @property string $vencimiento
 * @property bool|null $esrealizada
 *
 * @property Etiquetatareas[] $etiquetatareas
 * @property Usuarios $usuario
 */
class Tareas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tareas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion', 'usuario_id', 'vencimiento'], 'required'],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['vencimiento'], 'safe'],
            [['esrealizada'], 'boolean'],
            [['titulo'], 'string', 'max' => 255],
            [['descripcion'], 'string', 'max' => 100],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'usuario_id' => 'Usuario ID',
            'vencimiento' => 'Vencimiento',
            'esrealizada' => 'Esrealizada',
        ];
    }

    /**
     * Gets query for [[Etiquetatareas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEtiquetatareas()
    {
        return $this->hasMany(Etiquetatareas::className(), ['tarea_id' => 'id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id']);
    }

    public function validarFecha($fecha)
    {
        $ahora = new DateTime();
        $vencimiento = new DateTime($fecha);
        if ($ahora < $vencimiento) {
            return false;
        } else {
            return true;
        }
    }
}
