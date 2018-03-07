(function (w) {
    var d = w.document;
    var app = function APP() {
        var _self = this;
        _self.ajax = (function(w){
            var a = {};
            var s = function S() {
                if (typeof XMLHttpRequest !== 'undefined') return new XMLHttpRequest();
                var versions = [
                    'MSXML2.XmlHttp.6.0', 'MSXML2.XmlHttp.5.0', 'MSXML2.XmlHttp.4.0', 'MSXML2.XmlHttp.3.0',
                    'MSXML2.XmlHttp.2.0','Microsoft.XmlHttp'
                ];

                var xhr;
                for(var i=0;i<versions.length;i++){
                    try{
                        xhr = new ActiveXObject(versions[i]);
                        break;
                    }catch(e){}
                }
                return xhr;
            };
            var as = function AS(url, callback, method, data, async) {
                if (typeof async === 'undefined') async = true;

                var x = s();

                x.open(method, url, async);
                x.onload = function X_ONLOAD() {
                    if (x.readyState === 4 && typeof callback === 'function') callback(x.responseText);
                };

                if (method === 'POST') x.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                return x.send(data);
            };
            var gq = function GET_QUERY(data) {
                var query = [];
                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
                    }
                }
                return query;
            };

            a.get = function A_GET(url, data, callback, async) {
                var query = gq(data);
                return as(url + (query.length ? '?' + query.join('&') : ''), callback, 'GET', null, async);
            };
            a.post = function A_POST(url, data, callback, async) {
                var query = gq(data);
                return as(url, callback, 'POST', query.join('&'), async);
            };

            return a;
        })(window, d);

        _self.routeProcessor = {
            Index : function ROUTEPROCESSOR_INDEX() {
                d.getElementById('content').appendChild(
                    _self.fastCreation('div', {
                        className: 'mdc-layout-grid',
                        child: _self.fastCreation('div', {
                            className: 'mdc-layout-grid__inner',
                            childs: [
                                _self.fastCreation('div', { className: 'mdc-layout-grid__cell mdc-layout-grid__cell--span-1'}),
                                _self.fastCreation('div', {
                                    className: 'mdc-layout-grid__cell mdc-layout-grid__cell--span-10',
                                    child: _self.fastCreation('div', {
                                        className: 'mdc-layout-grid__inner',
                                        childs: [
                                            _self.fastCreation('div', {
                                                className: 'mdc-layout-grid__cell mdc-layout-grid__cell--span-5',
                                                childs: [
                                                    _self.fastCreation('h1', {
                                                        className: 'mdc-typography--headline',
                                                        innerHTML: 'Отдаете'
                                                    }),
                                                    _self.fastCreation('div', {
                                                        className: 'mdc-layout-grid__inner b-calc-step1-box-wrapper',
                                                        id: 'indexCalcGetOut'
                                                    })
                                                ]
                                            }),
                                            _self.fastCreation('div', {
                                                className: 'mdc-layout-grid__cell mdc-layout-grid__cell--span-7',
                                                childs: [
                                                    _self.fastCreation('h1', {
                                                        className: 'mdc-typography--headline',
                                                        innerHTML: 'Получаете'
                                                    }),
                                                    _self.fastCreation('div', {
                                                        className: 'mdc-layout-grid__inner b-calc-step1-box-wrapper',
                                                        id: 'indexCalcGetIn'
                                                    })
                                                ]
                                            })
                                        ]
                                    })
                                }),
                                _self.fastCreation('div', { className: 'mdc-layout-grid__cell mdc-layout-grid__cell--span-1'})
                            ]
                        })
                    })
                );

                _self.ajax.get('/api/v1/available-getout', {}, function APPAJAX_AVAILABLEGETOUT(responses) {
                    responses = JSON.parse(responses);

                    for (var i = 0; i < responses.length; i++) {
                        /** @namespace response.img */
                        /** @namespace response.name */
                        /** @namespace response.curr */
                        var response = responses[i];

                        var div = _self.fastCreation('div', {
                            className: 'b-calc-step1-box mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-theme--primary-bg',
                            childs: [
                                _self.fastCreation('h1', {
                                    className: 'mdc-theme--text-secondary-on-primary mdc-typography--headline',
                                    childs: [
                                        _self.fastCreation('img', {
                                            src: response.img
                                        }),
                                        _self.fastCreation('span', {
                                            innerHTML: response.name + ' ' + response.curr
                                        })
                                    ]
                                }),
                                _self.fastCreation('span', { className: 'b-calc-step1-helper' })
                            ]
                        });

                        _self.listen(div, 'click', function DIV_LISTEN() {

                        });

                        d.getElementById('indexCalcGetOut').appendChild(div);
                    }

                    d.getElementById('indexCalcGetOut').childNodes[0].click();
                });

                _self.ajax.get('/api/v1/available-getin', {}, function APPAJAX_AVAILABLEGETIN(responses) {
                    responses = JSON.parse(responses);

                    for (var i = 0; i < responses.length; i++) {
                        /** @namespace response.img */
                        /** @namespace response.name */
                        /** @namespace response.curr */
                        var response = responses[i];

                        d.getElementById('indexCalcGetIn').appendChild(
                            _self.fastCreation('div', {
                                className: 'b-calc-step1-box mdc-layout-grid__cell mdc-layout-grid__cell--span-8 mdc-theme--secondary-bg',
                                childs: [
                                    _self.fastCreation('h1', {
                                        className: 'mdc-theme--text-secondary-on-primary mdc-typography--headline',
                                        childs: [
                                            _self.fastCreation('img', {
                                                src: response.img
                                            }),
                                            _self.fastCreation('span', {
                                                innerHTML: response.name + ' ' + response.curr
                                            })
                                        ]
                                    })
                                ]
                            })
                        );
                        d.getElementById('indexCalcGetIn').appendChild(
                            _self.fastCreation('div', {
                                className: 'mdc-layout-grid__cell mdc-layout-grid__cell--span-4 b-calc-step1-next-wrap',
                                childs: [
                                    _self.fastCreation('button', {
                                        className: 'mdc-button mdc-button--raised',
                                        id: 'indexCalcGetInRippleButton' + i,
                                        innerHTML: 'Обменять'
                                    }),
                                    _self.fastCreation('span', { className: 'middle-helper' })
                                ]
                            })
                        );
                        // TODO add ripple effect for button
                    }
                });
            }
        };
    };

    app.prototype.listen = function APP_LISTEN(el, ev, fn) {
        var _self = el;

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
    };

    app.prototype.fastCreation = function APP_FASTCREATION(element, obj) {
        var el = d.createElement(element);
        if (typeof obj === 'object') {
            if (obj.hasOwnProperty('className')) {
                el.className = obj.className;
            }
            if (obj.hasOwnProperty('innerHTML')) {
                el.innerHTML = obj.innerHTML;
            }
            if (obj.hasOwnProperty('id')) {
                el.id = obj.id;
            }
            if (obj.hasOwnProperty('src')) {
                el.src = obj.src;
            }
            if (obj.hasOwnProperty('child')) {
                el.appendChild(obj.child);
            }
            if (obj.hasOwnProperty('childs')) {
                for (var i = 0; i < obj.childs.length; i++) {
                    el.appendChild(obj.childs[i]);
                }
            }
        }
        return el;
    };

    app.prototype.processRoute = function APP_PROCESSROUTE(method_name) {
        var _self = this;
        if (_self.routeProcessor.hasOwnProperty(method_name) && typeof _self.routeProcessor[method_name] === 'function') {
            _self.routeProcessor[method_name]();
        } else throw new Error('Unknown method called: ' + method_name);
    };

    app.prototype.initialize = function APP_INITIALIZE() {
        var _self = this;
        var route = w.location.pathname;

        if (!route) route = '/';

        _self.route = route;

        _self.ajax.get('/api/v1/where-next', {route: route}, function APPAJAX_WHERENEXT(response) {
            response = JSON.parse(response);

            _self.processRoute(response['next']);
        });
    };
    var App = new app;
    App.initialize();
})(window);
