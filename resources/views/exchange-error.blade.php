<div class="col-md-9">
    <!-- Выбор направления обмена -->
    <!-- ngIf: getCurrentStep() === steps.selectDirection -->

    <!-- Ввод данных заявки -->
    <!-- ngIf: getCurrentStep() === steps.calculator -->

    <!-- Управление заявкой -->
    <!-- ngIf: getCurrentStep() === steps.transaction --><!-- ngInclude: 'app/pages/exchange/transaction.html' --><div ng-if="getCurrentStep() === steps.transaction" ng-controller="transactionCtrl" ng-include="'app/pages/exchange/transaction.html'" class="ng-scope"><!-- ngIf: transaction --><div class="row transaction ng-scope" ng-if="transaction">
            <!-- ngInclude: getTransactionTemplate(transaction.transactionStatusId, transaction.sourceCurrencyId, transaction.transactionPreviousStatusId) --><div ng-include="getTransactionTemplate(transaction.transactionStatusId, transaction.sourceCurrencyId, transaction.transactionPreviousStatusId)" class="ng-scope" style=""><div class="col-md-12 ng-scope">
                    <h1>
                        Обмен по заявке
                        <span class="text-light ng-binding">№2538697 от 22.02.2018</span>
                        отменен
                    </h1>

                    <br>

                    <div class="row">
                        <div class="col-md-8">
                            <p class="ng-binding">Обмен по заявке №2538697 отменен.</p>

                            <p>
                                Если оплата была произведена после отмены операции, или наш сервис не видит оплату по другим причинам,
                                не переживайте, мы найдем Ваш платеж в ручном режиме.
                            </p>

                            <p>
                                Для обращения в службу поддержки создайте тикет в нашем
                                <a href="http://support.netexchange.ru/" target="_blank">хелп-деск</a>.
                                Операторы обязательно ответят на Ваше сообщение, найдут платеж и завершат обмен.
                            </p>

                            <br>

                            <button class="col-md-6 btn btn-primary netexchange-button" ng-click="newExchange()">
                                Новый обмен
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end ngIf: transaction -->

        <div class="row ng-scope">
            <div class="col-md-8">
                <div page-loader="!transaction" class="ng-isolate-scope"></div>
                <!-- ngInclude: 'images/loader.svg' --><div class="page-loader ng-scope ng-hide" ng-show="pageLoader" ng-include="'images/loader.svg'"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="30px" viewBox="0 0 24 30" xml:space="preserve">
    <rect x="0" y="10.609" width="4" height="9.7821">
        <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
        <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
    </rect>
                        <rect x="10" y="11.391" width="4" height="8.2179">
                            <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                            <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="20" y="7.39105" width="4" height="16.2179">
                            <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                            <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                        </rect>
  </svg></div></div>
        </div>
    </div><!-- end ngIf: getCurrentStep() === steps.transaction -->
</div>
