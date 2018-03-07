@extends('layouts.app-old')

@section('content')
    <div class="container member">
        <div class="row">
            <div class="col-md-12">
                <h1 class="member-name">{{ Auth::user()->name }}</h1>
            </div>

            <div class="col-md-8 col-md-offset-3 statistic">
                <div class="pull-left col-md-offset-3">
                    <div class="statistic-value pull-left">0</div>
                    <div class="statistic-description pull-left">совершенных сделок</div>
                </div>
                <!--<div class="pull-left statistic-spliter"></div>-->
            </div>

            <div class="col-md-12">
                <div class="row history-header">
                    <div class="col-md-4"><h1>История операций</h1></div>
                </div>

                <table class="table tradechange-table">
                    <thead>
                    <tr>
                        <th class="col-md-1 form-group tradechange-input">
                            <input class="form-control" type="number" name="transactionNumber" id="transactionNumber">
                            <i class="fa fa-search"></i><label for="transactionNumber">Номер</label>
                        </th>
                        <th class="col-md-1 date-time">
                            <a class="btn btn-link tradechange-link">
                                Дата/время&nbsp;<i class="fa fa-play transform-90"></i>
                            </a>
                        </th>
                        <th class="col-md-2">Отдали</th>
                        <th class="col-md-2">Получили</th>
                        <th class="col-md-1">Бонусы</th>
                        <th class="col-md-1">Сэкономили</th>
                        <th class="col-md-1 status">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="7" align="center">Нет данных для отображения</td>
                    </tr>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-6">
                        <ul class="pagination pagination-condensed tradechange-pagination pagination">
                            <li class="pagination-first disabled">
                                <a href="#">«</a>
                            </li>
                            <li class="pagination-page active">
                                <a href="#">1</a>
                            </li>
                            <li class="pagination-last disabled">
                                <a href="#">»</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
