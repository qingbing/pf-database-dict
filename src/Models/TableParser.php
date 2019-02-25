<?php
/**
 * Link         :   http://www.phpcorner.net
 * User         :   qingbing<780042175@qq.com>
 * Date         :   2019-02-25
 * Version      :   1.0
 */

namespace Dict\Models;


use Dict\Components\Pub;

/**
 * 数据库解析
 * Class TableParser
 * @package Dict\Models
 */
class TableParser
{
    /**
     * 获取创建 table 的 SQL
     * @param string $tableName
     * @param \Components\Db|null
     * @return mixed
     * @throws \Exception
     */
    static public function getSqlForTableCreate($tableName, $db = null)
    {
        $db = self::_getDb($db);
        $result = $db->createCommand()
            ->setText("SHOW CREATE TABLE `{$tableName}`")
            ->queryRow();
        return $result['Create Table'];
    }

    /**
     * 获取数据表各字段结构
     * @param string $tableName
     * @param \Components\Db|null
     * @return mixed
     * @throws \Exception
     */
    static public function table($tableName, $db = null)
    {
        $db = self::_getDb($db);
        return $db->getTable($tableName, true);
    }

    /**
     * 解析数据库中的所有表
     * @param \Components\Db|null
     * @return array
     * @throws \Exception
     */
    static public function tables($db = null)
    {
        $db = self::_getDb($db);
        $tables = $db->createCommand()
            ->setText('SELECT * FROM `information_schema`.`tables`  WHERE `table_schema`=:db_name')
            ->queryAll([
                ':db_name' => self::_parseDbNameFromDns($db->dsn),
            ]);
        $ignoreTableSuffix = Pub::getModule()->ignoreTableSuffix;
        $R = [];
        foreach ($tables as $tableInfo) {
            $isDeduct = false;
            foreach ($ignoreTableSuffix as $suffix) {
                if (preg_match('#' . $suffix . '$#', $tableInfo['TABLE_NAME'])) {
                    $isDeduct = true;
                    break;
                }
            }
            if (!$isDeduct) {
                array_push($R, $tableInfo);
            }
        }
        return $R;
    }

    /**
     * 访问的 DB-DNS
     * @param string $dns
     * @return string
     */
    static private function _parseDbNameFromDns($dns)
    {
        static $_dbNames = [];
        if (!isset($_dbNames[$dns])) {
            $a = explode(';', $dns);
            foreach ($a as $s) {
                $s = trim($s);
                if (0 === strpos($s, 'dbname')) {
                    $aa = explode('=', $s);
                    $tableName = trim(array_pop($aa));
                    if (!empty($tableName))
                        return $_dbNames[$dns] = $tableName;
                }
            }
            die('No name for database.');
        } else {
            return $_dbNames[$dns];
        }
    }

    /**
     * 获取处理的数据库连接
     * @param \Components\Db $db
     * @return \Components\Db|null
     * @throws \Helper\Exception
     */
    static private function _getDb($db)
    {
        return null === $db ? Pub::getApp()->getDb() : $db;
    }
}