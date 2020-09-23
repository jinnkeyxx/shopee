<style>
.card-box {
    text-align: center;
    padding: 10px;
    padding-top: 20px;
    margin-bottom: 20px !important;
}

.header-title {
    font-size: 1.3rem;
    /* margin: 0 0 7px 0; */
}
</style>

<body>
    <div class="container">

        <h1 align="center" style="color: #fff; margin-top: 90px !important;font-size:26pt ;text-shadow: 0 1px 0 #ccc, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9,
    0 5px 0 #aaa, 0 6px 1px rgba(0, 0, 0, 0.1), 0 0 5px rgba(0, 0, 0, 0.1),
    0 1px 3px rgba(0, 0, 0, 0.3), 0 3px 5px rgba(0, 0, 0, 0.2),
    0 5px 10px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.2),
    0 15px 15px rgba(0, 0, 0, 0.15);">HỆ THỐNG QUẢN LÝ THÔNG TIN NHÂN VIÊN RA VÀO</h1>

        <div class="col-md-12" style="margin-top: 50px;" class="text-center">
            <div class="row ">

                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="userlist">
                            <h2 class="header-title mt-0 mb-2">ĐĂNG KÝ VÀO</h2>
                            <div class="">
                                <img src="assets\images\shopee-logo.png" alt="" style="width: 100px;">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="checkout">
                            <h2 class="header-title mt-0 mb-2">ĐĂNG KÝ RA</h2>
                            <div class="">
                                <img src="assets\images\shopee-logo.png" alt="" style="width: 100px;">
                            </div>
                        </a>
                    </div>
                </div>
                <?php if($admin->role == 0){ ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="approvelistuser">
                            <h2 class="header-title mt-0 mb-2">QUẢN LÝ NHÂN VIÊN</h2>
                            <div class="">
                                <img src="assets\images\shopee-logo.png" alt="" style="width: 100px;">
                            </div>
                        </a>
                    </div>
                </div>

                <?php } ?>
            </div>
        </div>

    </div>
    <div style="clear:both"></div>