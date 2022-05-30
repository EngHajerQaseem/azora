$(document).ready(function() {
    // $('.cat_slider').slick({
    //     infinite: true,
    //     slidesToShow: 4,
    //     slidesToScroll: 2,
    //     // centerMode: true,
    //     // variableWidth: true
    //     // easing:linear
    //     mobileFirst: true,
    //     useCSS: true,
    //     centerPadding: '60px'
    // });

    // $('.subcat_slider').slick({
    //     infinite: true,
    //     slidesToShow: 4,
    //     slidesToScroll: 2
    // });

    //$(".selectpicker").selectpicker("refresh");

    /////////// Upload user's Image
    $("#uploadImageForm")
        .unbind("submit")
        .bind("submit", function() {
            var form = $(this);
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                async: true,
                success: function(response) {
                    if (response.success == true) {
                        $("#messages").html(
                            '<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            response.messages +
                            "</div>"
                        );

                        $('input[type="text"]').val("");
                        $(".fileinput-remove-button").click();
                    } else {
                        $("#messages").html(
                            '<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            response.messages +
                            "</div>"
                        );
                    }
                },
            });

            return false;
        });

    /////// End Delete User

    $(".collapsible-header").click(function() {
        $(".collapsible-body").slideToggle(400);
        //$(this).css("backgroundColor","#64B6FF")
        $(this).siblings().children("div").hide();
    });

    $(".burger").click(function() {
        $(".side-nav").animate({ width: "toggle" });

        var toggleWidth = $(".navbar").width() == 100 ? "80%" : "100%";
        $(".navbar").animate({ width: toggleWidth });
    });

    var carousel = $(".cat_slider ul");
    var carouselChild = carousel.find("li");
    var clickCount = 0;
    var canClick = true;
    var itemWidth = carousel.find("li").outerWidth() + 80; //Including margin
    // console.log(carousel.find('li:last').prev());

    //Set Carousel width so it won't wrap
    carousel.width(itemWidth * carouselChild.length);

    //Place the child elements to their original locations.
    refreshChildPosition();

    //Set the event handlers for buttons.
    $(".category_list .next_cat").click(function() {
        if (canClick) {
            canClick = false;
            clickCount++;

            //Animate the slider to left as item width
            carousel.stop(false, true).animate({
                    left: "-=" + itemWidth,
                },
                300,
                function() {
                    //Find the first item and append it as the last item.
                    lastItem = carousel.find("li:first");
                    lastItem.remove().appendTo(carousel);
                    lastItem.css(
                        "left",
                        (carouselChild.length - 1) * itemWidth + clickCount * itemWidth
                    );
                    canClick = true;
                }
            );
        }
    });

    $(".category_list .pre_cat").click(function() {
        if (canClick) {
            canClick = false;
            clickCount--;
            //Find the first item and append it as the last item.
            lastItem = carousel.find("li:last");
            lastItem.remove().prependTo(carousel);

            lastItem.css("left", itemWidth * clickCount);
            //Animate the slider to right as item width
            carousel.finish(true).animate({
                    left: "+=" + itemWidth,
                },
                300,
                function() {
                    canClick = true;
                }
            );
        }
    });

    function refreshChildPosition() {
        carouselChild.each(function() {
            $(this).css("left", itemWidth * carouselChild.index($(this)));
        });
    }

    // slider for the subcategory
    var carousel2 = $(".subcat_slider ul");
    var carouselChild2 = carousel2.find("li");
    var clickCount2 = 0;
    var canClick2 = true;
    var itemWidth2 = carousel2.find("li:first").width() + 80; //Including margin
    // console.log(carousel2.find('li:first').outerWidth());
    //Set Carousel width so it won't wrap
    carousel2.width(itemWidth2 * carouselChild2.length);

    //Place the child elements to their original locations.
    refreshChildPosition2();

    //Set the event handlers for buttons.
    $(".subcategory_list .next_cat").click(function() {
        if (canClick2) {
            canClick2 = false;
            clickCount2++;

            //Animate the slider to left as item width
            carousel2.stop(false, true).animate({
                    left: "-=" + itemWidth2,
                },
                300,
                function() {
                    //Find the first item and append it as the last item.
                    lastItem = carousel2.find("li:first");
                    lastItem.remove().appendTo(carousel2);
                    lastItem.css(
                        "left",
                        (carouselChild2.length - 1) * itemWidth2 + clickCount2 * itemWidth2
                    );
                    canClick2 = true;
                }
            );
        }
    });

    $(".subcategory_list .pre_cat").click(function() {
        if (canClick2) {
            canClick2 = false;
            clickCount2--;
            //Find the first item and append it as the last item.
            lastItem = carousel2.find("li:last");
            lastItem.remove().prependTo(carousel2);

            lastItem.css("left", itemWidth2 * clickCount2);
            //Animate the slider to right as item width
            carousel2.finish(true).animate({
                    left: "+=" + itemWidth2,
                },
                300,
                function() {
                    canClick2 = true;
                }
            );
        }
    });

    function refreshChildPosition2() {
        carouselChild2.each(function() {
            $(this).css("left", itemWidth2 * carouselChild2.index($(this)));
        });
    }

    // adding active class to category  and show the subcategory
    //$('.subcategory_list div').css("display", "none");

    $(".cat_slider").on("click", ".btn", function() {
        //  var clicks = $(this).data('clicks');

        $(this)
            .addClass("main_btn")
            .removeClass("cate_btn")
            .siblings("div")
            .removeClass("main_btn")
            .addClass("cate_btn");

        if ($(this).hasClass("all")) {
            $(".product_list .subcategory_list .btn").css("display", "none");
            $(".subcat_slider .btn").removeClass("main_btn");
        } else {
            $(".product_list .subcategory_list .btn").css("display", "none");
            $($(this).data("filter")).fadeIn(200);
            $(".subcat_slider .btn").removeClass("main_btn").addClass("cate_btn");
        }
        // $('.product_list .subcategory_list ').css("display", "block");

        // var cate_id = $(this).data('filter');

        // console.log(cate_id);
        // $.ajax({
        //     url: "filter_products.php",
        //     method: "POST",

        //     data: { cate_id: cate_id},
        //     success: function (html) {

        //         $('.product_list .products').html(html);

        //     }
        // });

        // $(" .product_container").fadeOut(200);
        // $($(this).data("filter")).fadeIn(200);

        //if (!clicks) {
        // if ($(this).hasClass('all')) {
        //     $('.product_list .subcategory_list ').css("display", "none");
        //     $(" .product_container").fadeIn(200)

        // } else {
        //     $('.product_list .subcategory_list ').css("display", "block");
        //     $($(this).data("cate")).slideDown(400);
        // }

        // } else {
        //    $('.subcategory_list').fadeOut(400);
        //     $($(this).data("cate")).fadeIn(200);
        //     $(" .product_container").fadeIn(200)

        // }
        // $(this).data("clicks", !clicks);
    });

    // adding active class to subcategory  and show the subcategory

    $(".subcat_slider").on("click", ".btn", function() {
        $(this)
            .addClass("main_btn")
            .removeClass("cate_btn")
            .siblings("div")
            .removeClass("main_btn")
            .addClass("cate_btn");
        //console.log('subcategory');
    });

    $(document).on(
        "click",
        ".cart_body .product-holder .product_item",
        function() {
            // $(this).parents().eq(2).next().slideToggle(400,function(){
            //     // if(localStorage.getItem('test')!== 'undefined'){

            //     //     localStorage.setItem('test', 'show');
            //     //     console.log("show");
            //     // }
            //     // else{
            //     //     localStorage.removeItem(test);
            //     //     console.log("hide");
            //     // }

            // });
            //localStorage.setItem('display', $(this).is(':visible'));

            // $(this).toggleClass("fa-angle-down fa-angle-right");
            if ($(this).parents().eq(2).children().eq(1).hasClass("open")) {
                disableopenDetails($(this));
            } else {
                enableopenDetails($(this));
            }
        }
    );
    // enableopenDetails();

    // function enableopenDetails() {
    //     $( ".product_item" ).addClass( "open" );
    //     setCookie('openDetails',"1",7);
    // }

    // function disableopenDetails() {
    //   $( ".product_item" ).removeClass( "open" );
    //   setCookie('openDetails',"0",7);
    // }

    function enableopenDetails(thisObj) {
        $(thisObj).parents().eq(2).children().eq(1).addClass("open");

        setCookie("openDetails", "1", 7);
    }

    function disableopenDetails(thisObj) {
        $(thisObj).parents().eq(2).children().eq(1).removeClass("open");

        setCookie("openDetails", "0", 7);
    }

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(";");
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == " ") c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    // function eraseCookie(name) {
    //     document.cookie = name+'=; Max-Age=-99999999;';
    // }

    $(document).on(
        "mousedown",
        ".cart_body .product_Quantity .btn-number",
        function(e) {
            e.preventDefault();

            if ($(this).hasClass("plus")) {
                var increse = parseInt($(this).siblings("input").val()) + 1;
                $(this).siblings("input").val(increse);
                // $(thisObj).parents().eq(2).children().eq(1).addClass( "open" );

                //console.log(increse)
            } else {
                if ($(this).siblings("input").val() <= 1) {
                    $(this).prop("disabled");
                    //console.log('minus')
                } else {
                    var decrese = parseInt($(this).siblings("input").val()) - 1;
                    $(this).siblings("input").val(decrese);
                    $(this).removeProp("disabled");
                    // console.log(decrese)
                }
            }

            var qtyval = parseInt($(this).siblings("input").val());
            var pro_id = $(this).siblings("input").data("id");
            var action = "changeQty";
            console.log(pro_id);
            $.ajax({
                url: "action.php",
                method: "POST",

                data: { pro_id: pro_id, qtyval: qtyval, action: action },
                success: function(data) {
                    load_cart_data();
                },
            });
        }
    );

    $(document).on("input", ".quantity", function() {
        //     var direction = this.defaultValue < this.value
        //     this.defaultValue = this.value;
        //   if (direction) alert("increase!");
        // else alert("decrease!");
        //console.log($(this).val()) ;

        var qtyval = parseInt($(this).val());
        var pro_id = $(this).data("id");
        var action = "changeQty";
        console.log(pro_id);
        $.ajax({
            url: "action.php",
            method: "POST",

            data: { pro_id: pro_id, qtyval: qtyval, action: action },
            success: function(data) {
                load_cart_data();
            },
        });
    });

    /*load_product();

                function load_product() {
                    $.ajax({
                        url: "index.php",
                        method: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('.products .test').html(data);
                        }
                    });
                }*/

    load_cart_data();

    function load_cart_data() {
        $.ajax({
            url: "fetch_cart.php",
            method: "POST",
            dataType: "json",
            success: function(data) {
                $(".added_product").html(data);

                // check the localstorage
                // var show_details = localStorage.getItem('test');
                // if (show_details!=="show") {

                // console.log("nothing");
                // $(".more_details ").css("display","none");

                // }
                // else{
                //     $(".more_details").css("display","block");

                //     console.log("yes");

                // }

                // var block = localStorage.getItem('display');
                // if (block == 'true') {
                //     $('#more_details').show();
                //     console.log("yes");
                // }
                // else{
                //     $('#more_details').hide();
                //     console.log("no");
                // }

                // var openDetails = getCookie('openDetails');

                // if (openDetails == "1") {
                //     // use openDetails
                //     //enableopenDetails();
                //   $(".more_details").addClass( "open" );
                // // $(thisObj).parents().eq(2).children().eq(1).addClass( "open" );
                // } else {
                //     // no openDetails
                //    // disableopenDetails();
                //    $(".more_details").removeClass( "open" );
                // }
            },
        });
    }

    $(document).on("click", ".product_container", function() {
        var product_id;
        var action = "add";
        var qty = 1;
        //product_id.push($(this).children('input').val());
        product_id = $(this).children("input").val();
        // console.log(product_id);
        // qty++;
        // $(this).addClass('animate');
        // console.log(qty);

        $.ajax({
            url: "action.php",
            method: "POST",
            // dataType: 'json',
            // data: { product_id: product_id, product_name: product_name, action: action },
            data: { product_id: product_id, action: action, qty: qty },
            success: function(data) {
                //alert(product_id);
                // $('.product_item').children('p').html(data);
                load_cart_data();
            },
        });

        // } else {
        //     alert(product_id);
        // }
    });

    $(document).on("input", "#pro_discount", function() {
        var discount = $(this).val();
        $(this)
            .find("option[value=" + discount + "]")
            .attr("selected", "selected");
        //localStorage.setItem('option', $(this).is(':visible'));

        var pro_id = $(this).data("id");
        var action = "addDiscount";
        // localStorage.setItem('display', $(this).is(':visible'));

        console.log(discount);
        $.ajax({
            url: "action.php",
            method: "POST",

            data: { pro_id: pro_id, discount: discount, action: action },
            success: function(data) {
                load_cart_data();
            },
        });
    });

    $(document).on("input", ".total_discount", function() {
        var total_discount = $(this).val();

        var action = "TotalDiscount";
        console.log(total_discount);
        $.ajax({
            url: "action.php",
            method: "POST",

            data: { total_discount: total_discount, action: action },
            success: function(data) {
                load_cart_data();
            },
        });
    });

    $(document).on("click", ".trash", function() {
        var product_id = $(this).attr("id");
        //console.log(product_id);
        var action = "remove";
        //if (confirm("Are you sure you want to remove this product?")) {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { product_id: product_id, action: action },
            success: function() {
                load_cart_data();

                //alert("Item has been removed from Cart");
            },
        });
        //}
        //else {
        //   return false;
        // }
    });

    // click on payment button

    $(".btn_payment").click(function() {
        $.ajax({
            url: "payment_method.php",
            method: "POST",

            success: function(data) {
                $(".payment-method-cart").css("bottom", 0);
                $(".payment-method-cart").html(data);
            },
        });
    });

    $(document).on("click", ".cancel_payment", function(e) {
        e.preventDefault();
        $(".payment-method-cart").css("bottom", -700);
        $(".cash-payment").css("left", -950);
    });

    // click on cash payment button

    $(document).on("click", ".cash", function(e) {
        $.ajax({
            url: "payment.php",
            method: "POST",

            success: function(data) {
                $(".cash-payment").css("left", 0);
                $(".cash-payment").html(data);
            },
        });
    });

    // display the invoice
    $(document).on("click", ".show_invoice", function(e) {
        e.preventDefault();
        var customer = $("#customer").find(":selected").text();
        var customer_id = $("option:selected").attr("value");
        var collected = $("#collected").val();
        var change = $("#change").val();
        console.log(customer_id);
        $.ajax({
            url: "invoice.php",
            method: "POST",
            data: {
                customer_id: customer_id,
                customer: customer,
                collected: collected,
                change: change,
            },
            success: function(data) {
                $(".modal2").html(data);
                // $('#InvoiceModal').modal({show:true});
                //$('#InvoiceModal').appendTo("body").modal('show');
                $("#InvoiceModal").modal({ backdrop: "static", keyboard: false });
                $("#InvoiceModal").modal("show");

                //  console.log(collected+''+customer);
            },
        });
    });

    // hide the invoice modal
    $(document).on("click", ".hide-invoice", function(e) {
        // $('#InvoiceModal').remove();
        $("#InvoiceModal").modal("hide");

        $("#InvoiceModal").remove();
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open");
    });

    // hide the invoice modal when clicking outside
    $(document).click(function(e) {
        if ($(e.target).is("#InvoiceModal")) {
            $("#InvoiceModal").modal("hide");

            $("#InvoiceModal").remove();
            $(".modal-backdrop").remove();
            $("body").removeClass("modal-open");
        }
    });

    $(document).on("input", "#collected", function() {
        var collected = $(this).val();
        //console.log(collected);

        var amount = $("#amount").val();

        var change = amount - collected;
        $("#change").val(Math.abs(change));

        //     var action = "TotalDiscount";
        //    console.log(total_discount);
        //     $.ajax({
        //         url: "action.php",
        //         method: "POST",

        //         data: {total_discount:total_discount,action:action},
        //         success: function(data) {
        //              load_cart_data();

        //         }
        //     });
    });

    // tabs in products details

    $(".nav-tabs li ").click(function(e) {
        e.preventDefault();
        // $(this).children(a).addClass("active").siblings().removeClass("active");
        $(".purchase-history ,.sales-history").hide();
        $("." + $(this).data("class")).fadeIn(200);
        // console.log('sales');
    });

    // tabs in Category form

    $(".category-tabs .nav-tabs li ").click(function(e) {
        e.preventDefault();
        // $(this).children(a).addClass("active").siblings().removeClass("active");
        $(".addCategory ,.addSubCategory").hide();
        $("." + $(this).data("class")).fadeIn(200);
        // console.log('sales');
    });

    $(".purchase-order-product-row").click(function(e) {
        var checkbox = $(this).find('input[type="checkbox"]');
        if (e.target.nodeName != "INPUT") {
            checkbox.prop("checked", !checkbox.prop("checked"));
        }
    });

    $("#supplier-button").click(function(e) {
        var clicked = 0;
        $("#supplier-list option").each(function(index) {
            if (index == 0) {
                return true;
            } else if ($(this).is(":selected")) {
                clicked++;
                $("#supplier-name").text($(this).text());
                $("#supplier-id").val($(this).val());
            }
        });
        if (clicked == 1) {
            $(".supplier-modal").modal("toggle");
        } else {
            alert("Nothing is selected");
        }
    });

    $("#product-button").click(function() {
        var clicked = 0;
        var ids = 0;
        $(".product-checkbox").each(function() {
            if ($(this).prop("checked") == true) {
                clicked++;
                ids += $(this).val();
            }
        });
        if (clicked != 0) {
            $("#product-modal").modal("toggle");
            $.ajax({
                type: "POST",
                url: "purchase_order_fetch_products.php",
                data: "products=" + ids,
                success: function(response) {
                    $("#products-list").html(response);
                },
            });
        } else {
            alert("Nothing is selected");
        }
    });

    $("#tax-modal").on("show.bs.modal", function(e) {
        $(e.currentTarget)
            .find(".modal-header")
            .find(".modal-title")
            .text("Edit Tax");
        let id = $(e.relatedTarget).data("product-id");
        let ParentDiv = e.relatedTarget.parentNode.parentNode.parentNode.parentNode;
        let paragraphElement = $(ParentDiv).children("p");
        let price = $(paragraphElement[0]).text();
        let description = $(paragraphElement[1]).text();
        let priceDialogParagraphs = $(e.currentTarget)
            .find(".modal-body")
            .find("input[name=tax-value]");
        let descriptionDialogParagraphs = $(e.currentTarget)
            .find(".modal-body")
            .find("input[name=tax-description]");
        let idDialogParagraphs = $(e.currentTarget)
            .find(".modal-body")
            .find("input[name=id]");
        $(priceDialogParagraphs[0]).val(price.replace("%", ""));
        $(descriptionDialogParagraphs[0]).val(description);
        $(idDialogParagraphs[0]).val(id);
        // console.log(dialogParagraphs[0]);
    });

    $("#discount-modal").on("show.bs.modal", function(e) {
        $(e.currentTarget)
            .find(".modal-header")
            .find(".modal-title")
            .text("Edit Discount");
        let id = $(e.relatedTarget).data("product-id");
        let ParentDiv = e.relatedTarget.parentNode.parentNode.parentNode.parentNode;
        let paragraphElement = $(ParentDiv).children("p");
        let price = $(paragraphElement[0]).text();
        let description = $(paragraphElement[1]).text();
        let priceDialogParagraphs = $(e.currentTarget)
            .find(".modal-body")
            .find("input[name=discount-value]");
        let descriptionDialogParagraphs = $(e.currentTarget)
            .find(".modal-body")
            .find("input[name=discount-description]");
        let idDialogParagraphs = $(e.currentTarget)
            .find(".modal-body")
            .find("input[name=id]");
        $(priceDialogParagraphs[0]).val(price.replace("%", ""));
        $(descriptionDialogParagraphs[0]).val(description);
        $(idDialogParagraphs[0]).val(id);
    });

    $("#editWarehouse").on("show.bs.modal", function(e) {
        var button = $(e.relatedTarget);
        var recipient = button.data("whatever");
        var modal = $(this);
        var dataString = "id=" + recipient;
        $.ajax({
            type: "GET",
            url: "warehouse_edit.php",
            data: dataString,
            cache: false,
            success: function(data) {
                modal.find(".dash").html(data);
            },
            error: function(err) {
                console.log(err);
            },
        });
    });

    // edit user profile
    // edit user full name

    $("#edit_user_name").on("submit", function(event) {
        event.preventDefault();
        //var userId=$('#userId').val();
        var full = $("#full_name").val();

        // if(full == "")
        // {
        //      alert("Name is required");
        // }

        // else
        // {

        $.ajax({
            url: "profile_edit.php",
            method: "POST",
            data: "full=" + full,
            //   beforeSend:function(){
            //        $('#insert').val("Inserting");
            //   },
            success: function(data) {
                $("#full_name").val("");
                $("#username").modal("hide");
                $(".user-profile-info-container #fullname").html(data);
                $(" #full_name_user").html(data);
            },
        });
        //}
    });

    $("#edit_user_phone").on("submit", function(event) {
        event.preventDefault();
        var userId = $("#userId").val();
        var phone = $("#user_phone").val();

        if (phone == "") {} else {
            $.ajax({
                url: "profile_edit.php",
                method: "POST",
                data: "phone=" + phone + "&userId=" + userId,
                success: function(data) {
                    // $('#insert_form')[0].reset();

                    if (data === "This phone is already taken.") {
                        $("#error-phone").html(
                            '<span class="help-block" id="check_pass">This phone is already taken.</span>'
                        );
                        $("#user_phone").val("");
                    } else {
                        $("#phone").modal("hide");
                        $(".user-profile-info-container #userPhone").html(data);
                        $("#user_phone").val("");
                    }
                },
            });
        }
    });

    $("#edit_user_password").on("submit", function(event) {
        event.preventDefault();
        var userId = $("#userId").val();
        var newpass = $("#new_pass").val();

        if (newpass.length < 6) {
            $("#error-pass").html(
                '<span class="help-block" id="check_pass">Password must have atleast 6 characters</span>'
            );
        } else {
            $("#error-pass span").remove();
        }
        if (
            $("#edit_user_password #check_pass").html() ==
            "The Password is not correct "
        ) {
            e.preventDefault();
            return false;
        }

        if (
            $("#error-pass").html() ==
            '<span class="help-block" id="check_pass">Password must have atleast 6 characters</span>'
        ) {
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                url: "profile_edit.php",
                method: "POST",
                data: "newpass=" + newpass + "&userId=" + userId,
                //   beforeSend:function(){
                //        $('#insert').val("Inserting");
                //   },
                success: function(data) {
                    // $('#insert_form')[0].reset();
                    $("#passwordModal").modal("hide");
                    $("#new_pass").val("");
                    $("#current_pass").val("");

                    //$('.user-profile-info-container #userEmail').html(data);
                },
            });
        }
    });

    $("#edit_user_password #current_pass").on("blur", function(event) {
        event.preventDefault();
        var userId = $("#userId").val();
        var current_pass = $("#current_pass").val();

        if (current_pass == "") {
            alert("current_pass is required");
        } else {
            $.ajax({
                url: "profile_edit.php",
                method: "POST",
                data: "current_pass=" + current_pass + "&userId=" + userId,
                //   beforeSend:function(){
                //        $('#insert').val("Inserting");
                //   },
                success: function(data) {
                    // $('#insert_form')[0].reset();
                    // $('#passwordModal').modal('hide');
                    $("#edit_user_password #check_pass").html(data);
                },
            });
        }
    });

    $("#support-website").on("click", function() {
        window.open("https://azora.tech/", "_blank");
    });

    $("#avatar-2").change(function(e) {
        $("#save-img").append(
            '<button type="submit" id="save-user-img" class="btn btn-primary " name="save_img">Save</button>'
        );
    });

    $(".fileinput-remove-button").click(function(e) {
        $("#save-user-img").remove();
    });

    $(document).on("change", ".switch", function(event) {
        let productID = $(this).find("input").attr("data-id");
        console.log(productID);
        $.ajax({
            type: "POST",
            url: "product_inventory_status.php",
            data: "id=" + productID,
            error: function(err) {
                console.log(err);
            },
        });
    });

    $(document).on("click", ".show-expired", function(e) {
        let trElement = $(e.currentTarget)
            .closest(".table")
            .find("tbody")
            .find("tr")
            .get();
        var today = new Date();
        var date =
            today.getFullYear() +
            "-" +
            (today.getMonth() + 1) +
            "-" +
            today.getDate();
        var time =
            today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var dateTime = date + " " + time;
        trElement.forEach((element) => {
            let expiryDate = $(element).children().eq(5).text();
            if (new Date(expiryDate) > new Date(dateTime)) {
                $(element).remove();
            }
        });
    });

    // $('.dropdown-item-edit').click(function(e){
    //     console.log(e.target.parentNode);
    // });

    //    $('.product_container ').click(function() {
    //        $name = $(this).children("p").text();
    //        $price = $(this).children(".price").text();
    //        $('.added_product .row').append('<div class="col-md-5"> <div class="product_item"><i class="fa fa-angle-right more"></i> <p>' + $name + '</p> </div> </div> <div class="col-md-3"><div class="product_Quantity"><div><i class="fa fa-plus"></i><span>5</span> <i class="fa fa-minus"></i></div> </div> </div><div class="col-md-2"><div class="product_price"><p>' + $price + '</p></div></div><div class="col-md-2"><div class="product_delete"><i class="fa fa-trash"></i></div> </div>');

    //    });

    // $('#prev').on('click', function () {
    //     var last = $('.logo').last().css({opacity: '0', width: '0px'});
    //     last.prependTo('.showrooms');
    //     last.animate({opacity: '1', width: '108px'});
    // });
    // $('#next').on('click', function () {
    //     var first = $('.logo').first();
    //     first.animate({opacity: '0', width: '0px'}, function() {
    //         first.appendTo('.showrooms').css({opacity: '1', width: '108px'});
    //     });
    // });

    // mobile menu for Docs
    $(".menu-burger").click(function() {
        // $('.main-menu').toggleClass("mobile-menu");
        $(this).toggleClass("clicked");
        // $('.mobile-menu').animate({ "height": "50vh" });
        // !$('.main-menu').hasClass("mobile-menu") ? $('.mobile-menu').animate({ "height": "0vh" }) : $('.mobile-menu').animate({ "height": "40vh" });
        // !$(this).hasClass("clicked") ? $('.mobile-menu').animate({ "height": "0vh" }) : $('.mobile-menu').animate({ "height": "40vh" });
        if ($(".main-menu").hasClass("fade")) {
            $(".main-menu").removeClass("fade").addClass("fade_reverse");
        } else if ($(".main-menu").hasClass("fade_reverse")) {
            $(".main-menu").removeClass("fade_reverse").addClass("fade");
        } else {
            $(".main-menu").addClass("fade");
        }
    });

    // mobile menu for user manual
    $(".manual-mobile button").click(function() {
        $(".manual-nav-wrapper-mobile").toggleClass("open");
        $(".manual-mobile button i").toggleClass("fa-times");
        //$('.manual-mobile button i').delay(300).animate({ rotate: '50deg' }, 500);
    });

    $(".nav-link").click(function() {
        $(".manual-nav-wrapper-mobile").removeClass("open");
    });

    var distance = $(".nav-wrapper").offset().top;

    $(window).scroll(function() {
        if ($(this).scrollTop() >= distance) {
            console.log("is in top");
            $(".nav-wrapper").css({
                position: "sticky",
                top: "2em",
                transition: "all 0.3s ease",
            });
        } else {
            console.log("is not in top");
            $(".nav-wrapper").css({
                position: "relative",
                top: "2em",
                transition: "all 0.3s ease",
            });
        }
    });
}); // document load end

$(".asideOverlay").click(function() {
    // console.log("overlay clicked");
    $("aside").toggleClass("nav-xs");
});

// var morphing = anime({
//     targets: "svg path",
//     d: "m-2,-110.30547c213.92539,-164.88947 427.85073,164.88946 641.77607,0l0,296.80101c-139.92534,-24.11052 -264.85068,196.11055 -641.77607,0l0,-296.80101z",
//     easing: "easeInOutQuad",
//     duration: 2000,
//     loop: true,
//     direction: "alternate",
// });