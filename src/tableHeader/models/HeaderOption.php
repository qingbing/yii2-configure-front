<?php

namespace YiiConfigureLogic\tableHeader\models;

use YiiConfigureLogic\components\ConfigureModel;

/**
 * This is the model class for table "{{%header_option}}".
 *
 * @property int $id 自增ID
 * @property string $key 所属表头标记
 * @property string $field 字段名
 * @property string $label 显示名
 * @property string $width 固定宽度
 * @property string $fixed 列固定:[left,right,""]
 * @property string $default 默认值,当字段没有是返回，基本无用
 * @property string $align 表格内容对齐方式:[center,left,right]
 * @property int $is_image 是否图片列表
 * @property int $is_tooltip 当内容过长被隐藏时显示 tooltip
 * @property int $is_resizable 对应列是否可以通过拖动改变宽度
 * @property int $is_editable 当为编辑表格时，字段是否可在table中编辑
 * @property string $component 使用组件
 * @property string|null $options 字段选项映射关系
 * @property string|null $params 参数内容
 * @property string $description 描述
 * @property int $sort_order 分类排序
 * @property int $is_required 是否必选，为"是"时不能没取消
 * @property int $is_default 是否默认开启
 * @property int $is_enable 是否开启
 * @property string $operate_ip 操作IP
 * @property int $operate_uid 操作UID
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class HeaderOption extends ConfigureModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%header_option}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'field', 'label'], 'required'],
            [['is_image', 'is_tooltip', 'is_resizable', 'is_editable', 'sort_order', 'is_required', 'is_default', 'is_enable', 'operate_uid'], 'integer'],
            [['options', 'params', 'created_at', 'updated_at'], 'safe'],
            [['key', 'default'], 'string', 'max' => 100],
            [['field', 'component'], 'string', 'max' => 60],
            [['label'], 'string', 'max' => 50],
            [['width', 'fixed', 'align'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 255],
            [['operate_ip'], 'string', 'max' => 15],
            [['key', 'field'], 'unique', 'targetAttribute' => ['key', 'field']],
            [['key', 'label'], 'unique', 'targetAttribute' => ['key', 'label']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'           => '自增ID',
            'key'          => '所属表头标记',
            'field'        => '字段名',
            'label'        => '显示名',
            'width'        => '固定宽度',
            'fixed'        => '列固定',
            'default'      => '默认值',
            'align'        => '对齐方式',
            'is_image'     => '图片列表',
            'is_tooltip'   => '使用tooltip',
            'is_resizable' => '开启拖动',
            'is_editable'  => '表格编辑',
            'component'    => '组件',
            'options'      => '字段映射',
            'params'       => '参数内容',
            'description'  => '描述',
            'sort_order'   => '排序',
            'is_required'  => '是否必选',
            'is_default'   => '默认开启',
            'is_enable'    => '是否开启',
            'operate_ip'   => '操作IP',
            'operate_uid'  => '操作UID',
            'created_at'   => '创建时间',
            'updated_at'   => '更新时间',
        ];
    }
}
