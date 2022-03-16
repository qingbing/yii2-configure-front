<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\replaceSetting\interfaces;


use YiiHelper\services\interfaces\IService;

/**
 * 接口: 替换配置对外输出接口
 *
 * Interface IReplaceService
 * @package YiiConfigureLogic\replaceSetting\interfaces
 */
interface IReplaceService extends IService
{
    /**
     * 获取替换后内容
     *
     * @param array $params
     * @return mixed
     */
    public function content(array $params);
}