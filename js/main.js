const login_email = document.querySelector("#login-email");
const login_password = document.querySelector("#login-password");

const full_name = document.querySelector("#full-name");
const register_email = document.querySelector("#register-email");
const register_password = document.querySelector("#register-password");
const confirm_password = document.querySelector("#confirm-password");
const mobile_no = document.querySelector("#mobile-no");

const street_address = document.querySelector("#streetaddress");
const city = document.querySelector("#city");
const post_code = document.querySelector("#post-code");
const opt_payment = document.querySelectorAll(".optpayment");

const divradioWrapper = document.querySelector(".input-radio-wrapper");


let login_flag;
let register_flag;
let additional_info_flag;


function checkLoignInput() {
    //get the values from the inputs

    const emailValue = login_email.value.trim();
    const passwordValue = login_password.value.trim();

    //email validation

    if (emailValue === '') {
        setErrorFor(login_email, 'Email cannot be blank');

    }
    else if (!isEmail(emailValue)) {
        setErrorFor(login_email, 'Email is not valid');

    }
    else {
        setSuccessFor(login_email);
        login_flag = true;
    }
    //password validation

    if (passwordValue === '') {
        setErrorFor(login_password, 'Password cannot be blank');

    }
    else {
        setSuccessFor(login_password);
        login_flag = true;
    }

}

function checkRegisterInput() {
    //get the values from the inputs

    const fullnameValue = full_name.value.trim();
    const emailValue = register_email.value.trim();
    const passwordValue = register_password.value.trim();
    const confirmpasswordValue = confirm_password.value.trim();
    const mobilenoValue = mobile_no.value.trim();

    //name validation

    if (fullnameValue === '') {
        setErrorFor(full_name, 'Full Name cannot be blank');

    }
    else {
        setSuccessFor(full_name);
        register_flag = true;
    }

    //email validation

    if (emailValue === '') {
        setErrorFor(register_email, 'Email cannot be blank');


    }
    else if (!isEmail(emailValue)) {
        setErrorFor(register_email, 'Email is not valid');

    }
    else {
        setSuccessFor(register_email);
        register_flag = true;
    }
    //password validation

    if (passwordValue === '') {
        setErrorFor(register_password, 'Password cannot be blank');

    }
    else {
        setSuccessFor(register_password);
        register_flag = true;

    }

    //confirm password validation

    if (confirmpasswordValue === '') {
        setErrorFor(confirm_password, 'Confirm Password cannot be blank');

    }
    else if (passwordValue != confirmpasswordValue) {
        setErrorFor(confirm_password, 'Password and confirm password doesn\'t match');
    }
    else {
        setSuccessFor(confirm_password);
        register_flag = true;

    }

    //mobile no validation

    if (mobilenoValue === '') {
        setErrorFor(mobile_no, 'Mobile No cannot be blank');
    }
    else {
        setSuccessFor(mobile_no);
        register_flag = true;
    }

}
function checkAdditionalInfoInput() {
    //get the values from the inputs

    const streetaddressValue = street_address.value.trim();
    const cityValue = city.value.trim();
    const postcodeValue = post_code.value.trim();
    let optpaymentValue = '';
    for (let i = 0; i < opt_payment.length; i++) {
        if (opt_payment[i].checked) {
            optpaymentValue = opt_payment[i].value;
        }
    }

    //name validation

    if (streetaddressValue === '') {
        setErrorFor(street_address, 'Street Address cannot be blank');
    }
    else {
        setSuccessFor(street_address);
        additional_info_flag = true;
    }

    //email validation

    if (cityValue === '') {
        setErrorFor(city, 'City cannot be blank');
    }
    else {
        setSuccessFor(city);
        additional_info_flag = true;
    }
    //password validation

    if (postcodeValue === '') {
        setErrorFor(post_code, 'Post Code/ ZIP cannot be blank');
    }
    else {
        setSuccessFor(post_code);
        additional_info_flag = true;
    }

    //confirm password validation

    if (optpaymentValue === '') {
        setErrorForradio(divradioWrapper, 'Payment Option cannot be blank');

    }
    else {
        setSuccessForradio(divradioWrapper);
        additional_info_flag = true;

    }

}
function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    small.innerText = message;
    small.classList.add('text-danger');
}
function setSuccessFor(input) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    if (small.classList.contains("text-danger")) {
        small.classList.remove('text-danger');
        small.innerText = '';
    }
}

