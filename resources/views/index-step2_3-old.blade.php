<div class="col-md-8 login">
    <div class="row">
        <div class="col-md-12" id="order_result_output">
            <h2 style="margin-bottom:0;text-align:center">Ваша заявка обрабатывается</h2>
            <h4 style="margin-bottom:30px;text-align:center">Это займёт примерно 3 минуты.<br>Пока Вы ждёте - пожалуйста
                пройдите наш тест!</h4>
            <div class="page-loader" style="margin:0">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="24px" height="30px" viewBox="0 0 24 30" xml:space="preserve">
                    <rect x="0" y="5.44444" width="4" height="20.1111">
                        <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0s"
                                 dur="0.6s" repeatCount="indefinite"></animate>
                        <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0s" dur="0.6s"
                                 repeatCount="indefinite"></animate>
                    </rect>

                    <rect x="10" y="9.44444" width="4" height="12.1111">
                        <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.15s" dur="0.6s"
                                 repeatCount="indefinite"></animate>
                        <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.15s" dur="0.6s"
                                 repeatCount="indefinite"></animate>
                    </rect>

                    <rect x="20" y="12.5556" width="4" height="5.88889">
                        <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.3s" dur="0.6s"
                                 repeatCount="indefinite"></animate>
                        <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.3s" dur="0.6s"
                                 repeatCount="indefinite"></animate>
                    </rect>
                </svg>
            </div>

            <div id="userTest" style="margin:100px 0 0">
                <h2 style="margin-bottom:0;text-align:center">Для улучшения качества обслуживания<br>пожалуйста пройдите
                    тест!</h2>
                <h5 style="text-align:center">Пройдя этот тест вы очень поможете нам!</h5>
                <div style="margin-top:20px;text-align:center;">
                    <button class="btn btn-primary tradechange-btn btn-test left"
                            onclick="document.getElementById('userTest').style.display = 'none';
                               document.getElementById('userTestContent').style.display = '';">Пройти тест</button>
                    <button class="btn btn-primary tradechange-btn btn-test"
                            onclick="document.getElementById('userTest').style.display = 'none';">Отказаться</button>
                </div>
            </div>

            <div id="userTestContent" style="margin:100px 0 0;display:none;">
                <div class="row">
                    <div class="col-md-12" style="font-size:26px;">Кто посоветовал вам нас?</div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_adviced_friends" class="css-checkbox">
                        <label for="who_adviced_friends" class="checkbox">Друзья</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_adviced_email" class="css-checkbox">
                        <label for="who_adviced_email" class="checkbox">Пришло сообщение на почту</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_adviced_ads" class="css-checkbox">
                        <label for="who_adviced_ads" class="checkbox">Реклама на другом сайте</label>
                    </div>

                    <div class="col-md-12" style="font-size:26px;margin:26px 0 0">
                        Были ли трудности в оформлении заказа?
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_order_hard_no" class="css-checkbox">
                        <label for="who_order_hard_no" class="checkbox">Трудностей не было</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_order_hard_yes" class="css-checkbox">
                        <label for="who_order_hard_yes" class="checkbox">Да, были трудности</label>
                    </div>

                    <div class="col-md-12" style="font-size:26px;margin:26px 0 0">
                        Нужно ли нам ещё усовершненствовать наш сервис?
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_upgrade_no" class="css-checkbox">
                        <label for="who_upgrade_no" class="checkbox">Нет, всё замечательно</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_upgrade_yes" class="css-checkbox">
                        <label for="who_upgrade_yes" class="checkbox">Да, хотелось бы видить улучшения</label>
                    </div>

                    <div class="col-md-12" style="font-size:26px;margin:26px 0 0">
                        Какие платежные системы Вы хотите видеть на нашем сервисе?
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_paysystem_qiwi" class="css-checkbox">
                        <label for="who_paysystem_qiwi" class="checkbox">Qiwi</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_paysystem_visa_mc" class="css-checkbox">
                        <label for="who_paysystem_visa_mc" class="checkbox">Visa/MasterCard</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_paysystem_wm" class="css-checkbox">
                        <label for="who_paysystem_wm" class="checkbox">WebMoney</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_paysystem_pp" class="css-checkbox">
                        <label for="who_paysystem_pp" class="checkbox">PayPal</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_paysystem_ab" class="css-checkbox">
                        <label for="who_paysystem_ab" class="checkbox">Альфа-Банк</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_paysystem_cryptos" class="css-checkbox">
                        <label for="who_paysystem_cryptos" class="checkbox">Криптовалюты</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_paysystem_cryptostock" class="css-checkbox">
                        <label for="who_paysystem_cryptostock" class="checkbox">Криптобиржы</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_paysystem_more" class="css-checkbox">
                        <label for="who_paysystem_more" class="checkbox">Чем больше тем лучше</label>
                    </div>

                    <div class="col-md-12" style="font-size:26px;margin:26px 0 0">
                        Будете ли Вы пользоваться нашим сервисом для продажи Bitcoin?
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_bitcoin_no" class="css-checkbox">
                        <label for="who_bitcoin_no" class="checkbox">Да, конечно</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_bitcoin_yes" class="css-checkbox">
                        <label for="who_bitcoin_yes" class="checkbox">Нет, я только покупаю биткоин</label>
                    </div>

                    <div class="col-md-12" style="font-size:26px;margin:26px 0 0">
                        Вы бы посоветовали нас своим друзьям или партнерам?
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_suggest_yes" class="css-checkbox">
                        <label for="who_suggest_yes" class="checkbox">Да, конечно</label>
                    </div>
                    <div class="col-md-12 form-group tradechange-checkbox" style="margin-bottom:0">
                        <input type="checkbox" id="who_suggest_no" class="css-checkbox">
                        <label for="who_suggest_no" class="checkbox">Нет, мне не понравился ваш сервис</label>
                    </div>

                    <div style="margin-top:20px;text-align:center;" class="col-md-12">
                        <button onclick="document.getElementById('userTestContent').style.display = 'none';
                            document.getElementById('userTestSuccess').style.display = '';"
                                class="btn btn-primary tradechange-btn btn-test">Отправить</button>
                    </div>
                </div>
            </div>

            <div id="userTestSuccess" style="margin:100px 0 0;display:none;">
                <h2 style="margin-bottom:0;text-align:center;font-size:26px;">Спасибо за ответы!</h2>
                <h5 style="text-align:center">Мы очень ценим Ваш отзыв, стараемся быть лучшими для Вас!</h5>
            </div>
        </div>
    </div>
</div>
<script>
    window.EX_ORDER_PARAMS = {order_id: +'{{ $ex_order->id }}', order_hash: '{{ $ex_order_sha256 }}'};
</script>
