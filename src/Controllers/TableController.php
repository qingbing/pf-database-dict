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

class TableController extends Controller
{
    /**
     * 数据表信息浏览
     * @throws \Exception
     */
    public function actionIndex()
    {
        // 数据获取
        $tables = TableParser::tables();
        // 渲染页面
        $this->render('index', [
            'tables' => $tables,
        ]);
    }

    /**
     * 查询单表的信息
     * @throws \Exception
     */
    public function actionTable()
    {
        // 参数获取
        $name = $this->getActionParam('name');
        // 数据获取
        $table = TableParser::table($name);
        $tableSql = TableParser::getSqlForTableCreate($name);
        // 渲染页面
        $this->render('table', [
            'table' => $table,
            'tableSql' => $tableSql,
        ]);
    }
}