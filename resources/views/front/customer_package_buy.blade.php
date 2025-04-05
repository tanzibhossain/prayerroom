@extends('front.app_front')

@section('content')

@php
    $paypal_mode = $g_setting->paypal_environment;
    $client = $g_setting->paypal_client_id;
    $secret = $g_setting->paypal_secret_key;
@endphp

<div class="page-banner">
    <h1>{{ PAYMENT }}</h1>
    <nav>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
            <li class="breadcrumb-item active">{{ PAYMENT }}</li>
        </ol>
    </nav>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="user-sidebar">
                    @include('front.customer_sidebar')
                </div>
            </div>
            <div class="col-md-9">

                <div class="row">

                    @if($g_setting->paypal_status == 'Enable')
                    <div class="col-md-12 mb_50">
                        <h2>{{ PAY_WITH_PAYPAL }}</h2>
                        <form action="{{ route('paypal') }}" method="post">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package_detail->id }}">
                            <input type="hidden" name="package_price" value="{{ $package_detail->package_price }}">
                            <input type="hidden" name="package_name" value="{{ $package_detail->package_name }}">
                            <button type="submit" class="btn btn-primary">{{ PAY_WITH_PAYPAL }}</button>
                        </form>
                    </div>
                    @endif

                    @if($g_setting->stripe_status == 'Enable')
                    <div class="col-md-12 mb_50">
                        <h2>{{ PAY_WITH_STRIPE }}</h2>
                        <form action="{{ route('stripe') }}" method="post">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package_detail->id }}">
                            <input type="hidden" name="package_price" value="{{ $package_detail->package_price }}">
                            <input type="hidden" name="package_name" value="{{ $package_detail->package_name }}">
                            <button type="submit" class="btn btn-primary">{{ PAY_WITH_STRIPE }}</button>
                        </form>
                    </div>
                    @endif


                    @if($g_setting->bank_status == 'Enable')
                    <div class="col-md-12 mb_50">
                        <h2>{{ PAY_WITH_BANK }}</h2>
                        <form action="{{ route('customer_payment_bank') }}" method="post">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package_detail->id }}">
                            <input type="hidden" name="package_price" value="{{ $package_detail->package_price }}">
                            <input type="hidden" name="package_name" value="{{ $package_detail->package_name }}">
                            <p><b>{{ BANK_INFORMATION }} ({{ WHERE_TO_PAY }})</b></p>
                            <p>{!! nl2br($g_setting->bank_information) !!}</p>

                            <textarea name="bank_transaction_info" class="form-control h-200 mb_20" cols="30" rows="10" placeholder="{{ BANK_TRANSACTION_INFO }}" required></textarea>
                            <button type="submit" class="btn btn-primary">{{ SUBMIT }}</button>
                        </form>

                    </div>
                    @endif


                </div>

            </div>
        </div>
    </div>
</div>

@endsection