function setErrorForradio(input, message) {
    const small = input.querySelector('small');
    small.innerText = message;
    small.classList.add('text-danger');
}

function setSuccessForradio(input) {
    const small = input.querySelector('small');
    if (small.classList.contains("text-danger")) {
        small.classList.remove('text-danger');
        small.innerText = '';
    }
}




function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

$("#user-login").on("submit", function (e) {
    login_flag = false;
    e.preventDefault();
    checkLoignInput();
    if (login_flag == true) {
        $(".overlay").show();
        $.ajax({
            url: "https://kumarishwetha.com/book-shop/action.php",
            method: "POST",
            data: $("#user-login").serialize() + '&' + encodeURI(e.originalEvent.submitter.name) + "=" + encodeURI(e.originalEvent.submitter.value),
            success: function (data) {
                if (data == "success") {
                    window.history.back();
                } else {
                    $('#login_msg').fadeIn().html(data);
                    setTimeout(function () {
                        $('#login_msg').fadeOut("Slow");
                    }, 3000);
                    $(".overlay").hide();
                }
            }
        })
    }

})

//Get User Information before checkout
$("#user-register").on("submit", function (e) {
    e.preventDefault();
    register_flag = false;
    checkRegisterInput();
    if (register_flag == true) {
        $(".overlay").show();
        $.ajax({
            url: "https://kumarishwetha.com/book-shop/action.php",
            method: "POST",
            data: $("#user-register").serialize() + '&' + encodeURI(e.originalEvent.submitter.name) + "=" + encodeURI(e.originalEvent.submitter.value),
            success: function (data) {
                if (data == "register_success") {
                    window.history.back();
                }
                else {
                    $('#signup_msg').fadeIn().html(data);
                    setTimeout(function () {
                        $('#signup_msg').fadeOut("Slow");
                    }, 3000);
                    $(".overlay").hide();
                }

            }
        })
    }

})

function submitCkecoutForm() {
    additional_info_flag = false;
    checkAdditionalInfoInput();
    return additional_info_flag;
}
cat();
book();
count_item();
getCartItem();
checkOutDetails();
getDetailBook();
searchBook();
getOrderedBook();
function cat() {
    $.ajax({
        url: "https://kumarishwetha.com/book-shop/action.php",
        method: "POST",
        data: { GET_CATEGORY: 1,
            search: keyword
        },
        success: function (data) {
            $("#category-list").html(data);
            $("#mobile-category-list").html(data);
        }
    })
}
function book() {
    $.ajax({
        url: "https://kumarishwetha.com/book-shop/action.php",
        method: "POST",
        data: {
            GET_BOOK: 1,
            limit: 8
        },
        success: function (data) {
            $("#book-list").html(data);
        }
    })
}
function getDetailBook() {
    if (book_id != 0) {
        $.ajax({
            url: "https://kumarishwetha.com/book-shop/action.php",
            method: "POST",
            data: {
                GET_DETAIL: 1,
                book_ID: book_id
            },
            success: function (data) {
                $("#book-content").html(data);
            }
        })
    }
}

function searchBook() {
    if (keyword != '') {
        $.ajax({
            url: "https://kumarishwetha.com/book-shop/action.php",
            method: "POST",
            data: {
                GET_BOOK: 1,
                search: keyword
            },
            success: function (data) {
                $("#book-list").html(data);
            }
        })
    }
}

$("body").on("click", ".book-category", function (event) {
    $('.overlay').show();
    event.preventDefault();
    var cid = $(this).attr('data-id');
    $.ajax({
        url: "https://kumarishwetha.com/book-shop/action.php",
        method: "POST",
        data: { GET_BOOK: 1, cat_id: cid, search: keyword },
        success: function (data) {
            $('.overlay').hide();
            $("#book-list").html(data);
            if ($("body").width() < 480) {
                $("body").scrollTop(683);
            }
        }
    })

})

