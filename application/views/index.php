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
                    <h1 class="otto">QUẢN LÝ NHÂN VIÊN CHECKIN</h1>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fas fa-user-plus"></i> ĐĂNG KÝ VÀO</button>
                    <!-- <a type="button" class="btn btn-success" href="checkout"><i class="fas fa-user-plus"></i> ĐĂNG KÝ
                        RA</a> -->

                    <!-- <?php if($admin->role == 0){?>
                    <a class="btn-primary btn" href="approvelistuser"><i class="fas fa-download"></i> QUẢN LÝ TÀI KHOẢN
                    </a>
                    <?php } ?> -->

                    <!-- <button name="select_all" id="select_all" class="btn btn-info"><i class="fas fa-edit"></i>chon
                        tat
                        ca</button> -->
                    <hr>
                    <h4>Tải lên danh sách người dùng</h4>

                    <?= form_open_multipart('userlist/uploaddata') ?>
                        <div class="form-row">
                            <div class="col-4">
                                <input type="file" class="form-control-file" id="importexcel" name="importexcel" accept=".xlsx,.xls" required>
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
                    <form method="post" id="update_form" action="userlist/aprove" enctype='multipart/form-data'>


                        <div align="left">
                            <?php if($admin->role == 0){?>
                            <button type="submit" name="multiple_update" id="multiple_update" class="btn btn-info"><i
                                    class="fas fa-edit"></i> Cập nhật</button>

                            <button type="button" class="btn btn-danger" name="bulk_delete_submit" id="bulk_delete_submit"><i class="fas fa-trash"></i> Xóa</button>

                            <button type="button" class="btn btn-danger" name="deleteAll" id="deleteAll"><i
                                class="fas fa-trash"></i> Xóa tất cả</button>

                            <?php } ?>

                            <?php if($admin->role == 0){?>
                            <a class="btn-warning btn" href="userlist/excel"><i class="fas fa-download"></i> Tải danh
                                sách xuống </a>

                            <a class="btn-primary btn" href="userlistapprove"><i class="fas fa-download"></i> Danh sách
                                chờ duyệt <span class="text-danger"><?= $aproveAll;  ?></span>
                            </a>
                            <?php } else {?>
                            <a class="btn-primary btn" href="userpost"><i class="fas fa-download"></i> Danh sách chờ
                                duyệt của bạn <span class="text-danger"><?= $aprove;  ?></span> </a>
                            <a class="btn-primary btn" href="userpostapprove"><i class="fas fa-download"></i> Danh sách
                                đã duyệt của bạn </a>
                            <?php } ?>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-checkable nowrap" style="margin-top: 13px !important">
                                <thead>
                                    <tr role="row">
                                        <th>STT
                                            <input type="checkbox" value="" class="selectall" />
                                        </th>

                                        <th>Họ và Tên</th>
                                        <th>Mã Nhân viên</th>
                                        <th>Team</th>
                                        <th>Điện thoại</th>
                                        <th>Model điện thoại</th>
                                        <th>Serial#1</th>
                                        <th>Laptop</th>
                                        <th>Model laptop</th>
                                        <th>Serial#2</th>
                                        <th>Khác</th>
                                        <th>Serial#3</th>
                                        <th>Hình ảnh</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1; foreach ($user as $value):?>
                                    <?php if($value['status'] == 0){?>
                                    <?php if($admin->role == 0){ ?>
                                    <tr id="table_<?= $value['id']; ?>" class="sorting_">
                                        <td>
                                            <input type="checkbox" id="<?= $value['id'] ?>" class="check_box" data-fullname="<?= $value['fullname'];?>" data-manv="<?= $value['manv']; ?>" data-team="<?= $value['team']; ?>" data-serial1="<?= $value['serial']; ?>" data-phone="<?= $value['phone']; ?>"
                                                data-model_phone="<?= $value['model_phone']; ?>" data-model_laptop="<?= $value['model_laptop']; ?>" data-laptop="<?= $value['laptop'] ?>" data-serial2="<?= $value['serial2'] ?>" data-orther="<?= $value['orther']; ?>"
                                                data-serial3="<?= $value['serial3'] ?>" data-images="<?= $value['images']; ?>" data-image_old="<?= $value['images']; ?>" data-user_post="<?= $value['user_post']; ?>" />
                                            <?= $i++; ?>

                                        </td>

                                        <?php } else { ?>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <?php } ?>

                                        <td>
                                            <?= $value['fullname']; ?>
                                        </td>
                                        <td>
                                            <?= $value['manv']; ?>
                                        </td>
                                        <td>
                                            <?= $value['team']; ?>
                                        </td>
                                        <td>
                                            <?= $value['phone']; ?>
                                        </td>
                                        <td>
                                            <?= $value['model_phone']; ?>
                                        </td>
                                        <td>
                                            <?= $value['serial']; ?>
                                        </td>
                                        <td>
                                            <?= $value['laptop']; ?>
                                        </td>
                                        <td>
                                            <?= $value['model_laptop']; ?>
                                        </td>
                                        <td>
                                            <?= $value['serial2']; ?>
                                        </td>
                                        <td>
                                            <?= $value['orther']; ?>
                                        </td>
                                        <td>
                                            <?= $value['serial3']; ?>
                                        </td>
                                        <td>
                                            <div class=" media" style="margin-top:-10px">
                                                <div class="avatar">
                                                    <img class="mt-1 ml-2 mr-3" style="margin-left:0px;width:80px;height:80px" src="<?= $value['images']; ?>">
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label for="manv" class="col-form-label">Mã nhân viên</label>

                            <input type="text" class="form-control " id="manv" name="manv" placeholder="Mã nhân viên" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname" class="col-form-label">Họ Tên:</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required placeholder="Họ Tên">
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
                            <input type="text" class="form-control my-1 d-none" id="model_phone" name="model_phone" placeholder="Model Phone">
                            <input type="text" class="form-control my-1 d-none" id="serial1" name="serial1" placeholder="Serial# Phone">
                        </div>
                        <div class="form-group">
                            <label for="laptop" class="col-form-label">Laptop</label>
                            <input type="checkbox" id="laptop" name="laptop">
                            <input type="text" class="form-control my-1 d-none" id="model_laptop" name="model_laptop" placeholder="Model Laptop">
                            <input type="text" class="form-control my-1 d-none" id="serial2" name="serial2" placeholder="Serial# Laptop">
                        </div>
                        <div class="form-group">
                            <label for="orther" class="col-form-label">Khác</label>
                            <input type="text" id="orther" name="orther" class="form-control" placeholder="Thiết bị khác">

                        </div>
                        <div class="form-group">
                            <label for="serial3" class="col-form-label">Serial# Khác</label>

                            <input type="text" class="form-control " disabled id="serial3" name="serial3" placeholder="Serial# Khác">
                        </div>

                        <div class="form-group">
                            <label for="images" class="col-form-label">Hình ảnh</label>

                            <input type="file" class="form-control" id="images" name="img" required>
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