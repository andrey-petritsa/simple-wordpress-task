<?php

$slides_urls = array();
$slides_urls[0] = get_template_directory_uri() . '/assets/images/slider-01.jpg';
$slides_urls[1] = get_template_directory_uri() . '/assets/images/slider-02.jpg';
$parallax_image_url = get_template_directory_uri() . '/assets/images/parallax.jpg'
?>

<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide">
            <div class="swiper-slide__background-image swiper-slide__background-image_image_1" style="<? echo "background-image:url('{$slides_urls[0]}')" ?>">
                <div class="swiper-slide__text">
                    WELCOME
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="swiper-slide__background-image swiper-slide__background-image_image_2" style="<? echo "background-image:url('{$slides_urls[1]}')" ?>">
                <div class="swiper-slide__text">
                    2021 - ХОРОШИЙ ГОД
                </div>
            </div>
        </div>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>
</div>
<div class="fullscreen fullscreen_bg" style="<? echo "background-image:url('{$parallax_image_url}')" ?>"></div>

<form class="promocode-form" action="">
    <div class="promocode-form__header">Заполните форму, чтобы получить промокод</div>
    <div class="promocode-form__item form-item">
        <label for="name">Имя*</label>
        <input id="name" class="form-item__name" type="text" placeholder="Андрей">
        <div class="promocode-form__validation-icons">
            <div class="promocode-form__valid-icon promocode-form__icon">
                <i class="fas fa-thumbs-up"></i>
            </div>
            <div class="promocode-form__wrong-icon promocode-form__icon">
                <i class="far fa-window-close"></i>
            </div>
        </div>
        <div class="promocode-form__error-message"></div>
    </div>
    <div class="promocode-form__item form-item">
        <label for="email">E-mail*</label>
        <input id="email" class="form-item__email" type="text" placeholder="example@mail.ru">
        <div class="promocode-form__validation-icons">
            <div class="promocode-form__valid-icon promocode-form__icon">
                <i class="fas fa-thumbs-up"></i>
            </div>
            <div class="promocode-form__wrong-icon promocode-form__icon">
                <i class="far fa-window-close"></i>
            </div>
        </div>
        <div class="promocode-form__error-message"></div>
    </div>
    <div class="promocode-form__item form-item">
        <label for="birtday">Дата рождения*</label>
        <input id="birtday" class="form-item__birthday" type="text" placeholder="Пример: 25/03/1987">
        <div class="promocode-form__validation-icons">
            <div class="promocode-form__valid-icon promocode-form__icon">
                <i class="fas fa-thumbs-up"></i>
            </div>
            <div class="promocode-form__wrong-icon promocode-form__icon">
                <i class="far fa-window-close"></i>
            </div>
        </div>
        <div class="promocode-form__error-message"></div>
    </div>
    <div class="promocode-form__item form-item">
        <label for="name">Телефон</label>
        <input id="tel" class="form-item__tel" type="tel">
        <div class="promocode-form__validation-icons">
            <div class="promocode-form__valid-icon promocode-form__icon">
                <i class="fas fa-thumbs-up"></i>
            </div>
            <div class="promocode-form__wrong-icon promocode-form__icon">
                <i class="far fa-window-close"></i>
            </div>
        </div>
        <div class="promocode-form__error-message"></div>
    </div>
    <div class="promocode-form__item">
        <div class="checkbox">
            <input type="checkbox" class="form-item__checkbox" name="" id="checkbox">
            <label for="checkbox">Я даю свое согласие на обработку персональных данных в соответствии с <span><a
                        href="">Условиями*</a></span></label>
        </div>
        <div class="promocode-form__error-message"></div>
    </div>
    <div class="promocode-form__item">
        <button type="submit" class="promocode-form__button">Получить промокод</button>
    </div>
    <div class="promocode-form__server-message"></div>

</form>
<div class="fullscreen fullscreen_bg" style="<? echo "background-image:url('{$parallax_image_url}')" ?>"></div>

<?php
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    global $wpdb;

    for ($i = 0; $i <= 10; $i++) {
        $random_promocode = generateRandomString(5);
        $insert_promocode_sql = "INSERT INTO promocodes (promocode, is_given) VALUES ('$random_promocode', 0)";
        $wpdb->query($wpdb->prepare($insert_promocode_sql));
    }
?>