var public_url = $('meta[name="base_url"]').attr('content');
$(document).on("keypress", ".noCharacterAllowed", function (e) {
    var regex = new RegExp("[a-zA-Z0-9\s]*$");

    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});
$(document).on("keypress", ".alphabetsAllowedOnly", function (e) {
    var regex = new RegExp("^[a-zA-Z, ]*$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});
$(document).on("keypress", ".numbersAllowedOnly", function (e) {
    var regex = new RegExp("^[0-9.]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});


$(function () {
    $('#loginForm').validate({
        rules: {
            "email": {
                required: true,
                email: true
            },
            "password": {
                required: true,

            },

        }
    });


    /* Validation for Change Password Start*/
    $('#ChangePasswordForm').validate({
        rules: {
            "oldpassword": {
                required: true,
                password: true

            },

            "newpassword": {
                required: true,
                minlength: 6,
                password: true,
                NotequalTo: '#usersCurrPass'


            },

            "password_confirmation": {
                required: true,
                minlength: 6,
                equalTo: '#newpassword'
            },
        }
    });

    $('#profileUpdate').validate({
        rules: {
            "email": {
                required: true,
                email: true
            },

        }
    });
    $('#addPage').validate({
        ignore: ".ignore",
        rules: {
            "title": {
                required: true,
            },
            "description": {
                required: true,
            },

        }
    });
    $('#AddRoleForm').validate({
        rules: {
            "role_name": {
                required: true,
            },
        }
    });

    $('#AddPermissionForm').validate({
        rules: {
            "role_id": {
                required: true,
            }
        },
        messages: {
            "role_id": "This field is required",
        }

    });

    $('#addScreenFrom').validate({
        rules: {
            "page_name": {
                required: true,
                alphanumeric: true,
            },
            "page_url": {
                required: true,
            },
            "label": {
                required: true,
            },
            "page_code": {
                required: true,
            },
            "module": {
                required: true,
            },
        }
    });


    $("#addPartner").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },
            image: {
                required: true,
                extension: 'jpeg|jpg|png',
                accept: true
            },
        },
        messages: {
            name: {
                required: "This field is required",

            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#editPartner").validate({
        rules: {
            name: {
                required: true,
            },

        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#addService").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },
            image: {
                required: true,
                extension: 'jpeg|jpg|png',
                accept: true
            },
            description: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },


            image: {
                required: "This field is required",
                extension: "*Please select image with extension jpeg,jpg and png.",
                accept: "*Please select image with extension jpeg,jpg and png."

            }

        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#editService").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#addBanner").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
                maxlength: 100,
            },

            sequence_number: {
                required: true,
                digits: true,

            },

            image: {
                required: true,
                //extension: 'jpeg|jpg|png',
                accept: true
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#editBanner").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
                maxlength: 100,
            },

            sequence_number: {
                required: true,
                digits: true,

            },

        },
        messages: {
            name: {
                required: "This field is required",
            },

        },

        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#addNews").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },
            image: {
                required: true,
                extension: 'jpeg|jpg|png',
                accept: true
            },

            news_date: {
                required: true,
            },

            description: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#editNews").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },

            news_date: {
                required: true,
            },

        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#addPublic").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },
            image: {
                required: true,
                extension: 'jpeg|jpg|png',
                accept: true
            },

        },
        messages: {
            name: {
                required: "This field is required",
            },
            image: {
                required: "*Please select the image",
                extension: "*Please select image with extension jpeg,jpg and png.",
                accept: "*Please select image with extension jpeg,jpg and png."

            }
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });
    $("#editPublic").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#addBoardDirector").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },
            designation: {
                required: true,
            },
            institute: {
                required: true,
            },
            image: {
                required: true,
                extension: 'jpeg|jpg|png',
                accept: true
            },

            description: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#editBoardDirector").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },
            designation: {
                required: true,
            },
            institute: {
                required: true,
            },

            description: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#addOrganizationType").validate({
        ignore: ".ignore",
        rules: {
            type: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#addTender").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },
            publishing_date: {
                required: true,
            },
            closing_date: {
                required: true,
            },
            image: {
                required: true,
                extension: 'pdf',
                accept: true
            },

            description: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#editTender").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },
            publishing_date: {
                required: true,
            },
            closing_date: {
                required: true,
            },
            image: {
                extension: 'pdf',
                accept: true
            },
            description: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    $("#addExpressInterest").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            company: {
                required: true,
            },
            tender_id: {
                required: true,

            },
            phone: {
                required: true,
                digits: true,
                maxlength: 10,
                /*minlength:10*/
            },

            comment: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },
        },
        submitHandler: function (form) {
            abc = 'sdsadsad';
            checkBeginningWhiteSpace(abc)
        }
    });

    /*validation for supplier form start*/

    /*validation for supplier form start*/

    $("#SupplierFirstStep").on('submit', function (e) {
        e.preventDefault();
        if($('#SupplierFirstStep').valid()){
            $.ajax({
                type: 'POST',
                url: public_url + "/registerFirstPost",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#firstStepButton').attr("disabled","true");
                    $('#secondStepButton').attr("disabled","true");
                    $('#thirdStepButton').attr("disabled","true");
                    $('#fourStepButton').attr('disabled',"true");
                },
                success: function (data) {
                    $('#fourStepButton').removeAttr('disabled');
                    $('#firstStepButton').removeAttr("disabled");
                    $('#secondStepButton').removeAttr("disabled");
                    $('#thirdStepButton').removeAttr("disabled");
                    if (data == '1') {
    
                        $("#step_1").removeClass("show active");
                        $("#tab_1").removeClass("active");
                        $("#step_2").addClass("active show");
                        $("#tab_2").addClass("active");
                        $("#supplier_id").val(data);
                    }
                    else {
                        $('#msgregister').html('<div style="color:#B6292D;" role="alert">There is a problem in form submission</div>');
                    }
    
                }
            });
            $('input[required]').on('input propertychange paste change', function () {
                var empty = $(this).find('input[required]').filter(function () {
                    return this.value == '';
                });
                $('button').prop('disabled', (empty.length))
    
            });
        }
     
    });

    $('#SupplierFirstStep').validate({
        errorElement: 'span',
        rules: {
            organization_name: {
                required: true,
                maxlength: 100,
            },
            name: {
                required: true,
                maxlength: 100,
            },

            email: {
                required: true,
                email: true
            },
            country_id: {
                required: true,

            },
            organization_type_id: {
                required: true,

            },
            tax_registration_no: {
                required: true,

            },
            country_code: {
                required: true,

            },
            mobile: {
                required: true,
                digits: true,
                maxlength: 10,
                /*minlength:10*/
            },
            area_code: {
                digits: true,
            },
            landline_no: {

                digits: true,
            },
            trade_license_file: {

                required: true,
            },
        },

        messages: {
            name: {
                required: "This field is required",
            },
        },

    });

    $("#secondStepButton").click(function (e) {
        e.preventDefault();

        if ($("#SupplierSecondStep").valid()) {
            var formdata = $('#SupplierSecondStep').serialize();
            $.ajax({
                type: "POST",
                url: public_url + "/registerSecondPost",
                data: formdata,
                beforeSend: function () {
                    $('#firstStepButton').attr("disabled","true");
                    $('#secondStepButton').attr("disabled","true");
                    $('#thirdStepButton').attr("disabled","true");
                    $('#fourStepButton').attr('disabled',"true");
                },
                success: function (data) {
                    $('#fourStepButton').removeAttr('disabled');
                    $('#firstStepButton').removeAttr("disabled");
                    $('#secondStepButton').removeAttr("disabled");
                    $('#thirdStepButton').removeAttr("disabled");
                    if (data == '1') {
                        $("#step_2").removeClass("show active");
                        $("#tab_2").removeClass("active");
                        $("#step_3").addClass("active show");
                        $("#tab_3").addClass("active");
                    }
                    else {
                        $('#msgregister').html('<div style="color:#B6292D;" role="alert">There is a problem in form submission</div>');
                    }

                }
            });

        }
    });

    $('#SupplierSecondStep').validate({
        errorElement: 'span',
        rules: {
            bank_name: {
                required: true,
            },

            branch_name: {
                required: true,
            },
            currency: {
                required: true,

            },
            account_no: {
                required: true,
                digits: true,
            },
            

        },

    });

    $("#thirdStepButton").click(function (e) {
        e.preventDefault();

        if ($("#SupplierThirdStep").valid()) {
            var formdata = $('#SupplierThirdStep').serialize();
            $.ajax({
                type: "POST",
                url: public_url + "/registerThirdPost",
                data: formdata,
                beforeSend: function () {
                    $('#firstStepButton').attr("disabled","true");
                    $('#secondStepButton').attr("disabled","true");
                    $('#thirdStepButton').attr("disabled","true");
                    $('#fourStepButton').attr('disabled',"true");
                },
                success: function (data) {
                    $('#fourStepButton').removeAttr('disabled');
                    $('#firstStepButton').removeAttr("disabled");
                    $('#secondStepButton').removeAttr("disabled");
                    $('#thirdStepButton').removeAttr("disabled");
                    if (data == '1') {

                        $("#step_3").removeClass("show active");
                        $("#tab_3").removeClass("active");
                        $("#step_4").addClass("active show");
                        $("#tab_4").addClass("active");
                    }
                    else {
                        $('#msgregister').html('<div style="color:#B6292D;" role="alert">There is a problem in form submission</div>');
                    }

                }
            });

        }
    });

    $('#SupplierThirdStep').validate({
        errorElement: 'span',
        rules: {
            service_type: {
                required: true,
            },

            supplier_type: {
                required: true,
            },
        },

    });


    $("#SupplierFourStep").on('submit', function (e) {
        e.preventDefault();
        
        // if(($('#SupplierFirstStep').valid()&&$('#SupplierSecondStep').valid()&&$('#SupplierThirdStep').valid())){
            // }
            var isError=false;
            $('#SupplierFirstStep').parents('.inner_tab.tab-pane').find('input[required], select[required], textarea[required]').each(function(){
                if ($(this)&&!$(this).valid()){
                    isError= true;
                }
            });
            $('#SupplierSecondStep').parents('.inner_tab.tab-pane').find('input[required], select[required], textarea[required]').each(function(){
                if ($(this)&&!$(this).valid()){
                    isError= true;
                }
            });
            $('#SupplierThirdStep').parents('.inner_tab.tab-pane').find('input[required], select[required], textarea[required]').each(function(){
                if ($(this)&&!$(this).valid()){
                    isError= true;
                }
            });
            if(isError){
                swal("Error","Validation failed. Please fill the required fields in all the sections of the form.");
                return false;
            }
            $('#fourStepButton').attr('disabled','true');
        iso_value = $('input[name="ISO_14001"]:checked').val();
        if (iso_value == "yes") {

            var iso_14001_file = document.getElementById('iso_14001_file');
            if (iso_14001_file.files.length === 0) {
                $('#iso_error').html('<div style="color:#B6292D;" role="alert">Attachment Required</div>');
                iso_14001_file.focus();

                return false;
            }
        }else {
            $('#iso_error').html('');
        }
        licence_value = $('input[name="licence"]:checked').val();
        if (licence_value == "yes") {

            var licence_file = document.getElementById('licence_file');
            if (licence_file.files.length === 0) {
                $('#licence_error').html('<div style="color:#B6292D;" role="alert">Attachment Required</div>');
                licence_file.focus();
                return false;
            }
        }
        else {
            $('#licence_error').html('');
        }
            $.ajax({
            type: 'POST',
            url: public_url + "/registerFourPost",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#firstStepButton').attr("disabled","true");
                $('#secondStepButton').attr("disabled","true");
                $('#thirdStepButton').attr("disabled","true");
                $('#fourStepButton').attr('disabled',"true");
                $('#loader').show();
                // $('#fourStepButton').html('<div><div class="spinner-border text-light" role="status"><span class="sr-only">Loading...</span> </div> Submit</div>');

                //$('#SupplierFirstStep').css("opacity",".5");
            },
            success: function (data) {
                $('#fourStepButton').removeAttr('disabled');
                $('#firstStepButton').removeAttr("disabled");
                $('#secondStepButton').removeAttr("disabled");
                $('#thirdStepButton').removeAttr("disabled");
                $('#fourStepButton').html("Submit");
                $('#loader').hide();
                if (data != '') {
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#msgregister').html('<div style="color:#B6292D;" role="alert">Your form is submitted successfullyq</div>');

                    // swal("Your submission has been sent ", "Thank you for taking the time to fill our form and for your interest in becoming a supplier for National Ambulance.", "success").then(data => {
                        $("html, body").animate({ scrollTop: 0 }, "slow");    
                     document.getElementById("SupplierFirstStep").reset();
                        document.getElementById("SupplierSecondStep").reset();
                        document.getElementById("SupplierThirdStep").reset();
                        document.getElementById("SupplierFourStep").reset();
                        
                        location.reload(true);
                    // });


                }
                else {
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#msgregister').html('<div style="color:#B6292D;" role="alert">There is a problem in form submission</div>');
                    swal("Error", "There is a problem in form submission", "error");
                }

            }
        });
        
        
    });
    /*validation for supplier form end*/
    /*validation for contact form start*/
    $('#contactForm').validate({
        // errorElement: 'span',
        // rules: {
        //     enquiry_type: {
        //         required: true,

        //     },
        //     title: {
        //         required: true,
        //     },
        //     name: {
        //         required: true,
        //         maxlength: 100,
        //     },

        //     email: {
        //         required: true,
        //         email: true
        //     },
        //     country: {
        //         required: true,
        //     },
            

        //     mobile: {
        //         required: true,
        //         digits: true,

        //     },
        //     description: {
        //         required: true,
        //     },
            
        //     agreement: {
        //         required: true,
        //     },
           

        // },

    });
    /*validation for contact form end*/
});

function goToFirst() {
    $("#step_2").removeClass("show active");
    $("#tab_2").removeClass("active");
    $("#step_1").addClass("active show");
    $("#tab_1").addClass("active");
}
function goToSecond() {
    $("#step_3").removeClass("show active");
    $("#tab_3").removeClass("active");
    $("#step_2").addClass("active show");
    $("#tab_2").addClass("active");
}
function goToThird() {
    $("#step_4").removeClass("show active");
    $("#tab_4").removeClass("active");
    $("#step_3").addClass("active show");
    $("#tab_3").addClass("active");
}