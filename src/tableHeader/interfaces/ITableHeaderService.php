<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\tableHeader\interfaces;

use YiiHelper\services\interfaces\IService;

/**
 * 接口: 表头对外输出接口
 *
 * Interface ITableHeaderService
 * @package YiiConfigureLogic\tableHeader\interfaces
 */
interface ITableHeaderService extends IService
{
    /**
     * 获取前端表单选项
     *
     * @param array $params
     * @return mixed
     */
    public function options(array $params): array;
}