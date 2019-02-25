<?php
/**
 * Link         :   http://www.phpcorner.net
 * User         :   qingbing<780042175@qq.com>
 * Date         :   2019-02-25
 * Version      :   1.0
 */

namespace Dict\Controllers;


use Dict\Components\Controller;
use Dict\Models\TableParser;

class DictController extends Controller
{
    /**
     * 查看所有数据表结构
     * @throws \Exception
     */
    public function actionIndex()
    {
        // 获取并分析数据
        $tables = TableParser::tables();
        // 渲染页面
        $this->render('index', [
            'tables' => $tables,
        ]);
    }
}