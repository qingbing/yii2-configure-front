<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\form\logic;


use YiiConfigureLogic\form\models\FormOption;
use YiiHelper\abstracts\BaseCacheLogic;

/**
 * 逻辑: 获取表单选项
 *
 * Class FormOptionLogic
 * @package YiiConfigureLogic\form\logic
 */
class FormOptionLogic extends BaseCacheLogic
{
    /**
     * 获取缓存键
     *
     * @return string
     */
    protected function getCacheKey(): string
    {
        return "conf:form:option:" . $this->key;
    }

    /**
     * 获取需要缓存的逻辑数据
     *
     * @return mixed
     */
    protected function getCacheData()
    {
        // 获取所有表单选项
        $options = FormOption::getEnableOptions($this->params['key']);
        $R       = [];
        foreach ($options as $option) {
            $_                = [];
            $_['field']       = $option->field;
            $_['label']       = $option->label;
            $_['input_type']  = $option->input_type;
            $_['default']     = $option->default;
            $_['placeholder'] = $option->placeholder;
            is_array($option->exts) && count($option->exts) > 0 && ($_['exts'] = $option->exts);
            if (
                (
                    $option->input_type === FormOption::INPUT_TYPE_INPUT_RADIO ||
                    $option->input_type === FormOption::INPUT_TYPE_INPUT_CHECKBOX ||
                    $option->input_type === FormOption::INPUT_TYPE_INPUT_SELECT
                ) && isset($option->exts['options']) && is_array($option->exts['options'])
            ) {
                $_options = [];
                foreach ($option->exts['options'] as $k => $v) {
                    $_options[$k] = $v;
                }
                $_['exts']['options'] = $_options;
            }
            if (is_array($option->rules) && count($option->rules) > 0) {
                $rules = $option->rules;
            } else {
                $rules = [];
            }
            if ($option->is_required) {
                $rule = [
                    "type"    => "required",
                    "message" => $option->required_msg,
                ];
                if (empty($option->required_msg)) {
                    unset($rule['message']);
                }
                array_unshift($rules, $rule);
            }
            count($rules) > 0 && ($_['rules'] = $rules);
            $R[$option->field] = $_;
        }
        return $R;
    }
}