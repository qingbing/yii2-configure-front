<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\tableHeader\logic;


use YiiConfigureLogic\tableHeader\models\HeaderOption;
use YiiHelper\abstracts\BaseCacheLogic;

/**
 * 逻辑: 表头选项
 *
 * Class TableHeaderOptionLogic
 * @package YiiConfigureLogic\tableHeader\logic
 */
class TableHeaderOptionLogic extends BaseCacheLogic
{
    /**
     * 获取缓存键
     *
     * @return string
     */
    protected function getCacheKey(): string
    {
        return "conf:tableHeader:option:" . $this->key;
    }

    /**
     * 获取需要缓存的逻辑数据
     *
     * @return mixed
     */
    protected function getCacheData()
    {
        // 获取所有表头选项
        $options = HeaderOption::find()
            ->andWhere(['=', 'key', $this->params['key']])
            ->andWhere(['=', 'is_enable', 1])
            ->orderBy('sort_order ASC, id ASC')
            ->all();
        /* @var HeaderOption[] $options */
        $R = [];
        foreach ($options as $option) {
            $_            = [];
            $_['field']   = $option->field;
            $_['label']   = $option->label;
            $_['default'] = $option->default;
            empty($option->width) || ($_['width'] = $option->width);
            empty($option->fixed) || ($_['fixed'] = $option->fixed);
            empty($option->align) || ($_['align'] = $option->align);
            empty($option->component) || ($_['component'] = $option->component);
            empty($option->options) || ($_['options'] = $option->options);
            empty($option->params) || ($_['params'] = $option->params);
            1 == $option->is_tooltip && ($_['is_tooltip'] = true);
            1 == $option->is_resizable && ($_['is_resizable'] = true);
            1 == $option->is_editable && ($_['is_editable'] = true);
            $R[$option->field] = $_;
        }
        return $R;
    }
}