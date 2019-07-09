<?php
/**
 * Link         :   http://www.phpcorner.net
 * User         :   qingbing<780042175@qq.com>
 * Date         :   2019-02-24
 * Version      :   1.0
 */

namespace Dict\Components;


class Pub
{
    /**
     * 获取当前 application
     * @return \Abstracts\Application|\Render\Application
     */
    public static function getApp()
    {
        return \PF::app();
    }

    /**
     * 获取当前 module
     * @return \Abstracts\Module | \Dict\Module
     */
    public static function getModule()
    {
        return self::getApp()->getController()->getModule();
    }

    /**
     * 获取当前模块的用户组件
     * @return \Dict\Components\WebUser|\Abstracts\Component|null
     * @throws \Helper\Exception
     */
    public static function getUser()
    {
        return self::getModule()->getComponent('user');
    }
}