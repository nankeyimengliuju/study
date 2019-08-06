<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

return array(
    'version' => '1.0',
    'id'      => 'qt',
    'name'    => '测试模块',
    'v3'      => true,
    'menu'    => array(
        'plugincom' => 1,
        'items'     => array(
            array('title' => '留言模块', 'route' => 'adv'),
            array(
                'title' => '留言管理',
                'items' => array(
                    array('title' => '留言管理', 'route' => 'question', 'route_must' => true),
                    array('title' => '添加留言', 'route' => 'edit')
                )
            ),
            array('title' => '问题分类', 'route' => 'category'),
            array('title' => '基础设置', 'route' => 'set')
        )
    )
);

?>
