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
                        if (reps.status != true) {
                            toastr["error"]('Đăng nhập thất bại')
                            
                        } else {
                            toastr["success"]('Đăng nhập thành công vui lòng đợi 2s');
                            load(2000)
                        }
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
        if (this.checked) {
            html = '<td><input type="checkbox" id="' + $(this).attr('id') + '" data-images="' + $(this).data('images') + '" data-fullname="' + $(this).data('fullname') + '" data-team="' + $(this).data('team') + '" data-phone="' + $(this).data('phone') + '" data-serial1="' + $(this).data('serial1') + '" data-laptop="' + $(this).data('laptop') + '" data-serial2="' + $(this).data('orther') + '" data-serial3="' + $(this).data('serial3') + '" class="check_box" checked /></td>';
            html += '<td><input type="text" name="images[]" class="form-control" value="' + $(this).data("images") + '" /></td>';
            html += '<td><input type="text" name="fullname[]" class="form-control" value="' + $(this).data("fullname") + '" /></td>';
            html += '<td><input type="text" name="team[]" class="form-control" value="' + $(this).data("team") + '" /></td>';
            html += '<td><input type="text" name="phone[]" class="form-control" value="' + $(this).data("phone") + '" /></td>';

            html += '<td><input type="text" name="serial1[]" class="form-control" value="' + $(this).data("serial1") + '" /></td>';
            html += '<td><input type="text" name="laptop[]" class="form-control" value="' + $(this).data("laptop") + '" /></td>';
            html += '<td><input type="text" name="serial2[]" class="form-control" value="' + $(this).data("serial2") + '" /></td>';
            html += '<td><input type="text" name="orther[]" class="form-control" value="' + $(this).data("orther") + '" /></td>';

            html += '<td><input type="text" name="serial3[]" class="form-control" value="' + $(this).data("serial3") + '" /><input type="hidden" name="hidden_id[]" value="' + $(this).attr('id') + '" /></td>';
        } else {
            html = '<td><input type="checkbox" id="' + $(this).attr('id') + '" data-images="' + $(this).data('images') + '" data-fullname="' + $(this).data('fullname') + '" data-team="' + $(this).data('team') + '" data-phone="' + $(this).data('phone') + '" data-serial1="' + $(this).data('serial1') + '" data-laptop="' + $(this).data('laptop') + '" class="check_box" /></td>';
            html += '<td>' + $(this).data('images') + '</td>';
            html += '<td>' + $(this).data('fullname') + '</td>';
            html += '<td>' + $(this).data('team') + '</td>';
            html += '<td>' + $(this).data('phone') + '</td>';
            html += '<td>' + $(this).data('serial1') + '</td>';
            html += '<td>' + $(this).data('laptop') + '</td>';
            html += '<td>' + $(this).data('serial2') + '</td>';
            html += '<td>' + $(this).data('orther') + '</td>';
            html += '<td>' + $(this).data('serial3') + '</td>';
        }
        $(this).closest('tr').html(html);

    });

    $('#update_form').on('submit', function(event) {
        event.preventDefault();
        if ($('.check_box:checked').length > 0) {
            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: $(this).serialize(),
                success: function(data) {
                    toastr["success"]('Thay đổi thành công');
                    load(2000)

                }
            })
        }
        else {
            toastr["error"]('Không có danh sách được chọn');
        }
    });
    $('#bulk_delete_submit').click(() => {
        if ($('.check_box:checked').length > 0) {
            $.ajax({
                url: 'userlist/delete',
                method: "POST",
                data: $('#update_form').serialize(),
                success: function(data) {
                   
                        toastr["success"]('Xóa thành công');
                        load(2000)
                }

            })
        }
        else {
            toastr["error"]('Không có danh sách được chọn');
        }
    })
    $('#add').on('submit', function(event) {
        event.preventDefault();

      

    });
    var count = 0;
    $('#phone').click(() => {
        count = 1
        if (count == 1) {
            $('input#serial1').removeClass('d-none')
            $('input#serial1').css('display', 'block');
            count = 2
        } else {
            $('input#serial1').css('display', 'none');
        }

    })
    $('#laptop').click(() => {
        count = 1
        if (count == 1) {
            $('input#serial2').removeClass('d-none')
            $('input#serial2').css('display', 'block');
            count = 2
        } else {
            $('input#serial2').css('display', 'none');
        }
        // count = 0;
    })
    $('#orther').click(() => {
        count = 1
        if (count == 1) {
            $('input#serial3').removeClass('d-none')
            $('input#serial3').css('display', 'block');
            count = 2
        } else {
            $('input#serial3').css('display', 'none');
        }
        // count = 0;
    })
    $('#search').submit((e) => {
        e.preventDefault()
        keyword =  $('#inputsearch')
        if(keyword.val() == ""){
            toastr["error"]('moi nhap keyword');
        }
        else {
            $.ajax({
                url: 'userlist/serach',
                method: "POST",
                data: {keyword : keyword.val()},
                success: function(data) {
                   
                }

            })
        }
    })
  
})