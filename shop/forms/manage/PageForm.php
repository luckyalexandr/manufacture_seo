<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.02.19
 * Time: 8:06
 */

namespace shop\forms\manage;

use shop\entities\Page;
use shop\forms\CompositeForm;
use shop\validators\SlugValidator;
use yii\helpers\ArrayHelper;

/**
 * @property MetaForm $meta;
 */
class PageForm extends CompositeForm
{
    public $title;
    public $slug;
    public $content;
    public $title_uk;
    public $slug_uk;
    public $content_uk;
    public $parentId;

    private $_page;

    public function __construct(Page $page = null, $config = [])
    {
        if ($page) {
            $this->title = $page->title;
            $this->title = $page->title_uk;
            $this->slug = $page->slug;
            $this->slug = $page->slug_uk;
            $this->content = $page->content;
            $this->content = $page->content_uk;
            $this->parentId = $page->parent ? $page->parent->id : null;
            $this->meta = new MetaForm($page->meta);
            $this->_page = $page;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['title', 'slug'], 'required'],
            [['parentId'], 'integer'],
            [['title', 'slug', 'title_uk', 'slug_uk'], 'string', 'max' => 255],
            [['content', 'content_uk'], 'string'],
            [['slug', 'slug_uk'], SlugValidator::class],
            [['slug'], 'unique', 'targetClass' => Page::class, 'filter' => $this->_page ? ['<>', 'id', $this->_page->id] : null]
        ];
    }

    public function parentsList(): array
    {
        return ArrayHelper::map(Page::find()->orderBy('lft')->asArray()->all(), 'id', function (array $page) {
            return ($page['depth'] > 1 ? str_repeat('-- ', $page['depth'] - 1) . ' ' : '') . $page['title'];
        });
    }

    public function internalForms(): array
    {
        return ['meta'];
    }
}