<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\form\controllers;


use Exception;
use YiiConfigureLogic\form\interfaces\IFormService;
use YiiConfigureLogic\form\models\FormCategory;
use YiiConfigureLogic\form\services\FormService;
use YiiHelper\abstracts\RestController;

/**
 * 控制器: 表单对外接口
 *
 * Class FormController
 * @package YiiConfigureLogic\form\controllers
 *
 * @property-read IFormService $service
 */
class FormController extends RestController
{
    public $serviceInterface = IFormService::class;
    public $serviceClass     = FormService::class;

    /**
     * 获取前端表单选项
     *
     * @return array
     * @throws Exception
     */
    public function actionOptions()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            ['key', 'required'],
            ['key', 'exist', 'label' => '表单标记', 'targetClass' => FormCategory::class, 'targetAttribute' => 'key'],
        ]);
        // 业务处理
        $res = $this->service->options($params);
        // 渲染结果
        return $this->success($res, '表单选项');
    }

    /**
     * 获取配置表单类型
     *
     * @return array
     * @throws Exception
     */
    public function actionSetting()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            ['key', 'required'],
            ['key', 'exist', 'label' => '表单标记', 'targetClass' => FormCategory::class, 'targetAttribute' => 'key'],
        ]);
        // 业务处理
        $res = $this->service->setting($params);
        // 渲染结果
        return $this->success($res, '配置');
    }
}