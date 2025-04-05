@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">{{ EDIT_PAYMENT_SETTING }}</h1>

    <form action="{{ route('admin_payment_update') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold text-primary">{{ PAYPAL }}</h6>
                    </div>
                    <div class="card-body">                        
                        <div class="form-group">
                            <label for="">{{ PAYPAL_ENVIRONMENT }}</label>
                            <select name="paypal_environment" class="form-control">
                                <option value="sandbox" @if($g_setting->paypal_environment == 'sandbox') selected @endif>{{ SANDBOX }}</option>
                                <option value="live" @if($g_setting->paypal_environment == 'live') selected @endif>{{ LIVE }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">{{ PAYPAL_CLIENT_ID }}</label>
                            <input type="text" class="form-control" name="paypal_client_id" value="{{ $g_setting->paypal_client_id }}">
                        </div>
                        <div class="form-group">
                            <label for="">{{ PAYPAL_SECRET_KEY }}</label>
                            <input type="text" class="form-control" name="paypal_secret_key" value="{{ $g_setting->paypal_secret_key }}">
                        </div>
                        <div class="form-group">
                            <label for="">{{ STATUS }}</label>
                            <select name="paypal_status" class="form-control">
                                <option value="Enable" @if($g_setting->paypal_status == 'Enable') selected @endif>{{ ENABLE }}</option>
                                <option value="Disable" @if($g_setting->paypal_status == 'Disable') selected @endif>{{ DISABLE }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold text-primary">{{ STRIPE }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">{{ STRIPE_PUBLISHABLE_KEY }}</label>
                            <input type="text" class="form-control" name="stripe_publishable_key" value="{{ $g_setting->stripe_publishable_key }}">
                        </div>
                        <div class="form-group">
                            <label for="">{{ STRIPE_SECRET_KEY }}</label>
                            <input type="text" class="form-control" name="stripe_secret_key" value="{{ $g_setting->stripe_secret_key }}">
                        </div>
                        <div class="form-group">
                            <label for="">{{ STATUS }}</label>
                            <select name="stripe_status" class="form-control">
                                <option value="Enable" @if($g_setting->stripe_status == 'Enable') selected @endif>{{ ENABLE }}</option>
                                <option value="Disable" @if($g_setting->stripe_status == 'Disable') selected @endif>{{ DISABLE }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold text-primary">{{ BANK_PAYMENT }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">{{ BANK_INFORMATION }}</label>
                            <textarea name="bank_information" class="form-control h_200" cols="30" rows="10">{{ $g_setting->bank_information }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">{{ STATUS }}</label>
                            <select name="bank_status" class="form-control">
                                <option value="Enable" @if($g_setting->bank_status == 'Enable') selected @endif>{{ ENABLE }}</option>
                                <option value="Disable" @if($g_setting->bank_status == 'Disable') selected @endif>{{ DISABLE }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-block">{{ UPDATE }}</button>
    </form>

@endsection