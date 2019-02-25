<?php
// 引用类
use dict\models\TableParser;

/* @var $tables array */
?><h3 class="page-header">Table Dict</h3>
<?php
foreach ($tables as $tableInfo) {
    $table = TableParser::table($tableInfo['TABLE_NAME']);
    ?>
    <table class="table table-bordered table-hover table-striped table-condensed margin-top">
        <thead>
        <tr>
            <th colspan="8" align="left">
                表名：<?php echo $tableInfo['TABLE_NAME']; ?>
                （<?php echo $tableInfo['TABLE_COMMENT']; ?>）
            </th>
        </tr>
        <tr>
            <th colspan="8" align="left">
                引擎类型：<?php echo $tableInfo['ENGINE']; ?>，
                字符类型：<?php echo $tableInfo['TABLE_COLLATION']; ?>。
            </th>
        </tr>
        <tr>
            <th>字段名称</th>
            <th>注释</th>
            <th>类型描述</th>
            <th>默认值</th>
            <th>允许空</th>
            <th>自增</th>
            <th>主键</th>
            <th>外键</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($table->columns as $column) {
            /* @var \pf\db\ColumnSchema $column */
            ?>
            <tr>
                <td><?php echo $column->name; ?></td>
                <td><?php echo $column->comment; ?></td>
                <td><?php echo $column->dbType; ?></td>
                <td><?php echo null === $column->defaultValue ? "NULL" : $column->defaultValue; ?></td>
                <td><?php echo $column->allowNull ? "是" : ""; ?></td>
                <td><?php echo $column->autoIncrement ? "是" : ""; ?></td>
                <td><?php echo $column->isPrimaryKey ? "是" : ""; ?></td>
                <td><?php echo $column->isForeignKey ? "是" : ""; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>