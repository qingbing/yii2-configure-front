<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\replaceSetting\services;


use YiiConfigureLogic\replaceSetting\interfaces\IReplaceService;
use YiiConfigureLogic\replaceSetting\logic\ReplaceSetting;
use YiiConfigureLogic\replaceSetting\logic\ReplaceSettingLogic;
use YiiHelper\abstracts\Service;
use Zf\Helper\Exceptions\BusinessException;

/**
 * 服务: 替换配置
 *
 * Class ReplaceService
 * @package YiiConfigureLogic\replaceSetting\services
 */
class ReplaceService extends Service implements IReplaceService
{
    /**
     * 获取替换后内容
     *
     * @param array $params
     * @return mixed|string
     * @throws BusinessException
     */
    public function content(array $params)
    {
        return ReplaceSettingLogic::getInstance()
            ->setParams($params)
            ->getData();
    }
}