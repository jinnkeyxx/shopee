<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
        <h1 align="center" style="color: #fff; margin-top: 100px !important">Check Out User</h1><br />

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">
                            <form action="" id="checkout" method="post">
                                <input type="text" name="search_text" id="search_text" placeholder="Search Users by Serial Number" class="form-control" style="width: 300px; height: 50px" />

                                <br>
                                <button type="submit" class="btn btn-info"> Tìm kiếm </button>
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
    <br />
    <br />
    <br />
    <br />