$("body").delegate(".book", "click", function (event) {
    event.preventDefault();
    let parentEle = $(this).parent();
    let bid = parentEle.find('.book-id').attr('data-id');
    var qty = parentEle.find('.qty').val();
    $(".overlay").show();
    $.ajax({
        url: "https://kumarishwetha.com/book-shop/action.php",
        method: "POST",
        data: { addToCart: 1, bookID: bid, qty: qty },
        success: function (data) {
            count_item();
            getCartItem();
            $('.overlay').hide();
            $('#product_msg').html(data);
            $('#product_msg').fadeIn('fast', function () {
                $('#product_msg').delay(2000).fadeOut('slow');
            });
        }
    })
})

$("body").delegate(".book_add_to_cart", "click", function (event) {
    event.preventDefault();
    let parentEle = $(this).parent();
    let bid = parentEle.find('.book-id').attr('data-id');
    var qty = parentEle.find('.qty').val();
    $(".overlay").show();
    $.ajax({
        url: "https://kumarishwetha.com/book-shop/action.php",
        method: "POST",
        data: { addToCartFromDetail: 1, bookID: bid, qty: qty },
        success: function (data) {
            count_item();
            getCartItem();
            $('.overlay').hide();
            $('#product_msg').html(data);
            $('#product_msg').fadeIn('fast', function () {
                $('#product_msg').delay(2000).fadeOut('slow');
            });
        }
    })
})
function count_item() {
    $.ajax({
        url: "https://kumarishwetha.com/book-shop/action.php",
        method: "POST",
        data: { count_item: 1 },
        success: function (data) {
            if (data != '') {
                $(".count-cart").css("display", "block");
                $(".count-cart").html(data);
            }
            else {
                $(".count-cart").css("display", "none");
            }
        }
    })
}

function getCartItem() {
    $.ajax({
        url: "https://kumarishwetha.com/book-shop/action.php",
        method: "POST",
        data: { getCartItem: 1, cart_dropdown: 1 },
        success: function (data) {
            $("#cart_product").html(data);
        }
    })
}
function checkOutDetails() {
    $('.overlay').show();
    $.ajax({
        url: "https://kumarishwetha.com/book-shop/action.php",
        method: "POST",
        data: { getCartItem: 1, cart_page: 1 },
        success: function (data) {
            $('.overlay').hide();
            $("#cart-list").html(data);
        }
    })
}

$("body").delegate(".cart_qty", "change", function (event) {
    event.preventDefault();
    var row = $(this).parent().parent();
    var price = row.find('.price').text();
    var qty = row.find('.cart_qty').val();
    var total = price * qty;
    row.find('.total').text(total);

    var cart_id = row.find('.remove').attr("data-id");
    $.ajax({
        url: "https://kumarishwetha.com/book-shop/action.php",
        method: "POST",
        data: { updateCartItem: 1, cart_id: cart_id, qty: qty },
        success: function (data) {
            $('#product_msg').html(data);
            $('#product_msg').fadeIn('fast', function () {
                $('#product_msg').delay(2000).fadeOut('slow');
            });
            checkOutDetails();
            getCartItem();
            count_item();
        }
    })

})

$("body").delegate(".remove", "click", function (event) {
    var cart_id = $(this).attr("data-id");

    $.ajax({
        url: "https://kumarishwetha.com/book-shop/action.php",
        method: "POST",
        data: { removeItemFromCart: 1, cart_id: cart_id },
        success: function (data) {
            $("#product_msg").html(data);
            $('#product_msg').fadeIn('fast', function () {
                $('#product_msg').delay(2000).fadeOut('slow');
            });
            checkOutDetails();
            getCartItem();
            count_item();
        }
    })
})

function getOrderedBook() {
    $.ajax({
        url: "https://kumarishwetha.com/book-shop/action.php",
        method: "POST",
        data: {
            getOrderItem: 1,
        },
        success: function (data) {
            $("#order-list").html(data);
        }
    })
}




