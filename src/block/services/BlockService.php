<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\block\services;

use YiiConfigureLogic\block\interfaces\IBlockService;
use YiiConfigureLogic\block\logic\BlockInfoLogic;
use YiiConfigureLogic\block\models\BlockCategory;
use YiiConfigureLogic\block\models\BlockOption;
use YiiHelper\abstracts\Service;
use YiiHelper\helpers\AppHelper;

/**
 * 服务: 区块展示
 *
 * Class BlockService
 * @package YiiConfigureLogic\block\services
 */
class BlockService extends Service implements IBlockService
{
    /**
     * 获取区块信息
     *
     * @param array $params
     * @return mixed
     */
    public function info(array $params)
    {
        return BlockInfoLogic::getInstance()
            ->setKey($params['key'])
            ->setParams($params)
            ->getData();
    }
}