$(document).ready(() => {
    toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        // toastr["success"]("My name is Inigo Montoya. You killed my father. Prepare to die!")
    function load(time) {
        setTimeout(() => {
            window.location.reload();
        }, time)
    }

    $('form#form-install').submit((e) => {
        e.preventDefault()
        let fullname = $('#fullname')
        let username = $('#username')
        let email = $('#email')
        let password = $('#password')
        let rp_password = $('#rp_password')
        if (username.val() == "" || fullname.val() == "" || email.val() == "" || password.val() == "" || rp_password.val() == "") {
            toastr["error"]("Còn thiếu gì đó!")
        } else {
            if (password.val() !== rp_password.val()) {
                toastr["error"]("Mật khâu không trùng nhau!")
            } else {
                $.ajax({
                    url: 'Admin/setup',
                    type: 'post',
                    data: {
                        fullname: fullname.val(),
                        username: username.val(),
                        email: email.val(),
                        password: password.val()
                    },
                    dataType: 'json',
                    beoForeSend: () => {

                    },
                    success: (reps) => {

                        toastr["success"]('Đăng nhập thành công vui lòng đợi 2s');
                        load(2000)
                    }
                })
            }
        }
    })
    $('form#login').submit((e) => {
        e.preventDefault()
        let username = $('#username')
        let password = $('#password')

        if (username.val() == "" || password.val() == "") {
            toastr["error"]("Còn thiếu gì đó!")
        } else {
            $.ajax({
                url: 'Admin/api',
                type: 'post',
                data: {
                    username: username.val(),

                    password: password.val()
                },
                dataType: 'json',
                beoForeSend: () => {

                },
                success: (res) => {
                    if (res.status == true) {
                        toastr["success"](res.messages)
                        load(2000)
                    } else {
                        toastr["error"](res.messages)

                    }
                }
            })
        }


    })
    $(document).on('click', '.check_box', function() {
        var html = '';
        var laptop = $(this).data('laptop')
        var phone = $(this).data('phone')
        var team = $(this).data('team')
            // alert(phone)
        if (this.checked) {
            html = '<td><input type="checkbox" id="' + $(this).attr('id') + '" data-fullname="' + $(this).data('fullname') + '" data-manv="' + $(this).data('manv') + '" data-team="' + $(this).data('team') + '" data-phone="' + $(this).data('phone') + '" data-model_phone="' + $(this).data('model_phone') + '" data-serial1="' + $(this).data('serial1') + '" data-laptop="' + $(this).data('laptop') + '" data-model_laptop="' + $(this).data('model_laptop') + '" data-laptop="' + $(this).data('laptop') + '" data-serial2="' + $(this).data('serial2') + '" data-orther="' + $(this).data('orther') + '" data-serial3="' + $(this).data('serial3') + '" data-images="' + $(this).data('images') + '" class="check_box" checked />  </td>';

            html += '<td><input type="text" name="fullname[]" class="form-control" value="' + $(this).data("fullname") + '" /></td>';
            html += '<td><input type="text" name="manv[]" class="form-control" value="' + $(this).data("manv") + '" /></td>';
            if (team == 'Inventory') {
                html += '<td><select  name="team[]" class="form-control"><option value="Inventory" >Inventory</option> <option value="Inbound" >Inbound</option> <option value="Outbound" >Outbound</option> <option value="Return" >Return</option> </select></td>';

            } else if (team == 'Inbound') {
                html += '<td><select  name="team[]" class="form-control"> <option value="Inbound" >Inbound</option> <option value="Inventory" >Inventory</option> <option value="Outbound" >Outbound</option> <option value="Return" >Return</option> </select></td>';

            } else if (team == 'Outbound') {
                html += '<td><select  name="team[]" class="form-control"> <option value="Outbound" >Outbound</option> <option value="Inbound" >Inbound</option> <option value="Inventory" >Inventory</option>  <option value="Return" >Return</option> </select></td>';

            } else if (team == 'Return') {
                html += '<td><select  name="team[]" class="form-control">  <option value="Return" >Return</option> <option value="Outbound" >Outbound</option> <option value="Inbound" >Inbound</option> <option value="Inventory" >Inventory</option>  </select></td>';

            } else {
                html += '<td><select  name="team[]" class="form-control"> <option value="Khác">Khác </option> <option value="Return" >Return</option> <option value="Outbound" >Outbound</option> <option value="Inbound" >Inbound</option> <option value="Inventory" >Inventory</option>  </select></td>';

            }
            if (phone == 'Yes') {
                html += '<td><select name="phone[]" class="form-control"> <option value="Yes" >Yes</option><option value="No"> No </option></select></td>';

            } else if (phone == 'No') {
                html += '<td><select name="phone[]" class="form-control"> <option value="No" >No</option><option value="Yes"> Yes </option></select></td>';

            }
            html += '<td><input type="text" name="model_phone[]" class="form-control" value="' + $(this).data("model_phone") + '" /></td>';
            html += '<td><input type="text" name="serial1[]" class="form-control" value="' + $(this).data("serial1") + '" /></td>';
            if (laptop == 'Yes') {
                html += '<td><select name="laptop[]" class="form-control"> <option value="Yes" >Yes</option><option value="No"> No </option></select></td>';
            } else {
                html += '<td><select name="laptop[]" class="form-control"> <option value="No" >No</option><option value="Yes"> Yes </option></select></td>';
            }

            html += '<td><input type="text" name="model_laptop[]" class="form-control" value="' + $(this).data("model_laptop") + '" /></td>';
            html += '<td><input type="text" name="serial2[]" class="form-control" value="' + $(this).data("serial2") + '" /></td>';
            html += '<td><input type="text" name="orther[]" class="form-control" value="' + $(this).data("orther") + '" /></td>';

            html += '<td><input type="text" name="serial3[]" class="form-control" value="' + $(this).data("serial3") + '" /><input type="hidden" name="hidden_id[]" value="' + $(this).attr('id') + '" /></td>';
            html += '<td><input type="file" name="image" class="form-control"/></td>';
            html += '<td><input type="hidden" value="' + $(this).data('images') + '" name="image_old[]" class="form-control"/></td>';
            html += '<td><input type="hidden" value="' + $(this).data('user_post') + '" name="user_post[]" class="form-control"/></td>';
        } else {
            html = '<td><input type="checkbox" id="' + $(this).attr('id') + '" data-fullname="' + $(this).data('fullname') + '" data-manv="' + $(this).data('manv') + '" data-images="' + $(this).data('images') + '" data-team="' + $(this).data('team') + '" data-phone="' + $(this).data('phone') + '" data-model_phone="' + $(this).data('model_phone') + '" data-serial1="' + $(this).data('serial1') + '" data-laptop="' + $(this).data('laptop') + '" data-model_laptop="' + $(this).data('model_laptop') + '" data-serial2="' + $(this).data('serial2') + '" data-orther="' + $(this).data('orther') + '" data-serial3="' + $(this).data('serial3') + '" class="check_box" /></td>';
            html += '<td>' + $(this).data('fullname') + '</td>';
            html += '<td>' + $(this).data('manv') + '</td>';
            html += '<td>' + $(this).data('team') + '</td>';
            html += '<td>' + $(this).data('phone') + '</td>';
            html += '<td>' + $(this).data('model_phone') + '</td>';
            html += '<td>' + $(this).data('serial1') + '</td>';
            html += '<td>' + $(this).data('laptop') + '</td>';
            html += '<td>' + $(this).data('model_laptop') + '</td>';
            html += '<td>' + $(this).data('serial2') + '</td>';
            html += '<td>' + $(this).data('orther') + '</td>';
            html += '<td>' + $(this).data('serial3') + '</td>';
            html += '<td> <img class="mt-1 ml-2 mr-3" style="margin-left:0px;width:80px;height:80px" src=' + $(this).data('images') + '></td>';
        }
        $(this).closest('tr').html(html);

    });
    $(document).on('click', '.check_box_user', function() {
        var html = '';
        var role = "";
        if ($(this).data('role') == "1") {
            role = "MOD";
        } else {
            role = "ADMIN";
        }
        if (this.checked) {
            html = '<td><input type="checkbox" id="' + $(this).attr('id') + '" data-fullname="' + $(this).data('fullname') + '" data-email="' + $(this).data('email') + '" data-username="' + $(this).data('username') + '" data-password="' + $(this).data('password') + '" data-role="' + $(this).data('role') + '" data-images="' + $(this).data('images') + '" class="check_box_user" checked /></td>';
            html += '<td><input type="text" name="fullname[]" class="form-control" value="' + $(this).data("fullname") + '" /></td>';
            html += '<td><input type="email" name="email[]" class="form-control" value="' + $(this).data("email") + '" /></td>';
            html += '<td><input type="text" name="username[]" class="form-control" value="' + $(this).data("username") + '" /></td>';
            html += '<td><input type="text" name="password[]" class="form-control" value="' + $(this).data("password") + '" /></td>';
            if (role == 'ADMIN' || role == 'Admin') {
                html += '<td><select name="role[]" class="form-control"> <option value="0"> Admin  </option> <option value="1"> Mod</option> </select><input type="hidden" name="hidden_id[]" value="' + $(this).attr('id') + '" /></td>';

            } else {
                html += '<td><select name="role[]" class="form-control"> <option value="1"> MOD  </option> <option value="0"> Admin</option> </select><input type="hidden" name="hidden_id[]" value="' + $(this).attr('id') + '" /></td>';

            }
            html += '<td><input type="file" name="image" class="form-control"/></td>';
            html += '<td><input type="hidden" value="' + $(this).data('images') + '" name="image_old[]" class="form-control"/></td>';

        } else {
            html = '<td><input type="checkbox" id="' + $(this).attr('id') + '" data-fullname="' + $(this).data('fullname') + '" data-email="' + $(this).data('email') + '" data-username="' + $(this).data('username') + '" data-password="' + $(this).data('password') + '" data-role="' + $(this).data('role') + '" data-images="' + $(this).data('images') + '" class="check_box_user" /></td>';
            html += '<td>' + $(this).data('fullname') + '</td>';
            html += '<td>' + $(this).data('email') + '</td>';

            html += '<td>' + $(this).data('username') + '</td>';
            html += '<td>' + $(this).data('password') + '</td>';
            html += '<td>' + role + '</td>';
            html += '<td> <img class="mt-1 ml-2 mr-3 img-fluid" style="margin-left:0px;width:80px;height:80px" src=' + $(this).data('images') + '></td>';
        }
        $(this).closest('tr').html(html);

    });


    // alert('the form was successfully processed');

    $('#bulk_delete_submit').click(() => {
        if ($('.check_box:checked').length > 0) {
            Swal.fire({
                title: 'Bạn có thực sự muốn xóa?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Xóa`,

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'userlist/delete',
                        method: "POST",
                        data: $('#update_form').serialize(),
                        success: function(data) {

                            toastr["success"]('Xóa thành công');
                            load(1000)
                        }

                    })
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })

        } else {
            toastr["error"]('Không có danh sách được chọn');
        }
    });
    $('#dele_user').click(() => {
        if ($('.check_box_user:checked').length > 0) {
            Swal.fire({
                title: 'Bạn có thực sự muốn xóa?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Xóa`,

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'userlist/delete_user',
                        method: "POST",
                        data: $('#update_user').serialize(),
                        success: function(data) {

                            toastr["success"]('Xóa thành công');
                            load(1000)
                        }

                    })
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        } else {
            toastr["error"]('Không có danh sách được chọn');
        }
    });

    var count = 0;
    var count1 = 0;
    $('#phone').click(() => {
        count++;
        if (count % 2 !== 0) {
            $('input#serial1').removeClass('d-none')
            $('input#serial1').css('display', 'block');
            $('input#model_phone').removeClass('d-none')
            $('input#model_phone').css('display', 'block');


        } else {
            $('input#serial1').css('display', 'none');
            $('input#model_phone').css('display', 'none');
        }


    });
    $('#laptop').click(() => {
        count1++;
        if (count1 % 2 !== 0) {
            $('input#serial2').removeClass('d-none')
            $('input#serial2').css('display', 'block');
            $('input#model_laptop').removeClass('d-none')
            $('input#model_laptop').css('display', 'block');

        } else {
            $('input#serial2').css('display', 'none');
            $('input#model_laptop').css('display', 'none');
        }

    });
    $('#orther').keyup(() => {
        let text = $('#orther').val()
        if (text == "") {
            $("#serial3").prop("disabled", true);
            $('#serial3').val('');

        } else {
            $('#serial3').removeAttr('disabled');
        }
    });

    $(document).on('click', '#select_all', function() {
        $('.check_box').click();
        $('.check_box').prop('checked');

    })
})
$('#checkout').submit(function(e) {
    e.preventDefault()
    var search = $('#search_text').val();
    if (search != '') {
        $.ajax({
            url: "Checkout/fetch",
            dataType: 'json',
            method: "POST",
            data: {
                query: search
            },
            success: function(data) {
                $('#result').html(data);
                $('#search_text').val('');
                if (data.status == false) {

                    swall('Không tìm thấy Serial#', 'error')
                    $('#result').html(`<img src="assets/images/loader3.gif" style="width: 100%"/>`);
                } else {

                    // console.log(data.output)
                    for (var key in data.output) {
                        var serial = "";
                        var serial2 = "";
                        var orther = "";
                        var serial3 = "";
                        var team = "";

                        var value = data.output[key];
                        // swall('Đã tìm thấy Serial#', 'success')
                        // console.log(value['phone'])

                        if (value['team'] !== "") {
                            team = value['team'] + " Team";
                        } else {
                            team = '';
                        }
                        if (value['phone'] === "Yes") {
                            serial = value['serial'];
                            // $flag = 'true';
                        } else {
                            serial = '';
                        }
                        if (value['laptop'] === "Yes") {
                            serial2 = value['serial2'];
                            // $flag = 'true';
                        } else {
                            serial2 = '';
                        }
                        if (value['orther'] !== "") {
                            // orther = value['orther'];
                            serial3 = value['serial3'];
                            // $flag = 'true';
                        } else {
                            orther = '';
                            serial3 = "";
                        }

                        $('#result').html(`<img src="${value['images']}" class="" style="width: 90%"/>
                        <h2>${value['fullname']}</h2>
                        <h2>${team}</h2>
                        <br>
                        <h2>Điện thoại: ${serial}</h2>
                        <h2>Laptop: ${serial2}</h2>
                        <h2>Khác: ${serial3}</h2>
                        `);
                    }
                }
            }
        })
    } else {
        $('#result').html(`<img src="assets/images/loader2.gif" style="width: 100%"/>`);
    }

    function swall(text, icon) {
        return Swal.fire(
            'Thông báo!',
            text,
            icon
        )

    }
});