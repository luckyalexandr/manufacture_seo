<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 08.01.19
 * Time: 8:31
 */

namespace shop\forms\manage\Shop\Product;


use shop\entities\Shop\Product\Review;
use yii\base\Model;

class ReviewEditForm extends Model
{
    public $vote;
    public $text;

    public function __construct(Review $review, $config = [])
    {
        $this->vote = $review->vote;
        $this->text = $review->text;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['vote', 'text'], 'required'],
            [['vote'], 'in', 'range' => [1, 2, 3, 4, 5]],
            ['text', 'string'],
        ];
    }
}