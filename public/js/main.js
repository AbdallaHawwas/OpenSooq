var favicon = new Favico({
    bgColor: '#dc0000',
    textColor: '#fff',
    animation: 'slide',
    fontStyle: 'bold',
    fontFamily: 'sans',
    type: 'circle'
});
$("#validate-form").validate({ignore: [],});
document.addEventListener("DOMContentLoaded", function(event) {
   $.extend( $.validator.messages, {
        required: "برجاء ملئ هذا الحقل",
        remote: "يرجى تصحيح هذا الحقل للمتابعة",
        email: "رجاء إدخال عنوان بريد إلكتروني صحيح",
        url: "رجاء إدخال عنوان موقع إلكتروني صحيح",
        date: "رجاء إدخال تاريخ صحيح",
        dateISO: "رجاء إدخال تاريخ صحيح (ISO)",
        number: "رجاء إدخال عدد بطريقة صحيحة",
        digits: "رجاء إدخال أرقام فقط",
        creditcard: "رجاء إدخال رقم بطاقة ائتمان صحيح",
        equalTo: "رجاء إدخال نفس القيمة",
        extension: "رجاء إدخال ملف بامتداد موافق عليه",
        maxlength: $.validator.format( "الحد الأقصى لعدد الحروف هو {0}" ),
        minlength: $.validator.format( "الحد الأدنى لعدد الحروف هو {0}" ),
        rangelength: $.validator.format( "عدد الحروف يجب أن يكون بين {0} و {1}" ),
        range: $.validator.format( "رجاء إدخال عدد قيمته بين {0} و {1}" ),
        max: $.validator.format( "رجاء إدخال عدد أقل من أو يساوي {0}" ),
        min: $.validator.format( "رجاء إدخال عدد أكبر من أو يساوي {0}" )
    });
});
Fancybox.bind("[data-fancybox]", {});
Fancybox.bind("img.data-fancybox", {});
Fancybox.bind(".data-fancybox img", {});
$('.asideToggle').on('click', function() {
    $('.aside').toggleClass('active');
    $('.aside').toggleClass('in-active');
    $('.main-content').toggleClass('active');
    $('.main-content').toggleClass('in-active');
});
$("a[href='" + window.location.href + "'] >div").addClass('active');
$('.alert-click-hide').on('click', function() {
    $(this).fadeOut();
});
toastr.options = {progressBar:true,preventDuplicates:true,newestOnTop:true,positionClass:'toast-top-left',timeOut:10000}
let smart_alert = toastr;

//const flatpickr = require("flatpickr");

flatpickr("input[type='date']", {
    enableTime: false,
    dateFormat: "Y-m-d",
});

$("#users select").select2({
    closeOnSelect:false,
});
$("#special_user").on("change",function(){
    if($("#special_user").val() == 1){
        $("#users").css("display","block");
    }else{
        $("#users").css("display","none");
    }
});

// Add images To select on select2
function custom_template(obj){
        var data = $(obj.element).data();
        var text = $(obj.element).text();
        if(data && data['img_src']){
            img_src = data['img_src'];
            template = $("<div class='d-flex' style='margin-top: 10px;'><img style='width: 50px;height: 50px; border-radius: 50px;margin-right: 10px;' src=" + img_src + "><p style=\"font-weight: 700;margin-top: 10px;font-size:14pt;text-align:center;\">" + text + "</p></div>");
            return template;
        }
    }

//  Login steps 
function stepTwo(name,email,phone,photo){
    const firstForm = $("form[name='first-step']");
    const secondForm = $("form[name='second-step']");

    if (firstForm.css("display") != "none" && secondForm.css("display") == "none"){
        firstForm.css("display","none");
        secondForm.removeClass("d-none");
        secondForm.children("input[name='email']").val(email);
        secondForm.children("input[name='phone']").val(phone);
        $("h3.user_name").html($("h3.user_name").html() + name);
        if(photo){
            $("img.user_photo").attr("src", "/storage/uploads/users/" +photo);
        }else{
            $("img.user_photo").attr("src", "/images/default/avatar.png");
        }
    }
}
function loginReverse(){
    const firstForm = $("form[name='first-step']");
    const secondForm = $("form[name='second-step']");
    if (firstForm.css("display") == "none" && secondForm.css("display") != "none"){
        firstForm.css("display","block");
        secondForm.addClass("d-none");
        secondForm.children("input[name='email']").val('');
        secondForm.children("input[name='phone']").val('');
        $("h3.user_name").html('');
        $("img.user_photo").attr("src", "/images/default/avatar.png");
    }
}