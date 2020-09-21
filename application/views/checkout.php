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
        <div style="margin-top: 100px !important">
            <a href="userlist" class="btn btn-success"><i class="fas fa-arrow-left"></i> Check In</a>
            <br>
        </div>
        <h1 align="center" style="color: #fff">Check Out User</h1><br />

        <div class="form-group">
            <div class="input-group">
                <form action="" id="checkout" method="post">
                    <input type="text" name="search_text" id="search_text" placeholder="Search Users by Serial Number"
                        class="form-control" />
                    <input type="submit">
                </form>
            </div>
        </div>
        <br />
        <div id="result"></div>
    </div>
    <div style="clear:both"></div>
    <br />
    <br />
    <br />
    <br />