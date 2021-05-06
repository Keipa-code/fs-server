(function() {

    let phonenumber = document.getElementById('phonenumber');
    let firstname = document.getElementById('firstname')
    let surname = document.getElementById('surname')
    let patronymic = document.getElementById('patronymic')


    firstname.oninvalid = function(event) {
        event.target.setCustomValidity('Это поле может содержать только буквы латинского и русского алфавита');
    }

    surname.oninvalid = function(event) {
        event.target.setCustomValidity('Это поле может содержать только буквы латинского и русского алфавита');
    }

    patronymic.oninvalid = function(event) {
        event.target.setCustomValidity('Это поле может содержать только буквы латинского и русского алфавита');
    }

    phonenumber.oninvalid = function(event) {
        event.target.setCustomValidity('Поле "номер телефона" может содержать только цифры, круглые скобки и знак дефис');
    }
})();

