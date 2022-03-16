<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\form\logic;


use Yii;
use YiiConfigureLogic\form\models\FormCategory;
use YiiConfigureLogic\form\models\FormOption;
use YiiConfigureLogic\form\models\FormSetting;
use YiiHelper\abstracts\BaseCacheLogic;
use Zf\Helper\Exceptions\BusinessException;

/**
 * 工具: 配置表单
 *
 * Class FormSettingLogic
 * @package YiiConfigureLogic\form\logic
 */
class FormSettingLogic extends BaseCacheLogic
{
    /**
     * 获取缓存键
     *
     * @return string
     */
    protected function getCacheKey(): string
    {
        return "conf:form:setting:" . $this->key;
    }

    /**
     * 获取需要缓存的逻辑数据
     *
     * @return array|mixed
     * @throws BusinessException
     * @throws \yii\base\InvalidConfigException
     */
    protected function getCacheData()
    {
        $category = FormCategory::findOne([
            'key' => $this->params['key'],
        ]);
        if (null === $category) {
            throw new BusinessException("不存在的表单类型");
        }
        if ($category->is_setting != 1) {
            throw new BusinessException(replace('表单"{key}"不是配置表单', [
                "{key}" => $this->key,
            ]));
        }
        $setting = $category->setting;
        if (null === $setting) {
            $setting      = Yii::createObject(FormSetting::class);
            $setting->key = $category->key;
        }
        // 获取 setting 参数
        if (is_array($setting->values) || null === $setting->values) {
            $values = $setting->values;
        } else {
            $values = json_decode($setting->values, true);
        }
        return $this->mergeSetting($values);
    }

    /**
     * 获取参数的默认值
     *
     * @return array
     */
    protected function getDefaults()
    {
        $options = FormOption::getEnableOptions($this->key);
        $R       = [];
        foreach ($options as $option) {
            $R[$option->field] = $option->default;
        }
        return $R;
    }

    /**
     * 合并配置表单值
     *
     * @param array|null $values
     * @return array
     */
    protected function mergeSetting(?array $values = null)
    {
        // 获取参数的默认值
        $defaults = $this->getDefaults();
        if (null === $values || 0 === count($defaults)) {
            return $defaults;
        }
        $R = [];
        foreach ($defaults as $field => $default) {
            $R[$field] = $values[$field] ?? $default;
        }
        return $R;
    }
}
