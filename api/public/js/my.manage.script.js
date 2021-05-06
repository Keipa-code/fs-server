(function() {

    let phonenumber              = document.getElementById('phonenumber');
    let searchname = document.getElementById('searchRow')

    searchname.oninvalid = function(event) {
        event.target.setCustomValidity('Это поле может содержать только буквы латинского и русского алфавита');
    }
    phonenumber.oninvalid = function(event) {
        event.target.setCustomValidity('Поле "номер телефона" может содержать только цифры, круглые скобки и знак дефис');
    }

})();

