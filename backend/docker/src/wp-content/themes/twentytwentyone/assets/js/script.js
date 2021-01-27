var slider = new Swiper('.swiper-container', {
    // Optional parameters
    loop: true,
    effect: 'flip',
    grabCursor: true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

const name = document.querySelector('.form-item__name');
const email = document.querySelector('.form-item__email');
const birthday = document.querySelector('.form-item__birthday');
const tel = document.querySelector('.form-item__tel');
const checkbox = document.querySelector('.form-item__checkbox')

var promocode_form = document.querySelector('.promocode-form');


promocode_form.addEventListener("submit", function (event) {
    event.preventDefault();
    const server_message = document.querySelector('.promocode-form__server-message')
    server_message.className = 'promocode-form__server-message'
    const name_value = name.value.trim();
    const email_value = email.value.trim();
    const birthday_value = birthday.value.trim();
    const tel_value = tel.value.trim();
    const checbox_is_checked = checkbox.checked;


    const check_name_regex = /^[a-zA-Zа-яА-Я]+$/
    const check_email_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const check_birtday_regex = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/

    let is_form_valid = true;
    if (!check_name_regex.test(name_value)) {
        show_error(name, 'Ошибка при заполнении имени. Пример: Андрей')
        is_form_valid = false;
    } else {
        show_sucess(name)
    }

    if (!check_email_regex.test(email_value)) {
        show_error(email, 'Неверно указана почта')
        is_form_valid = false;
    } else {
        show_sucess(email)
    }

    if (!check_birtday_regex.test(birthday_value)) {
        show_error(birthday, 'Неверно указана дата рождения. Верный формат dd/mm/yyyy')
        is_form_valid = false;
    } else {
        show_sucess(birthday)
    }

    if (!checbox_is_checked) {
        show_error(checkbox.parentElement, 'Обязательно нужно поставить галочку')
        is_form_valid = false;
    } else {
        show_sucess(checkbox.parentElement)
    }

    if(!is_form_valid) {
        return false;
    }
    else {
        let user = new Object()
        user.name = name_value
        user.email = email_value
        user.tel = tel_value
        user.birthday = birthday_value
        const promocode = give_user_promocode_request(user)
    }

});

function show_error(input, message) {
    const form_item = input.parentElement
    const error_message = form_item.querySelector('.promocode-form__error-message')
    error_message.innerHTML = message
    form_item.className = 'promocode-form__item form-item promocode-form__item_wrong form-item'
}

function show_sucess(input) {
    const form_item = input.parentElement
    form_item.className = 'promocode-form__item form-item promocode-form__item_valid form-item'
}

function show_promo_to_user(server_message, json) {
    let promocode = json['response'];
    server_message.classList.toggle('promocode-form__server-message_active')
    server_message.innerHTML = promocode
}

function show_error_to_user(server_message, error_message) {

    server_message.classList.toggle('promocode-form__server-message_active_error')
    server_message.innerHTML = error_message
}

async function give_user_promocode_request(user) {
    const url = document.getElementById('ajax_handler_url').innerHTML;
    const server_message = document.querySelector('.promocode-form__server-message')
    server_message.className = 'promocode-form__server-message'
    const data = new FormData();
    data.append( 'action', 'give_user_promocode' );;
    try {
        const response = await fetch(url, {
            method: 'POST',
            credentials: 'same-origin',
            body: data,
        });
        const json = await response.json();
        show_promo_to_user(server_message, json)

    } catch (error) {
        show_error_to_user(server_message, error)
    }


}





