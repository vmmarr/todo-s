<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "etiquetas".
 *
 * @property int $id
 * @property string|null $etiqueta
 *
 * @property Etiquetatareas[] $etiquetatareas
 */
class Etiquetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'etiquetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['etiqueta'], 'string', 'max' => 255],
            [['etiqueta'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'etiqueta' => 'Etiqueta',
        ];
    }

    /**
     * Gets query for [[Etiquetatareas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEtiquetatareas()
    {
        return $this->hasMany(Etiquetatareas::className(), ['etiqueta_id' => 'id']);
    }
}
