<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\form\services;

use YiiConfigureLogic\form\interfaces\IFormService;
use YiiConfigureLogic\form\logic\FormOptionLogic;
use YiiConfigureLogic\form\logic\FormSettingLogic;
use YiiConfigureLogic\form\models\FormOption;
use YiiHelper\abstracts\Service;
use YiiHelper\helpers\AppHelper;
use Zf\Helper\Exceptions\BusinessException;

/**
 * 服务: 区块展示
 *
 * Class FormService
 * @package YiiConfigureLogic\form\services
 */
class FormService extends Service implements IFormService
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
        return FormOptionLogic::getInstance()
            ->setKey($params['key'])
            ->setParams($params)
            ->getData();
    }

    /**
     * 获取配置表单类型
     *
     * @param array $params
     * @return array
     * @throws BusinessException
     */
    public function setting(array $params): array
    {
        return FormSettingLogic::getInstance()
            ->setKey($params['key'])
            ->setParams($params)
            ->getData();
    }
}