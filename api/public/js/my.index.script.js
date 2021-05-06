(function() {

    let phonenumber              = document.getElementById('phonenumber');
    let fio = document.getElementById('fio')
    let orgname = document.getElementById('organizationName')

    phonenumber.oninvalid = function(event) {
        event.target.setCustomValidity('Поле "номер телефона" может содержать только цифры, круглые скобки и знак дефис');
    }

    fio.oninvalid = function(event) {
        event.target.setCustomValidity('Поле "Ф.И.О." может содержать только буквы латинского и русского алфавита');
    }

    orgname.oninvalid = function(event) {
        event.target.setCustomValidity('Поле "Название организации" может содержать только буквы латинского и русского алфавита');
    }

})();

