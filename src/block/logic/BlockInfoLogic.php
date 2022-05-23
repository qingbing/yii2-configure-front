<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\block\logic;


use YiiConfigureLogic\block\models\BlockCategory;
use YiiConfigureLogic\block\models\BlockOption;
use YiiHelper\abstracts\BaseCacheLogic;

/**
 * 逻辑: 获取区块信息
 *
 * Class BlockInfoLogic
 * @package YiiConfigureLogic\block\logic
 */
class BlockInfoLogic extends BaseCacheLogic
{
    /**
     * 获取缓存键
     *
     * @return string
     */
    protected function getCacheKey(): string
    {
        return "conf:block:info:" . $this->key;
    }

    /**
     * 获取需要缓存的逻辑数据
     *
     * @return mixed
     */
    protected function getCacheData()
    {
        // 类型
        $category = BlockCategory::find()
            ->select([
                'is_enable',
                'key',
                'type',
                'name',
                'description',
                'src',
                'content',
            ])
            ->andWhere(['=', 'key', $this->params['key']])
            ->asArray()
            ->one();
        if (!$category['is_enable']) {
            return ['is_enable' => 0];
        }
        if (!isset(BlockCategory::LIST_TYPES[$category['type']])) {
            // 非列表: content, image, image-link
            switch ($category['type']) {
                case BlockCategory::TYPE_CONTENT:
                    unset($category['src']);
                    break;
                case BlockCategory::TYPE_IMAGE:
                    unset($category['content']);
                    break;
                default:
                    break;
            }
            // 内容和图片链接没有选项
            return $category;
        }
        unset($category['src'], $category['content']);
        // 删选字段
        $fields = [
            "label",
            "description",
        ];
        if (isset(BlockCategory::IMAGE_TYPES[$category['type']])) {
            // 图片列表
            $fields[] = 'src';
        }
        if (isset(BlockCategory::LINK_TYPES[$category['type']])) {
            // 链接列表
            $fields[] = 'link';
            $fields[] = 'is_blank';
        }
        // 选项
        $query               = BlockOption::find()
            ->select($fields)
            ->andWhere(['=', 'key', $this->params['key']])
            ->andWhere(['=', 'is_enable', IS_ENABLE_YES])
            ->orderBy('sort_order ASC');
        $category['options'] = $query->asArray()
            ->all();
        return $category;
    }
}