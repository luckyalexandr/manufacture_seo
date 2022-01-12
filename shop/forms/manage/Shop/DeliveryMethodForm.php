<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 1:58
 */

namespace shop\forms\manage\Shop;

use shop\entities\Shop\DeliveryMethod;
use yii\base\Model;

class DeliveryMethodForm extends Model
{
    public $name;
    public $name_uk;
    public $cost;
    public $minWeight;
    public $maxWeight;
    public $sort;

    public function __construct(DeliveryMethod $method = null, $config = [])
    {
        if ($method) {
            $this->name = $method->name;
            $this->name = $method->name_uk;
            $this->cost = $method->cost;
            $this->minWeight = $method->min_weight;
            $this->maxWeight = $method->max_weight;
            $this->sort = $method->sort;
        } else {
            $this->sort = DeliveryMethod::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'name_uk', 'cost', 'sort'], 'required'],
            [['name', 'name_uk'], 'string', 'max' => 255],
            [['cost', 'minWeight', 'maxWeight', 'sort'], 'integer'],
        ];
    }
}