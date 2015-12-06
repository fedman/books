<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BooksSearch represents the model behind the search form about `app\models\Books`.
 */
class BooksSearch extends Books
{
    public $authorName;
    public $fromDate;
    public $toDate;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['name', 'date_create', 'date_update', 'preview', 'date', 'authorName', 'fromDate', 'toDate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Books::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'defaultOrder' => ['id' => SORT_ASC],
            'attributes' => [
                'id',
                'name',
                'author_id' => [
                    'asc' => ['authors.firstname' => SORT_ASC, 'authors.lastname' => SORT_ASC],
                    'desc' => ['authors.firstname' => SORT_DESC, 'authors.lastname' => SORT_DESC],
                    'label' => 'Author'
                ],
                'date_update',
                'date'
            ]
        ]);
     
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'date' => $this->date,
            'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'preview', $this->preview]);
        
        // filter by author name
        $query->joinWith(['author' => function ($q) {
            $q->where('authors.firstname LIKE "%' . $this->authorName . '%"'
                    . ' OR authors.lastname LIKE "%' . $this->authorName . '%"');
        }]);
        
        //filter by date
        if ($this->fromDate && $this->toDate) {
            $query->andWhere("DATE(`date`) >= STR_TO_DATE('" . $this->fromDate . 
                    "',  '%d/%m/%Y') AND DATE(`date`) <= STR_TO_DATE('" . 
                    $this->toDate . "',  '%d/%m/%Y')");
        }
        
        
        return $dataProvider;
    }
}
