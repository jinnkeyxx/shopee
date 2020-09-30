<style>
table.table.table-bordered.table-hover.table-checkable.dt-responsive.nowrap {
    color: #fff;
}

tr th {
    background-color: #fff;
    color: blue;
    font-size: 14pt;
    text-align: center;
    vertical-align: middle;
}

tr td {
    color: black;
}
</style>

<body>
    <div class="container">
        <!-- <div style="margin-top: 100px !important">
            <a href="userlist" class="btn btn-success"><i class="fas fa-arrow-left"></i> Check In</a>
            <br>
        </div> -->
        <h1 align="center" style="color: #fff; margin-top: 70px !important;font-size:36pt ;text-shadow: 0 1px 0 #ccc, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9,
    0 5px 0 #aaa, 0 6px 1px rgba(0, 0, 0, 0.1), 0 0 5px rgba(0, 0, 0, 0.1),
    0 1px 3px rgba(0, 0, 0, 0.3), 0 3px 5px rgba(0, 0, 0, 0.2),
    0 5px 10px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.2),
    0 20px 20px rgba(0, 0, 0, 0.15);">Check Out User</h1>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">
                            <form action="" id="checkout" method="post">
                                <input type="text" name="search_text" id="search_text"
                                    placeholder="Tìm kiếm theo Serial Number" class="form-control"
                                    style="width: 300px; height: 50px" autofocus />

                                <br>
                                <button type="submit" class="btn btn-primary"> Tìm kiếm </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="result" style="text-align: center;background-color: #fff; padding: 10px;">
                        <img src="assets/images/loader2.gif" style="width: 100%" />
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div style="clear:both"></div>