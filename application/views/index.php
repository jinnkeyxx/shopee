<div class="container py-5">
    <div class="row ">
        <div class="col-12 py-5">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                        data-whatever="@mdo">Đăng kí vào</button>

                    <h4>upload list user </h4>
                    <?= form_open_multipart('exportimport/uploaddata') ?>
                    <div class="form-row">
                        <div class="col-4">
                            <input type="file" class="form-control-file" id="importexcel" name="importexcel"
                                accept=".xlsx,.xls">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Import</button>
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
                    <form method="post" id="update_form" action="exportimport/update">
                        <div align="left">
                            <input type="submit" name="multiple_update" id="multiple_update" class="btn btn-info"
                                value="Multiple Update" />
                            <a class="btn-success btn" href="exportimport/excel">tai xuong danh sach </a>
                            <input type="button" class="btn btn-danger" name="bulk_delete_submit" value="DELETE"
                                id="bulk_delete_submit" />
                        </div>

                        <div class="table-responsive">
                            <table id="datatable"
                                class="table table-bordered table-hover table-checkable dt-responsive nowrap table-striped"
                                style="margin-top: 13px !important">
                                <thead>
                                    <tr role="row">
                                        <th>STT</th>
                                        <th>ảnh</th>
                                        <th>Họ và Tên</th>
                                        <th>team</th>
                                        <th>phone</th>
                                        <th>Serial1</th>
                                        <th>laptop</th>
                                        <th>Serial2</th>
                                        <th>orther</th>
                                        <th>Serial3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user as $value):?>
                                    <tr id="table_<?= $value['id']; ?>">

                                        <td><input type="checkbox" id="<?= $value['id'] ?>" class="check_box"
                                                data-images="<?= $value['images']; ?>"
                                                data-fullname="<?= $value['fullname'];?>"
                                                data-team="<?= $value['team']; ?>"
                                                data-serial1="<?= $value['serial']; ?>"
                                                data-phone="<?= $value['phone']; ?>"
                                                data-laptop="<?= $value['laptop'] ?>"
                                                data-serial2="<?= $value['serial2'] ?>"
                                                data-orther="<?= $value['orther']; ?>"
                                                data-serial3="<?= $value['serial3'] ?>"> </td>
                                        <td>
                                            <div class="media" style="margin-top:-10px">
                                                <div class="avatar">
                                                    <img class="w-circle-icon rounded-circle mt-1 ml-2 mr-3"
                                                        style="margin-left:-10px;width:50px;height:50px"
                                                        src="<?= $value['images']; ?>">
                                                </div>
                                            </div>
                                            <!-- /./ -->
                                        </td>
                                        <td>
                                            <?= $value['fullname']; ?>
                                            <!-- /./ -->
                                        </td>
                                        <td><?= $value['team']; ?></td>
                                        <td><?= $value['phone']; ?></td>
                                        <td><?= $value['serial']; ?></td>
                                        <td><?= $value['laptop']; ?></td>
                                        <td><?= $value['serial2']; ?></td>
                                        <td><?= $value['orther']; ?></td>
                                        <td><?= $value['serial3']; ?></td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('exportimport/add') ?>
                    <div class="form-group">
                        <label for="fullname" class="col-form-label">Họ Tên:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname">
                    </div>
                    <div class="form-group">
                        <label for="Team" class="col-form-label">Team</label>
                        <select class="form-control" name="team">
                            <option value="Inbound"> Inbound</option>
                            <option value="Inventory"> Inventory</option>
                            <option value="Outbound"> Outbound</option>
                            <option value="Return"> Return</option>
                            <option value="khác"> khác</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">phone</label>
                        <input type="checkbox" id="phone" name="phone">
                        <input type="text" class="form-control d-none" id="serial1" name="serial1">
                    </div>
                    <div class="form-group">
                        <label for="laptop" class="col-form-label">laptop</label>
                        <input type="checkbox" id="laptop" name="laptop">
                        <input type="text" class="form-control d-none" id="serial2" name="serial2">
                    </div>
                    <div class="form-group">
                        <label for="orther" class="col-form-label">orther</label>
                        <input type="checkbox" id="orther" name="orther">
                        <input type="text" class="form-control d-none" id="serial3" name="serial3">
                    </div>
                    <div class="form-group">
                        <label for="images" class="col-form-label">images</label>

                        <input type="file" class="form-control" id="images" name="img">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class=" btn btn-primary">Send message</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>