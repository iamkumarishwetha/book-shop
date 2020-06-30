$.noConflict();
jQuery(document).ready(function ($) {
    "use strict";
    [].slice.call(document.querySelectorAll('select.cs-select')).forEach(function (el) {
        new SelectFx(el);
    });
    jQuery('.selectpicker').selectpicker;
    $('.search-trigger').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.search-trigger').parent('.header-left').addClass('open');
    });
    $('.search-close').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.search-trigger').parent('.header-left').removeClass('open');
    });
    $('.equal-height').matchHeight({
        property: 'max-height'
    });
    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 3000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
    $('#menuToggle').on('click', function (event) {
        var windowWidth = $(window).width();
        if (windowWidth < 1010) {
            $('body').removeClass('open');
            if (windowWidth < 760) {
                $('#left-panel').slideToggle();
            } else {
                $('#left-panel').toggleClass('open-menu');
            }
        } else {
            $('body').toggleClass('open');
            $('#left-panel').removeClass('open-menu');
        }
    });
    $(".menu-item-has-children.dropdown").each(function () {
        $(this).on('click', function () {
            var $temp_text = $(this).children('.dropdown-toggle').html();
            $(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>');
        });
    });
    $(window).on("load resize", function (event) {
        var windowWidth = $(window).width();
        if (windowWidth < 1010) {
            $('body').addClass('small-device');
        } else {
            $('body').removeClass('small-device');
        }
    });

    /*login*/
    $("#admin-login-form").on("submit", function (e) {
        e.preventDefault();
        var $flag = true;
        $(this).find(".required").each(function () {
            if ($(this).val() == "") {
                $(this).addClass("error").siblings(".error-message").html($(this).attr("data-name") + " field is required");
                $flag = false;
            }
            else {
                if ($(this).hasClass("error")) {
                    $(this).removeClass("error").siblings(".error-message").html("");
                }
            }

        })
        if ($flag) {
            var data = $("#admin-login-form").serialize() + '&' + encodeURI(e.originalEvent.submitter.name) + "=" + encodeURI(e.originalEvent.submitter.value);
            $.ajax({
                url: '../admin/functions/manage-admin.php',
                type: "POST",
                data: data,
                success: function (response) {
                    var resp = $.parseJSON(response);
                    if (resp.status == 202) {
                        $("#admin-login-form").trigger("reset");
                        window.location.href = window.origin + "/ebook/admin/index.php";
                    } else if (resp.status == 303) {
                        $(".field_error").html('<span class="text-danger">' + resp.message + '</span>');
                    }
                }
            });

        }
        return false;
    })

    /*categories*/
    getCountCategories();
    getCountBooks();
    getCountUsers();
    getCountOrders();
    getCategories();
    getBooks();
    getContactusdata();
    getOrders();
    getUsers();

    function getCountCategories(){
        $.ajax({
            url: '../admin/functions/manage-category.php',
            type: 'POST',
            data: { GET_COUNT_CATEGORY: 1 },
            success: function (response) {
                $("#count-category").text(response);
            }
        })
        return false;
    }
    function getCountBooks() {
        $.ajax({
            url: '../admin/functions/manage-book.php',
            type: 'POST',
            data: { GET_COUNT_BOOK: 1 },
            success: function (response) {
                $("#count-book").text(response);
            }
        })
        return false;
    }
    function getCountUsers() {
        $.ajax({
            url: '../admin/functions/manage-users.php',
            type: 'POST',
            data: { GET_COUNT_USER: 1 },
            success: function (response) {
                $("#count-user").text(response);
            }
        })
        return false;
    }
    function getCountOrders() {
        $.ajax({
            url: '../admin/functions/manage-order.php',
            type: 'POST',
            data: { GET_COUNT_ORDER: 1 },
            success: function (response) {
                $("#count-order").text(response);
            }
        })
        return false;
    }
    function getCategories() {
        $("#category-message").removeClass("alert alert-success").html("");
        $.ajax({
            url: '../admin/functions/manage-category.php',
            type: 'POST',
            data: { GET_CATEGORIES: 1 },
            success: function (response) {
                var resp = $.parseJSON(response);

                var brandHTML = '';
                if (resp.status == 202) {
                    $.each(resp.message, function (index, value) {
                        var statusCSS = value.status == 1 ? 'complete' : 'pending';
                        var statusHTML = value.status == 1 ? 'Active' : 'Deactive';
                        brandHTML += '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + value.id + '</td>' +
                            '<td>' + value.category + '</td>' +
                            '<td><a class="update-status-cat badge badge-' + statusCSS + '" data-status="' + value.status + '" data-id="' + value.id + '">' + statusHTML + '</a>&nbsp;<a class="btn btn-sm btn-info edit-category"  data-id="' + value.id + '"><i class="fas fa-pencil-alt"></i></a>&nbsp;<a  data-id="' + value.id + '" class="btn btn-sm btn-danger delete-category"><i class="fas fa-trash-alt"></i></a></td>' +
                            '</tr>';
                    });
                }
                else if (resp.status == 303) {
                    brandHTML += '<tr>' +
                        '<td colspan="4" class="text-center">' + resp.message + '</td>'
                    '</tr>';

                }


                $("#category_list").html(brandHTML);

            }
        })
        return false;
    }
    $(document.body).on("click", '#add-category', function (e) {
        e.preventDefault();
        $("#category-btn").val("Submit");
        $(".modal-title-category").html("Add Category");
        $("#category-form").trigger("reset");
        $("input#cid[type=hidden]").val('');
        $("#category-form").find(".required").each(function () {
                if ($(this).hasClass("error")) {
                    $(this).removeClass("error").siblings(".error-message").html("");
                }
        })
        $("#category-form-output").removeClass("alert alert-danger").html("");
        $("#category-message").removeClass("alert alert-danger").html("");
    })

    $("#category-form").on("submit", function (e) {
        e.preventDefault();
        var $flag = true;
        $(this).find(".required").each(function () {
            if ($(this).val() == "") {
                $(this).addClass("error").siblings(".error-message").html($(this).attr("data-name") + " field is required");
                $flag = false;
            }
            else {
                if ($(this).hasClass("error")) {
                    $(this).removeClass("error").siblings(".error-message").html("");
                }
            }
        })
        if ($flag) {
            var data = $("#category-form").serialize() + '&' + encodeURI(e.originalEvent.submitter.name) + "=" + encodeURI(e.originalEvent.submitter.value);
            $.ajax({
                url: '../admin/functions/manage-category.php',
                type: "POST",
                data: data,
                success: function (response) {
                    var resp = $.parseJSON(response);
                    if (resp.status == 202) {
                        $("#category-form").trigger("reset");
                        $("input#cid[type=hidden]").val('');
                        $("#category_modal").modal('hide');
                        getCategories();
                        $("#category-message").addClass("alert alert-success").html(resp.message);
                    } else if (resp.status == 303) {
                        $("#category-form-output").addClass("alert alert-danger").html(resp.message);
                    }

                }
            });

        }
        return false;
    })

    $(document.body).on('click', '.edit-category', function (e) {
        e.preventDefault();
        $("#category-message").removeClass("alert alert-success").html("");
        $("#category-btn").val("Update");
        $("modal-title-category").html("Edit Category");
        $("#category-form").find(".required").each(function () {
            if ($(this).hasClass("error")) {
                $(this).removeClass("error").siblings(".error-message").html("");
            }
        })
        $("#category-form").trigger("reset");
        $("input#cid[type=hidden]").val('');
        $("#category-form-output").removeClass("alert alert-danger").html("");

        var id = $(this).attr('data-id');
        $.ajax({
            url: '../admin/functions/manage-category.php',
            type: 'POST',
            data: { GET_CATEGORIES: 1, id: id },
            success: function (response) {
                var resp = $.parseJSON(response);
                if (resp.status == 202) {
                    $('#category').val(resp.message.category);
                    $('#cid').val(resp.message.id);
                    $('#category_modal').modal('show');
                 } else if (resp.status == 303) {
                    $("#category-message").addClass("alert alert-danger").html(resp.message);
                }
            }
        })
        return false;
    });

    $(document.body).on('click', '.delete-category', function (e) {
        $("#category-message").removeClass("alert alert-success").html("");
        e.preventDefault();

        var id = $(this).attr('data-id');

        if (confirm("Are you sure to delete this category")) {
            $.ajax({
                url: '../admin/functions/manage-category.php',
                type: 'POST',
                data: { DELETE_CATEGORY: 1, id: id },
                success: function (response) {
                    var resp = $.parseJSON(response);
                    if (resp.status == 202) {
                        getCategories();
                        $("#category-message").addClass("alert alert-success").html(resp.message);
                    } else if (resp.status == 303) {
                        $("#category-message").addClass("alert alert-danger").html(resp.message);
                    }
                }
            })
        } else {
            alert('Cancelled');
        }
        return false;
    });

    $(document.body).on('click', '.update-status-cat', function () {
        $("#category-message").removeClass("alert alert-success").html("");
        var id = $(this).attr('data-id');
        var varstatus = parseInt($(this).attr("data-status"));
        if (varstatus == 1) {
            status = 0;
        } else {
            status = 1;
        }

        var data = {
            UPDATE_STATUS: 1,
            id: id,
            status: status
        }

        $.ajax({
            url: '../admin/functions/manage-category.php',
            type: 'POST',
            data: data,
            success: function (response) {
                var resp = $.parseJSON(response);
                if (resp.status == 202) {
                    getCategories();
                    $("#category-message").addClass("alert alert-success").html(resp.message);
                 } else if (resp.status == 303) {
                    $("#category-message").addClass("alert alert-danger").html(resp.message);
                }
            }
        })
    });
    /*Book*/
    function getBooks() {
        $("#book-message").removeClass("alert alert-success").html("");
        $.ajax({
            url: '../admin/functions/manage-book.php',
            type: 'POST',
            data: { GET_BOOKS: 1 },
            success: function (response) {
                var resp = $.parseJSON(response);
                var bookHTML = '';
                if (resp['book'].status == 202) {
                    $.each(resp['book'].message, function (index, value) {
                        var statusCSS = value.status == 1 ? 'complete' : 'pending';
                        var statusHTML = value.status == 1 ? 'Active' : 'Deactive';
                        bookHTML += '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + value.id + '</td>' +
                            '<td>' + value.category + '</td>' +
                            '<td>' + value.name + '</td>' +
                            '<td><img src="../images/product/' + value.image + '" alt="Book Cover Image" ></td>' +
                            '<td>' + value.price + '</td>' +
                            '<td>' + value.qty + '</td>' +
                            '<td><a class="update-status-book badge badge-' + statusCSS + '" data-status="' + value.status + '" data-id="' + value.id + '">' + statusHTML + '</a>&nbsp;<a class="btn btn-sm btn-info view-book"  data-id="' + value.id + '"><i class="fas fa-eye"></i></a>&nbsp;<a class="btn btn-sm btn-info edit-book"  data-id="' + value.id + '"><i class="fas fa-pencil-alt"></i></a>&nbsp;<a  data-id="' + value.id + '" class="btn btn-sm btn-danger delete-book"><i class="fas fa-trash-alt"></i></a></td>' +
                            '</tr>';
                    });
                }
                else if (resp['book'].status == 303) {
                    bookHTML += '<tr>' +
                        '<td colspan="8" class="text-center">' + resp['book'].message + '</td>'
                    '</tr>';
                }
                $("#book-list").html(bookHTML);

                var catSelectHTML = '<option value="">Select Category</option>';
                if (resp['category'].status == 202) {
                    $.each(resp['category'].message, function (index, value) {
                        catSelectHTML += '<option value="' + value.id + '">' + value.category + '</option>';
                    });
                }
                else if (resp['category'].status == 303) {
                    catSelectHTML += '<option value="">' + resp['category'].message + '</option>';
                }
                $(".category_list").html(catSelectHTML);
            }
        })
        return false;
    }

    $(document.body).on("click", '#add-book', function (e) {
        e.preventDefault();
        $("#book-btn").val("Submit");
        $(".book-modal-title").html("Add Book");
        $('#book-form')[0].reset();
        $("input#bid[type=hidden]").val('');
        $("#book-form").find(".required").each(function () {
                if ($(this).hasClass("error")) {
                    $(this).removeClass("error").siblings(".error-message").html("");
                }
        })
        $("#book-form-output").removeClass("alert alert-danger").html("");
        if(!$("#image").hasClass("required"))
        {
            $('#image').addClass("required");
        }
        $(".img").html("");

        $("#book-message").removeClass("alert alert-success").html("");
    })

    $("#book-form").on("submit", function (e) {
        e.preventDefault();
        var $flag = true;
        $(this).find(".required").each(function () {
            if ($(this).val() == "") {
                $(this).addClass("error").siblings(".error-message").html($(this).attr("data-name") + " field is required");
                $flag = false;
            }
            else {
                if ($(this).hasClass("error")) {
                    $(this).removeClass("error").siblings(".error-message").html("");
                }
            }
        })
        if ($flag) {
            let formdata = new FormData(this);
            formdata.append(e.originalEvent.submitter.name, e.originalEvent.submitter.value);
            $.ajax({
                url: '../admin/functions/manage-book.php',
                type: 'POST',
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var resp = $.parseJSON(response);
                    var errStr = "";
                    var suceessStr = "";
                    $.each(resp, function (index, value) {
                        if (value.status == 303) {
                            errStr += value.message + "<br/>";
                        }
                        else if (value.status == 202) {
                            suceessStr += value.message + "<br/>";
                        }
                        else {
                            errStr = "";
                            suceessStr = "";
                        }
                    })
                    if (errStr != "") {
                        $("#book-form-output").addClass("alert alert-danger").html(errStr);
                    }
                    else if (suceessStr != "") {
                        getBooks();
                        $("#book_modal").modal('hide');
                        $("#book-message").addClass("alert alert-success").html(suceessStr);
                    }

                    $('#book-form')[0].reset();
                    $("input#bid[type=hidden]").val('');
                }
            });
        }
        return false;
    })
    $(document.body).on('click', '.delete-book', function () {
        $("#book-message").removeClass("alert alert-success").html("");
        var id = $(this).attr('data-id');

        if (confirm("Are you sure to delete this product")) {
            $.ajax({
                url: '../admin/functions/manage-book.php',
                type: 'POST',
                data: { DELETE_BOOK: 1, id: id },
                success: function (response) {
                    var resp = $.parseJSON(response);
                    if (resp.status == 202) {
                        getBooks();
                        $("#book-message").addClass("alert alert-success").html(resp.message);
                    } else if (resp.status == 303) {
                        $("#book-message").addClass("alert alert-danger").html(resp.message);
                    }
                }
            })
        } else {
            alert('Cancelled');
        }



    });

    $(document).on('click', '.view-book', function () {
        $("#book-message").removeClass("alert alert-success").html("");
        var book_id = $(this).attr("data-id");
        if (book_id != '') {
            $.ajax({
                url: "../admin/functions/manage-book.php",
                type: "POST",
                data: { GET_BOOKS: 1, id: book_id },
                success: function (response) {
                    var resp = $.parseJSON(response);
                    if (resp.book.status == 202) {
                        $("#view_category").html(resp.book.message.category);
                        $("#view_name").html(resp.book.message.name);
                        $("#view_price").html(resp.book.message.price);
                        $("#view_qty").html(resp.book.message.qty);
                        $("#view_image").html("<img src='../images/product/" + resp.book.message.image + "' alt='image' >");
                        $("#view_shortdesc").html(resp.book.message.short_desc);
                        $("#view_desc").html(resp.book.message.description);
                        $("#view_metakeyword").html(resp.book.message.meta_keyword);
                        $("#view_status").html(resp.book.message.status == 1 ? "Active" : "Deactive");
                    }
                    $('#dataModal').modal('show');
                }
            });
        }
    });

    $(document.body).on('click', '.update-status-book', function () {
        $("#book-message").removeClass("alert alert-success").html("");
        var id = $(this).attr('data-id');
        var varstatus = parseInt($(this).attr("data-status"));
        if (varstatus == 1) {
            status = 0;
        } else {
            status = 1;
        }

        var data = {
            UPDATE_STATUS: 1,
            id: id,
            status: status
        }

        $.ajax({
            url: '../admin/functions/manage-book.php',
            type: 'POST',
            data: data,
            success: function (response) {
                var resp = $.parseJSON(response);
                if (resp.status == 202) {
                    getBooks();
                    $("#book-message").addClass("alert alert-success").html(resp.message);
                } else if (resp.status == 303) {
                    $("#book-message").addClass("alert alert-danger").html(resp.message);
                }
            }
        })
    });

    $(document.body).on('click', '.edit-book', function (e) {
        e.preventDefault();
        $("#book-message").removeClass("alert alert-success").html("");
        $("#book-btn").val("Update");
        $(".book-modal-title").html("Edit Book");
        $('#book-form')[0].reset();
        $("input#bid[type=hidden]").val('');
        $("#book-form-output").html("");

        $("#book-form").find(".required").each(function () {
            if ($(this).hasClass("error")) {
                $(this).removeClass("error").siblings(".error-message").html("");
            }
        })

        $("#book-form-output").removeClass("alert alert-danger").html("");

        var id = $(this).attr('data-id');
        $.ajax({
            url: '../admin/functions/manage-book.php',
            type: 'POST',
            data: { GET_BOOKS: 1, id: id },
            success: function (response) {
                var resp = $.parseJSON(response);
                if (resp.book.status == 202) {
                    $('#category_id').val(resp.book.message.category_id);
                    $('#name').val(resp.book.message.name);
                    $('#price').val(resp.book.message.price);
                    $('#qty').val(resp.book.message.qty);
                    $('#image').removeClass("required");
                    $("#image").siblings(".img").html("<img src='../images/product/" + resp.book.message.image + "' alt='image' width='50'>");
                    $('#short_desc').val(resp.book.message.short_desc);
                    $('#desc').val(resp.book.message.description);
                    $('#meta_keyword').val(resp.book.message.meta_keyword);
                    $('#bid').val(resp.book.message.id);

                    $('#book_modal').modal('show');
                    // alert(resp.message);
                } else if (resp.status == 303) {
                    $("#category-message").html('<div class="alert alert-danger" role="alert">' + resp.message + '</div>');
                    //alert(resp.message);
                }
            }
        })
        return false;
    });


    /*order*/
    function getOrders() {
        $.ajax({
            url: '../admin/functions/manage-order.php',
            type: 'POST',
            data: { GET_ORDER: 1 },
            success: function (response) {
                var resp = $.parseJSON(response);

                var brandHTML = '';
                if (resp.status == 202) {
                    $.each(resp.message, function (index, value) {
                        brandHTML += '<tr>' +
                            '<td><a class="btn btn-sm btn-info btn-block get-order-detail" data-id="' + value.id + '">' + value.id + '</a></td>' +
                            '<td>' + value.added_on + '</td>' +
                            '<td>' + value.address + '<br>' + value.city + '<br>' + value.pincode + '</td>' +
                            '<td>' + value.payment_type + '</td>' +
                            '<td>' + value.payment_status + '</td>' +
                            '</tr>';
                    });
                }
                else if (resp.status == 303) {
                    brandHTML += '<tr>' +
                        '<td colspan="6" class="text-center">' + resp.message + '</td>'
                    '</tr>';
                }
                $("#orders-list").html(brandHTML);
            }
        })
    }

    $(document.body).on('click', '.get-order-detail', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
            url: '../admin/functions/manage-order.php',
            type: 'POST',
            data: { GET_ORDERDETAIL: 1, id: id },
            success: function (response) {
                var resp = $.parseJSON(response);
                var orderdetailHTML = '';
                var statusHTML = '';
                var arr=[];
                if (resp['orderstatus'].status == 202) {
                    $.each(resp['orderstatus'].message, function (index, value) {
                        statusHTML += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                }
                else if (resp['orderstatus'].status == 303) {
                    statusHTML += '<option value="">' + resp['orderstatus'].message + '</option>';
                }
		
                if (resp['orderdetail'].status == 202) {
                    $.each(resp['orderdetail'].message, function (index, value) {
                        orderdetailHTML += '<tr>' +
                            '<td><img src="../images/product/' + value.image + '" alt="Book Cover Image" ></td>' +
                            '<td>' + value.name + '</td>' +
                            '<td>' + value.price + '</td>' +
                            '<td>' + value.qty + '</td>' +
                            '<td>' + value.qty * value.price + '</td>' +
                            '<td><select class="form-control order-status" style="width:130px;">'+statusHTML+'</select></td>' +
                            '<td><button class="btn btn-sm btn-info update-orderstatus" data-id='+value.id+'>Update</button></td>' +
                            '</tr>';
                        arr.push(value.statusid);
                    });
                }
                else if (resp['orderdetail'].status == 303) {
                    orderdetailHTML += '<tr>' +
                        '<td colspan="5" class="text-center">' + resp['book'].message + '</td>'
                    '</tr>';
                }
                $("#orderdetail-list").html(orderdetailHTML);
                let select = document.querySelectorAll('.order-status');
                $.each(select,function(index,value){
                    $(this).val(arr[index]);
                });
                $('#orderdetailmodal').modal('show');
            }
        })
        return false;
    });

    $(document.body).on('click', '.update-orderstatus', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        let parent = $(this).parent().parent();
        let statusid = $(parent).find('.order-status').val();
        $.ajax({
            url: '../admin/functions/manage-order.php',
            type: 'POST',
            data: { UPDATE_ORDERSTATUS: 1, id: id, statusid: statusid },
            success: function (response) {
                var resp = $.parseJSON(response);
                alert(resp.message);
            }
        })
        return false;
    });
    /*contcat us*/
    function getContactusdata() {
        $("#contact-message").html("");
        $.ajax({
            url: '../admin/functions/manage-contactus.php',
            type: 'POST',
            data: { GET_CONTACTDATA: 1 },
            success: function (response) {
                var resp = $.parseJSON(response);

                var brandHTML = '';
                if (resp.status == 202) {
                    $.each(resp.message, function (index, value) {
                        brandHTML += '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + value.id + '</td>' +
                            '<td>' + value.name + '</td>' +
                            '<td>' + value.email + '</td>' +
                            '<td>' + value.mobile + '</td>' +
                            '<td>' + value.comment + '</td>' +
                            '<td>' + value.added_on + '</td>' +
                            '<td><a  data-id="' + value.id + '" class="btn btn-sm btn-danger delete-contactus"><i class="fas fa-trash-alt"></i></a></td>' +
                            '</tr>';
                    });
                }
                else if (resp.status == 303) {
                    brandHTML += '<tr>' +
                        '<td colspan="8" class="text-center">' + resp.message + '</td>'
                    '</tr>';

                }


                $("#contactus-list").html(brandHTML);

            }
        })
    }
    $(document.body).on('click', '.delete-contactus', function () {

        var id = $(this).attr('data-id');

        if (confirm("Are you sure to delete this Data?")) {
            $.ajax({
                url: '../admin/functions/manage-contactus.php',
                type: 'POST',
                data: { DELETE_CONTACTUS: 1, id: id },
                success: function (response) {
                    var resp = $.parseJSON(response);
                    if (resp.status == 202) {
                        getContactusdata();
                        $("#contact-message").html('<div class="alert alert-success" role="alert">' + resp.message + '</div>');
                        // alert(resp.message);
                    } else if (resp.status == 303) {
                        $("#contact-message").html('<div class="alert alert-danger" role="alert">' + resp.message + '</div>');
                        //alert(resp.message);
                    }
                }
            })
        } else {
            alert('Cancelled');
        }
    });
    /*users*/
    function getUsers() {
        $("#user-message").html("");
        $.ajax({
            url: '../admin/functions/manage-users.php',
            type: 'POST',
            data: { GET_USERSDATA: 1 },
            success: function (response) {
                var resp = $.parseJSON(response);

                var brandHTML = '';
                if (resp.status == 202) {
                    $.each(resp.message, function (index, value) {
                        brandHTML += '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + value.id + '</td>' +
                            '<td>' + value.name + '</td>' +
                            '<td>' + value.email + '</td>' +
                            '<td>' + value.mobile + '</td>' +
                            '<td>' + value.added_on + '</td>' +
                            '<td><a  data-id="' + value.id + '" class="btn btn-sm btn-danger delete-user"><i class="fas fa-trash-alt"></i></a></td>' +
                            '</tr>';
                    });
                }
                else if (resp.status == 303) {
                    brandHTML += '<tr>' +
                        '<td colspan="7" class="text-center">' + resp.message + '</td>'
                    '</tr>';
                }
                $("#users-list").html(brandHTML);
            }
        })
    }
    $(document.body).on('click', '.delete-user', function () {
        var id = $(this).attr('data-id');
        if (confirm("Are you sure to delete this users")) {
            $.ajax({
                url: '../admin/functions/manage-users.php',
                type: 'POST',
                data: { DELETE_USER: 1, id: id },
                success: function (response) {
                    var resp = $.parseJSON(response);
                    if (resp.status == 202) {
                        getUsers();
                        $("#user-message").html('<div class="alert alert-success" role="alert">' + resp.message + '</div>');
                        // alert(resp.message);
                    } else if (resp.status == 303) {
                        $("#user-message").html('<div class="alert alert-danger" role="alert">' + resp.message + '</div>');
                        //alert(resp.message);
                    }
                }
            })
        } else {
            alert('Cancelled');
        }
    });
});