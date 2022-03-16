<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\tableHeader\controllers;


use Exception;
use YiiConfigureLogic\tableHeader\models\HeaderCategory;
use YiiConfigureLogic\tableHeader\interfaces\ITableHeaderService;
use YiiConfigureLogic\tableHeader\services\TableHeaderService;
use YiiHelper\abstracts\RestController;

/**
 * 控制器: 表单对外接口
 *
 * Class FormController
 * @package YiiConfigureLogic\form\controllers
 *
 * @property-read ITableHeaderService $service
 */
class TableHeaderController extends RestController
{
    public $serviceInterface = ITableHeaderService::class;
    public $serviceClass     = TableHeaderService::class;

    /**
     * 获取表头选项
     *
     * @return array
     * @throws Exception
     */
    public function actionOptions()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            ['key', 'required'],
            ['key', 'exist', 'label' => '表头标记', 'targetClass' => HeaderCategory::class, 'targetAttribute' => 'key'],
        ]);
        // 业务处理
        $res = $this->service->options($params);
        // 渲染结果
        return $this->success($res, '表头选项');
    }
}