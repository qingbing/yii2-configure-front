<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace YiiConfigureLogic\components;


use Yii;
use YiiHelper\abstracts\Model;

/**
 * 模型: 业务数据模型基类
 *
 * Class ConfigureModel
 * @package YiiConfigureLogic\components
 */
abstract class ConfigureModel extends Model
{
    /**
     * 业务数据链接
     *
     * @return object|\yii\db\Connection|null
     * @throws \yii\base\InvalidConfigException
     */
    public static function getDb()
    {
        if (Yii::$app->has('db_configure')) {
            return Yii::$app->get('db_configure');
        }
        return Yii::$app->getDb();
    }
}