<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\form\interfaces;

use YiiHelper\services\interfaces\IService;

/**
 * 接口: 表单对外输出接口
 *
 * Interface IFormService
 * @package YiiConfigureLogic\form\interfaces
 */
interface IFormService extends IService
{
    /**
     * 获取前端表单选项
     *
     * @param array $params
     * @return mixed
     */
    public function options(array $params): array;

    /**
     * 获取配置表单类型
     *
     * @param array $params
     * @return mixed
     */
    public function setting(array $params): array;
}