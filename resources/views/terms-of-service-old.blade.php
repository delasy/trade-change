<?php

/**
 * @var string $tos_content
 */

?>

@extends('layouts.app-old')

@section('content')
    <div class="container about-service">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Правила использования сервиса TradeChange</h1>
                <p><?= $tos_content ?></p>
            </div>
        </div>
    </div>
@endsection
