<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 06.02.19
 * Time: 23:56
 */

namespace shop\entities\User;

use yii\db\ActiveRecord;

/**
 * @property integer $user_id
 * @property integer $product_id
 */
class WishlistItem extends ActiveRecord
{
    public static function create($productId)
    {
        $item = new static();
        $item->product_id = $productId;
        return $item;
    }

    public function isForProduct($productId): bool
    {
        return $this->product_id == $productId;
    }

    public static function tableName(): string
    {
        return '{{%user_wishlist_items}}';
    }
}