<h3 class="page-header">Table Dict : <?php echo $table->name; ?></h3>
<table class="table table-bordered table-hover table-striped table-condensed margin-top">
    <thead>
    <tr>
        <th>字段名称</th>
        <th>注释</th>
        <th>允许空</th>
        <th>类型描述</th>
        <th>默认值</th>
        <th>自增</th>
        <th>主键</th>
        <th>外键</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($table->columns as $column) {
        /* @var \DbSupports\ColumnSchema $column */
        ?>
        <tr>
            <td><?php echo $column->name; ?></td>
            <td><?php echo $column->comment; ?></td>
            <td><?php echo $column->allowNull ? "是" : ""; ?></td>
            <td><?php echo $column->dbType; ?></td>
            <td><?php echo null === $column->defaultValue ? "NULL" : $column->defaultValue; ?></td>
            <td><?php echo $column->autoIncrement ? "是" : ""; ?></td>
            <td><?php echo $column->isPrimaryKey ? "是" : ""; ?></td>
            <td><?php echo $column->isForeignKey ? "是" : ""; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<pre class="code margin-top"><?php echo $tableSql; ?>;</pre>