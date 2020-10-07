<?php 
header('Content-Type:application/octet-stream/');
header("Content-Disposition:attachment; filename =$title.xlsx");
header('Pragma:no-cache');
header('Expires: 0');
echo "\xEF\xBB\xBF"; //UTF-8 BOM
?>

<table>
    <thead>
        <tr>
            <td>STT</td>
            <td>Mã Nhân Viên</td>
            <td>Họ Tên</td>
            <td>Team</td>
            <td>Điện thoại</td>
            <td>Model điện thoại</td>
            <td>Serial#1</td>
            <td>Laptop</td>
            <td>Model laptop</td>
            <td>Serial#2</td>
            <td>Khác</td>
            <td>Serial#3</td>
            <td>Hình ảnh</td>
        </tr>
    </thead>
    <tbody>
    <?php  $i = 1;?>
        <?php foreach($user as $value):?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $value['manv']?> </td>
            <td><?= $value['fullname']?> </td>
            <td><?= $value['team']?> </td>
            <td><?= $value['phone']?> </td>
            <td><?= $value['model_phone']?> </td>
            <td><?= $value['serial']?> </td>
            <td><?= $value['laptop']?> </td>
            <td><?= $value['model_laptop']?> </td>
            <td><?= $value['serial2']?> </td>
            <td><?= $value['orther']?> </td>
            <td><?= $value['serial3']?> </td>
            <td><?= $value['images']?> </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>