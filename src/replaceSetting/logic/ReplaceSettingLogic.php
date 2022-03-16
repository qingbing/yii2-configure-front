<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\replaceSetting\logic;


use YiiConfigureLogic\replaceSetting\models\ReplaceSetting as ReplaceSettingModel;
use YiiHelper\abstracts\BaseLogic;
use Zf\Helper\Exceptions\BusinessException;

/**
 * 逻辑: 替换配置
 *
 * Class ReplaceSetting
 * @package YiiHelper\features\replaceSetting\tools
 */
class ReplaceSettingLogic extends BaseLogic
{
    /**
     * 获取逻辑数据
     *
     * @return mixed|string
     * @throws BusinessException
     */
    public function getData()
    {
        $record = ReplaceSettingModel::find()
            ->select(['template', 'content', 'replace_fields'])
            ->andWhere(['=', 'code', $this->params['code']])
            ->asArray()
            ->one();
        if (false === $record) {
            throw new BusinessException(replace('找不到替换模版"{code}"', [
                '{code}' => $this->params['code'],
            ]), 1000);
        }
        $replaces = array_merge(ReplaceSettingModel::getReplaces(), $this->params['params']);
        $template = $record['content'] ?: $record['template'];
        return replace($template, $replaces, true);
    }
}