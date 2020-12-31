<?php

namespace App\Tools;

class ViewUtils {

    /**
     * 生成一个视图配置数据
     * 
     * @param Array $config
     * @return Array 
     */
    static function generateConfig($config = []) 
    {
        $default = [
            'pageInfo'=> [
                'title'=> '标题',
                'description'=> '页面描述',
            ],
            'showBackButton'=> false,
        ];

        return array_merge($default,$config);
    }

}