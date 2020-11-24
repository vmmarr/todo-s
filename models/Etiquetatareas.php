<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "etiquetatareas".
 *
 * @property int $id
 * @property int|null $etiqueta_id
 * @property int|null $tarea_id
 *
 * @property Etiquetas $etiqueta
 * @property Tareas $tarea
 */
class Etiquetatareas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'etiquetatareas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['etiqueta_id', 'tarea_id'], 'default', 'value' => null],
            [['etiqueta_id', 'tarea_id'], 'integer'],
            [['etiqueta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Etiquetas::className(), 'targetAttribute' => ['etiqueta_id' => 'id']],
            [['tarea_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tareas::className(), 'targetAttribute' => ['tarea_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'etiqueta_id' => 'Etiqueta ID',
            'tarea_id' => 'Tarea ID',
        ];
    }

    /**
     * Gets query for [[Etiqueta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEtiqueta()
    {
        return $this->hasOne(Etiquetas::className(), ['id' => 'etiqueta_id']);
    }

    /**
     * Gets query for [[Tarea]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTarea()
    {
        return $this->hasOne(Tareas::className(), ['id' => 'tarea_id']);
    }
}
