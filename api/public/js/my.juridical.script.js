(function() {

    let phonenumber = document.getElementById('phonenumber');
    let organizationName = document.getElementById('organizationName')
    let departmentName = document.getElementById('departmentName')
    let country = document.getElementById('country')
    let city = document.getElementById('city')
    let street = document.getElementById('street')
    let houseNumber = document.getElementById('houseNumber')
    let floatNumber = document.getElementById('floatNumber')


    organizationName.oninvalid = function(event) {
        event.target.setCustomValidity('Это поле может содержать только буквы латинского и русского алфавита');
    }

    departmentName.oninvalid = function(event) {
        event.target.setCustomValidity('Это поле может содержать только буквы латинского и русского алфавита');
    }

    country.oninvalid = function(event) {
        event.target.setCustomValidity('Это поле может содержать только буквы латинского и русского алфавита');
    }

    city.oninvalid = function(event) {
        event.target.setCustomValidity('Это поле может содержать только буквы латинского и русского алфавита');
    }

    street.oninvalid = function(event) {
        event.target.setCustomValidity('Это поле может содержать только буквы латинского и русского алфавита');
    }

    houseNumber.oninvalid = function(event) {
        event.target.setCustomValidity('Это поле может содержать только цифры, буквы латинского и русского алфавита');
    }

    floatNumber.oninvalid = function(event) {
        event.target.setCustomValidity('Это поле может быть пустым или содержать только цифры, буквы латинского и русского алфавита');
    }


    phonenumber.oninvalid = function(event) {
        event.target.setCustomValidity('Поле "номер телефона" может содержать только цифры, круглые скобки и знак дефис');
    }
})();

