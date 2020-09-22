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
                <div class="card-body" style="padding-top: 0.2rem; padding-bottom: 0.2rem;">
                    <h1 class="otto">QUẢN LÝ TÀI KHOẢN NGƯỜI DÙNG</h1>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <form method="post" id="update_user" action="userlist/update_user" enctype='multipart/form-data'>
                        <div align="left">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                        data-whatever="@mdo"><i class="fas fa-user-plus"></i> Thêm Tài khoản</button>

                            <button type="submit" name="multiple_update" id="multiple_update" class="btn btn-info"><i
                                    class="fas fa-edit"></i> Cập nhật </button>

                            <button type="button" class="btn btn-danger" name="bulk_delete_submit" id="dele_user"><i
                                    class="fas fa-trash"></i> Xóa</button>

                            <!-- <a class="btn-warning btn" href="userlist/excel"><i class="fas fa-download"></i> Tải danh
                                sách xuống </a> -->

                            <!-- <?php if($admin->role == 0){?>

                            <a class="btn-primary btn" href="userlistapprove"><i class="fas fa-download"></i> Danh sách chờ duyệt
                            </a>
                            <?php } ?> -->
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-checkable nowrap"
                                style="margin-top: 13px !important">
                                <thead>
                                    <tr role="row">
                                        <th>STT</th>
                                        <th>Họ và Tên</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Chức vụ</th>
                                        <th>Ảnh đại diện</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach ($user as $value):?>
                                    <tr id="table_<?= $value['id']; ?>" class="sorting_">
                                        <td><input type="checkbox" id="<?= $value['id'] ?>" class="check_box_user"
                                                data-fullname="<?= $value['fullname'];?>"
                                                data-email="<?= $value['email']; ?>"
                                                data-username="<?= $value['username']; ?>"
                                                data-password="<?= $value['password']; ?>"
                                                data-role="<?= $value['role']; ?>"
                                                data-images="<?= $value['image']; ?>">
                                            <?= $i++; ?>
                                        </td>

                                        <td><?= $value['fullname']; ?></td>
                                        <td><?= $value['email']; ?></td>
                                        <td><?= $value['username']; ?></td>
                                        <td><?= $value['password']; ?></td>
                                        <td>
                                            <?php if($value['role'] == 0)
                                                {
                                                    echo "Admin";
                                                }
                                                else {
                                                    echo "Nhân viên";
                                                } 
                                            ?>
                                        </td>


                                        <td>
                                            <div class="media" style="margin-top:-10px">
                                                <div class="avatar">
                                                    <img class="mt-1 ml-2 mr-3"
                                                        style="margin-left:0px;width:80px;height:80px"
                                                        src="<?= $value['image']; ?>">
                                                </div>
                                            </div>
                                            <!-- /./ -->
                                        </td>
                                    </tr>
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
                    <?= form_open_multipart('userlist/adduser') ?>
                    <div class="form-group">
                        <label for="fullname" class="col-form-label">Họ Tên:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>

                        <input type="text" class="form-control " id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Tên tài khoản</label>

                        <input type="text" class="form-control " id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Mật Khẩu</label>

                        <input type="text" class="form-control " id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-form-label">Chức Vụ</label>
                        <select class="form-control" name="role">
                            <option value="0">Admin</option>
                            <option value="1">Mod</option>
                        </select>
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