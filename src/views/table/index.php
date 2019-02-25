<?php
/* @var $this \dict\components\Controller */
/* @var $tables array */
?>
<h3 class="page-header">Table List</h3>
<table class="table table-bordered table-hover table-striped table-condensed margin-top">
    <thead>
    <tr>
        <th>Db Schema</th>
        <th>Comment</th>
        <th>Engine</th>
        <th>Rows</th>
        <th>Increment</th>
        <th>Collation</th>
        <th>Create Time</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tables as $table) { ?>
        <tr>
            <td>
                <a href="<?php echo $this->createUrl('table', ['name' => $table['TABLE_NAME']]); ?>"><?php echo $table['TABLE_NAME'] . '.' . $table['TABLE_NAME']; ?></a>
            </td>
            <td><?php echo $table['TABLE_COMMENT']; ?></td>
            <td><?php echo $table['ENGINE']; ?></td>
            <td><?php echo $table['TABLE_ROWS']; ?></td>
            <td><?php echo $table['AUTO_INCREMENT']; ?></td>
            <td><?php echo $table['TABLE_COLLATION']; ?></td>
            <td><?php echo $table['CREATE_TIME']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>