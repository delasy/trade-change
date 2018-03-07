(function (w) {
    /** @namespace w.PAGE_CURRENCIES */
    /** @namespace w.PAGE_EXCHANGE_CURRENCIES */
    var d = w.document;
    var ajax = {};

    var s = function () {
        if (typeof XMLHttpRequest !== 'undefined') return new XMLHttpRequest();
        var versions = [
            'MSXML2.XmlHttp.6.0',
            'MSXML2.XmlHttp.5.0',
            'MSXML2.XmlHttp.4.0',
            'MSXML2.XmlHttp.3.0',
            'MSXML2.XmlHttp.2.0',
            'Microsoft.XmlHttp'
        ];

        var xhr;
        for (var i = 0; i < versions.length; i++) {
            try {
                xhr = new ActiveXObject(versions[i]);
                break;
            } catch (e) {}
        }

        return xhr;
    };

    var as = function (url, callback, method, data, async) {
        if (typeof async === 'undefined') async = true;

        var x = s();

        x.open(method, url, async);
        x.onload = function () {
            if (x.readyState === 4 && typeof callback === 'function') callback(x.responseText);
        };

        if (method === 'POST') x.setRequestHeader('Content-type','application/x-www-form-urlencoded');

        return x.send(data);
    };

    ajax.get = function (url, data, callback, async) {
        var query = [];
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
            }
        }

        return as(url + (query.length ? '?' + query.join('&') : ''), callback, 'GET', null, async);
    };

    ajax.post = function (url, data, callback, async) {
        var query = [];

        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
            }
        }

        return as(url, callback, 'POST', query.join('&'), async);
    };

    (function() {
        function decimalAdjust(type, value, exp) {
            if (typeof exp === 'undefined' || +exp === 0) {
                return Math[type](value);
            }
            value = +value;
            exp = +exp;

            if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
                return NaN;
            }

            value = value.toString().split('e');
            value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
            value = value.toString().split('e');
            return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
        }

        if (!Math.round10) {
            Math.round10 = function(value, exp) {
                return decimalAdjust('round', value, exp);
            };
        }
        if (!Math.floor10) {
            Math.floor10 = function(value, exp) {
                return decimalAdjust('floor', value, exp);
            };
        }
        if (!Math.ceil10) {
            Math.ceil10 = function(value, exp) {
                return decimalAdjust('ceil', value, exp);
            };
        }
    })();

    function APP_LISTEN(el, ev, fn) {
        var _self = el;

        /** @namespace _self.attachEvent */
        if (_self.addEventListener) {
            return _self.addEventListener(ev, fn, false);
        } else if (_self.attachEvent) {
            return _self.attachEvent('on' + ev, fn);
        } else {
            ev = 'on' + ev;
            if (typeof _self[ev] === 'function') {
                fn = (function (f1, f2) {
                    return function () {
                        f1.apply(this, arguments);
                        f2.apply(this, arguments);
                    };
                })(_self[ev], fn);
            }
            _self[ev] = fn;
            return _self[ev];
        }
    }

    function triggerEvent(el, type){
        var e;

        if ('createEvent' in d) {
            e = d.createEvent('HTMLEvents');
            e.initEvent(type, false, true);
            el.dispatchEvent(e);
        } else {
            e = d['createEventObject']();
            e.eventType = type;
            el['fireEvent']('on' + e.eventType, e);
        }
    }

    w.f_CHANGE_PAGE_OUT = function f_CHANGE_PAGE_OUT(index) {
        index = +index;
        if (index < 1) return console.error('Wrong first argument for function CHANGE_PAGE_OUT');
        if (typeof w.PAGE_CURRENCIES !== 'object') return console.error('PAGE_CURRENCIES object is not present for' +
            ' function CHANGE_PAGE_OUT');
        if (!w.PAGE_CURRENCIES.hasOwnProperty(index)) return console.error('PAGE_CURRENCIES has not key which '
            + 'was added as first argument for function CHANGE_PAGE_OUT');

        var out_currencies = w.PAGE_CURRENCIES[index];
        var element = f_D('PAGE_CURRENCY_' + index);
        var in_container = f_D('PAGE_STEP1_CURRENCY_OUT');

        if (!element || !in_container) return console.error('Cannot find containers for function CHANGE_PAGE_OUT');

        in_container.innerHTML = '';
        f_D('PAGE_FORM_OUT_CURRENCY').value = index;
        var temps = f_C('app-index-out-currencies');
        for (var k = 0; k < temps.length; k++) f_RMV_CLASS(temps[k], 'active');
        f_ADD_CLASS(element, 'active');

        for (var j = 0; j < out_currencies.length; j++) {
            var out_currency = out_currencies[j];

            in_container.innerHTML += '<li class="currency top-slide-animation app-index-out-currencies"' +
                ' id="PAGE_CURRENCY_IN_' + out_currency['id'] + '"' +
                ' onclick="f_CHANGE_PAGE_IN(' + out_currency['id'] + ');">' +
                '<span class="background"></span>' +
                '<span class="ico"><img src="' + out_currency['img'] + '"></span>' +
                '<div>' +
                    '<div class="title"><span class="ps-name">' + out_currency['full_name'] + '</span></div>' +
                    '<div class="rate"><!--1 : 20-->' +
                        '<span class="text-muted"><!--| -->Резерв:</span> ' + out_currency['reserve'] +
                    '</div>' +
                '</div>' +
                '</li>';
        }
    };

    w.f_CHANGE_PAGE_IN = function f_CHANGE_PAGE_IN(index) {
        f_D('PAGE_FORM_IN_CURRENCY').value = index;
        f_D('PAGE_STEP1_FORM').submit();
    };

    function f_D(str) {
        return d.getElementById(str);
    }

    function f_C(str) {
        return d.getElementsByClassName(str);
    }

    function f_RMV_CLASS(el, cls) {
        if (f_HAS_CLASS(el, cls)) {
            el.className = (' ' + el.className + ' ').replace(' ' + cls, '');

            f_CLEAR_CLASS(el);
        }
    }

    function f_ADD_CLASS(el, cls) {
        if (!f_HAS_CLASS(el, cls)) {
            f_CLEAR_CLASS(el);

            el.className += ' ' + cls;
        }
    }

    function f_HAS_CLASS(el, cls) {
        return (' ' + el.className + ' ').indexOf(cls) !== -1;
    }

    function f_CLEAR_CLASS(el) {
        if (el.className === '') return;

        while (el.className.substr(0, 1) === ' ') {
            el.className = el.className.substr(1);
        }

        while (el.className.substr(el.className.length - 1) === ' ') {
            el.className = el.className.substr(0, el.className.length - 1);
        }
    }

    var targets = d.getElementsByClassName('tradechange-input');

    for (var i = 0; i < targets.length; i++) {
        var target = targets[i];
        var target_input = target.getElementsByTagName('input')[0];

        if (target_input.value.trim() !== '') f_ADD_CLASS(target_input, 'not-empty');

        APP_LISTEN(target_input, 'change', function TARGET_INPUT_CHANGE() {
            var is_dirty = this.value.trim() !== '';

            f_RMV_CLASS(this.parentNode, 'has-error');

            if (is_dirty) f_ADD_CLASS(this, 'not-empty');
            else f_RMV_CLASS(this, 'not-empty');
        });
    }

    function calcIn(val) {
        var in_in_rate = parseFloat(w.PAGE_EXCHANGE_CURRENCIES['in']['ex_in_rate']);
        var out_out_rate = parseFloat(w.PAGE_EXCHANGE_CURRENCIES['out']['ex_out_rate']);
        var delta = out_out_rate / in_in_rate;
        var result = parseFloat(val) === 0 ? 0 : parseFloat(val) * delta;

        return 100 * result / 99;
    }

    function calcOut(val) {
        var in_in_rate = parseFloat(w.PAGE_EXCHANGE_CURRENCIES['in']['ex_in_rate']);
        var out_out_rate = parseFloat(w.PAGE_EXCHANGE_CURRENCIES['out']['ex_out_rate']);
        var delta = out_out_rate / in_in_rate;
        if (parseFloat(val) === 0) return 0;
        var result = 99 * parseFloat(val) / 100;

        return result / delta;
    }

    var exchangeTimerIn = null;
    var exchangeTimerOut = null;

    if (w.hasOwnProperty('PAGE_EXCHANGE_CURRENCIES') && f_D('sourceAmount') && f_D('targetAmount')) {
        APP_LISTEN(f_D('sourceAmount'), 'keyup', function () {
            w.clearTimeout(exchangeTimerIn);

            if (this.value === '') {
                this.value = parseFloat(w.PAGE_EXCHANGE_CURRENCIES['out']['min_val']).toFixed(
                    w.PAGE_EXCHANGE_CURRENCIES['out']['ch_after_point']
                );
            }

            f_D('targetAmount').value = Math.round10(
                calcIn(this.value),
                -1 * w.PAGE_EXCHANGE_CURRENCIES['in']['ch_after_point']
            ).toFixed(w.PAGE_EXCHANGE_CURRENCIES['in']['ch_after_point']);

            triggerEvent(f_D('targetAmount'), 'change');

            exchangeTimerIn = w.setTimeout(function () {
                triggerEvent(f_D('targetAmount'), 'keyup');
            }, 2000);
        });

        APP_LISTEN(f_D('targetAmount'), 'keyup', function () {
            w.clearTimeout(exchangeTimerOut);

            if (this.value === '') {
                this.value = parseFloat(w.PAGE_EXCHANGE_CURRENCIES['in']['min_val']).toFixed(
                    w.PAGE_EXCHANGE_CURRENCIES['in']['ch_after_point']
                );
            }

            f_D('sourceAmount').value = Math.round10(
                calcOut(this.value),
                -1 * w.PAGE_EXCHANGE_CURRENCIES['out']['ch_after_point']
            ).toFixed(w.PAGE_EXCHANGE_CURRENCIES['out']['ch_after_point']);

            triggerEvent(f_D('sourceAmount'), 'change');

            exchangeTimerOut = w.setTimeout(function () {
                triggerEvent(f_D('sourceAmount'), 'keyup');
            }, 2000);
        });
    }

    function ouputFailOrderResult(message) {
        var con = d.getElementById('order_result_output');
        con.innerHTML = '<h2 style="margin-bottom:0;text-align:center">Не удалось обработать Вашу заявку!</h2>';
        con.innerHTML += '<h4 style="margin-bottom:0;text-align:center">Причина неудачи: ' + message + '</h4>';
    }

    function handleOrderError(obj) {
        var status = obj.hasOwnProperty('status') && obj.status === true;
        if (status === false) {
            d.getElementById('order_result_output') ? ouputFailOrderResult(obj.message) : alert(obj.message);
        } else {
            alert('Yup!!');
        }
    }

    function parseAsJson(data) {
        var response = null;

        if (data) {
            try {
                if (typeof JSON.parse(data) === 'string') {
                    response = JSON.parse(JSON.parse(data));
                } else {
                    response = JSON.parse(data);
                }
            } catch (e) {}
        }

        return response;
    }

    function processExOrder() {
        ajax.post('/api/v1/order-status', w['EX_ORDER_PARAMS'], function (data) {
            var response = parseAsJson(data);

            if (response === null) {
                handleOrderError({status: false, message: 'Service currently unavailable.'})
            } else if (response.status === 'wait') {
                w.setTimeout(processExOrder, 1000);
            } else if (response.status === false) {
                handleOrderError(response);
            } else if (response.status === true) {
                window.location.href = '/exchange?order_id=' + w['EX_ORDER_PARAMS']['order_id'] + '&pay';
            } else {
                handleOrderError({status: false, message: 'Service currently unavailable.'})
            }
        });
    }

    if (w.hasOwnProperty('EX_ORDER_PARAMS')) {
        processExOrder();
    }
})(window);
