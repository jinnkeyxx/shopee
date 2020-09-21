<style type="text/css" media="screen">
tr th {
    background-color: #10c469;
    color: #424242;
}

.pt-2,
.py-2 {
    padding-top: 1.3rem !important;
}
</style>

<div class="container py-5">
    <div class="row ">
        <div class="col-12 py-2">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                        data-whatever="@mdo"><i class="fas fa-user-plus"></i> ĐĂNG KÝ VÀO</button>
                    <a type="button" class="btn btn-success" href="checkout"><i class="fas fa-user-plus"></i> ĐĂNG KÝ
                        RA</a>
                    <!-- <button name="select_all" id="select_all" class="btn btn-info"><i class="fas fa-edit"></i>chon
                        tat
                        ca</button> -->
                    <hr>
                    <h4>Tải lên danh sách người dùng</h4>

                    <?= form_open_multipart('userlist/uploaddata') ?>
                    <div class="form-row">
                        <div class="col-4">
                            <input type="file" class="form-control-file" id="importexcel" name="importexcel"
                                accept=".xlsx,.xls" required>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary"> <i class="fas fa-upload"></i> Import</button>
                        </div>
                        <div class="col">
                            <?= $this->session->flashdata('pesan'); ?>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <form method="post" id="update_form" action="userlist/update" enctype='multipart/form-data'>


                        <div align="left">




                            <a class="btn-warning btn" href="userlist/excel"><i class="fas fa-download"></i> Tải danh
                                sách xuống </a>
                            <?php if($admin->role == 0){?>
                            <a class="btn-primary btn" href="userlogin"><i class="fas fa-download"></i>Danh sach admin
                            </a>
                            <a class="btn-primary btn" href="userlistaprove"><i class="fas fa-download"></i>Danh sach
                                cho duyet <span>  </span>
                            </a>
                            <?php } else {?>
                            <a class="btn-primary btn" href="userpost"><i class="fas fa-download"></i>Danh sach
                                cho duyet cua ban </a>
                            <a class="btn-primary btn" href="userpostaprove"><i class="fas fa-download"></i>Danh sach
                                da duyet cua ban  <?php if($aprove > 0){ ?><span
                                    class="text-danger"><?= $aprove;  ?></span><?php  } ?></a>
                            <?php } ?>

                        </div>
                        <br>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-checkable nowrap"
                                style="margin-top: 13px !important">
                                <thead>
                                    <tr role="row">
                                        <th>STT</th>

                                        <th>Họ và Tên</th>
                                        <th>Mã Nhân Viên</th>
                                        <th>Team</th>
                                        <th>Điện thoại</th>
                                        <th>Modem điện thoại</th>
                                        <th>Serial#1</th>
                                        <th>Laptop</th>
                                        <th>Modem laptop</th>
                                        <th>Serial#2</th>
                                        <th>Khác</th>
                                        <th>Serial#3</th>
                                        <th>Hình ảnh</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 0; foreach ($user as $value):?>
                                    <?php if($value['status'] == 0 && $value['user_post'] == $admin->username){  ?>
                                    <tr id="table_<?= $value['id']; ?>" class="sorting_<?= $i++; ?>">
                                        <td> <?= $i++; ?> </td>

                                        <td><?= $value['fullname']; ?></td>
                                        <td><?= $value['manv']; ?></td>
                                        <td><?= $value['team']; ?></td>
                                        <td><?= $value['phone']; ?></td>
                                        <td><?= $value['model_phone']; ?></td>
                                        <td><?= $value['serial']; ?></td>
                                        <td><?= $value['laptop']; ?></td>
                                        <td><?= $value['model_laptop']; ?></td>
                                        <td><?= $value['serial2']; ?></td>
                                        <td><?= $value['orther']; ?></td>
                                        <td><?= $value['serial3']; ?></td>
                                        <td>
                                            <div class=" media" style="margin-top:-10px">
                                                <div class="avatar">
                                                    <img class="mt-1 ml-2 mr-3"
                                                        style="margin-left:0px;width:80px;height:80px"
                                                        src="<?= $value['images']; ?>">
                                                </div>
                                            </div>
                                            <!-- /./ -->
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php  endforeach;  ?>
                                </tbody>
                            </table>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Thêm Người dùng mới</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('userlist/add') ?>
                    <div class="form-group">
                        <label for="fullname" class="col-form-label">Họ Tên:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="Team" class="col-form-label">Team</label>
                        <select class="form-control" name="team">
                            <option value="Inbound"> Inbound</option>
                            <option value="Inventory"> Inventory</option>
                            <option value="Outbound"> Outbound</option>
                            <option value="Return"> Return</option>
                            <option value="Khác"> Khác</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Điện thoại</label>
                        <input type="checkbox" id="phone" name="phone">
                        <input type="text" class="form-control d-none" id="serial1" name="serial1">
                    </div>
                    <div class="form-group">
                        <label for="laptop" class="col-form-label">Laptop</label>
                        <input type="checkbox" id="laptop" name="laptop">
                        <input type="text" class="form-control d-none" id="serial2" name="serial2">
                    </div>
                    <div class="form-group">
                        <label for="orther" class="col-form-label">Khác</label>
                        <input type="text" id="orther" name="orther" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="orther" class="col-form-label">serial</label>

                        <input type="text" class="form-control " disabled id="serial3" name="serial3">
                    </div>
                    <div class="form-group">
                        <label for="images" class="col-form-label">Hình ảnh</label>

                        <input type="file" class="form-control" id="images" name="img">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Trở về</button>
                    <button type="submit" class=" btn btn-primary">Thêm mới</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>