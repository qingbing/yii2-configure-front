<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\replaceSetting\controllers;

use Exception;
use YiiConfigureLogic\replaceSetting\interfaces\IReplaceService;
use YiiConfigureLogic\replaceSetting\models\ReplaceSetting;
use YiiConfigureLogic\replaceSetting\services\ReplaceService;
use YiiHelper\abstracts\RestController;

/**
 * 控制器: 替换配置对外接口
 *
 * Class FormController
 * @package YiiConfigureLogic\form\controllers
 *
 * @property-read IReplaceService $service
 */
class ReplaceController extends RestController
{
    public $serviceInterface = IReplaceService::class;
    public $serviceClass     = ReplaceService::class;

    /**
     * 获取替换后内容
     *
     * @return array
     * @throws Exception
     */
    public function actionContent()
    {
        // 参数验证和获取
        $params = $this->validateParams([
            [['code'], 'required'],
            ['code', 'exist', 'label' => '替换标记', 'targetClass' => ReplaceSetting::class, 'targetAttribute' => 'code'],
            ['params', 'safe', 'label' => '替换字段'],
        ]);
        // 替换字段处理
        if (!is_array($params['params'])) {
            $params['params'] = [];
        } else {
            $_params = [];
            foreach ($params['params'] as $k => $v) {
                $_params["{{$k}}"] = $v;
            }
            $params['params'] = $_params;
        }
        // 业务处理
        $res = $this->service->content($params);
        // 渲染结果
        return $this->success($res, '表单选项');
    }
}