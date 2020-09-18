<?php 
header('Content-Type:application/octet-stream/');
header("Content-Disposition:attachment; filename =$title.xls");
header('Pragma:no-cache');
header('Expires: 0');
echo "\xEF\xBB\xBF"; //UTF-8 BOM
?>

<table>
    <thead>
        <tr>
            <td>stt</td>
            <td>anhr</td>
            <td>ho ten</td>
            <td>team</td>
            <td>phone</td>
            <td>serial1</td>
            <td>laptop</td>
            <td>serial2</td>
            <td>orther</td>
            <td>serial3</td>
        </tr>
    </thead>
    <tbody>
    <?php  $i = 0;?>
        <?php foreach($user as $value):?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $value['images']?> </td>
            <td><?= $value['fullname']?> </td>
            <td><?= $value['team']?> </td>
            <td><?= $value['phone']?> </td>
            <td><?= $value['serial']?> </td>
            <td><?= $value['laptop']?> </td>
            <td><?= $value['serial2']?> </td>
            <td><?= $value['orther']?> </td>
            <td><?= $value['serial3']?> </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>