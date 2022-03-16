<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\tableHeader\services;

use YiiConfigureLogic\tableHeader\interfaces\ITableHeaderService;
use YiiConfigureLogic\tableHeader\logic\TableHeaderOptionLogic;
use YiiHelper\abstracts\Service;

/**
 * 服务: 区块展示
 *
 * Class FormService
 * @package YiiConfigureLogic\form\services
 */
class TableHeaderService extends Service implements ITableHeaderService
{
    /**
     * 获取缓存key
     *
     * @param string $key
     * @return string
     */
    protected function getCacheKey($key)
    {
        return "_conf_:form:{$key}";
    }

    /**
     * 获取前端表单选项
     *
     * @param array $params
     * @return mixed
     */
    public function options(array $params): array
    {
        return TableHeaderOptionLogic::getInstance()
            ->setKey($params['key'])
            ->setParams($params)
            ->getData();
    }
}