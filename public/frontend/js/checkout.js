$(document).ready(function(){
    $('.form-coupon').submit(function(){
        $('.form-keep').each(function(key, input){
            let val = $(input).val();
            let name = $(input).attr('name');
            if(val) {
                localStorage.setItem(name, val);
            }
        })
        let htmlLocation = $('.form-location').html();
        localStorage.setItem('location', htmlLocation);
    })
    if (localStorage.getItem('location')) {
        $('.form-location').html(localStorage.getItem('location'));
    }
    $('.form-keep   ').each(function(key, input){
        let name = $(input).attr('name');
        let val = localStorage.getItem(name);
        if(val) {
            $(input).val(val);
        }
    })
    $('.payment_select').change(function(){
        if($(this).val()==0){
            $('.js-payment-paypal').show();
        }else{
            $('.js-payment-paypal').hide();
        }
    })
})
