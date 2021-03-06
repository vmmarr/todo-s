<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tareas;
use Yii;

/**
 * TareasSearch represents the model behind the search form of `app\models\Tareas`.
 */
class TareasSearch extends Tareas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id'], 'integer'],
            [['titulo', 'descripcion'], 'safe'],
            [['vencimiento'], 'validarFecha'],
            [['esrealizada'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function validarFecha($fecha)
    {
        if (strtotime($this->vencimiento) < strtotime(date('Y-m-d'))) {
            $this->addError($fecha, 'No puede ser menor que hoy');
        }
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if (Yii::$app->user->id !== 1) {
            $query = Tareas::find()->where(['usuario_id' => Yii::$app->user->id]);
        } else {
            $query = Tareas::find();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'vencimiento' => $this->vencimiento,
            'esrealizada' => $this->esrealizada,
        ]);

        $query->andFilterWhere(['ilike', 'titulo', $this->titulo]);

        return $dataProvider;
    }
}
