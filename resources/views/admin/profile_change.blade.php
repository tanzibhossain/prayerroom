@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">{{ EDIT_PROFILE }}</h1>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin_profile_change_update') }}" method="post">
                @csrf
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ NAME }} *</label>
                                    <input type="text" name="name" class="form-control" value="{{ Auth::guard('admin')->user()->name }}" autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ EMAIL_ADDRESS}} *</label>
                                    <input type="text" name="email" class="form-control" value="{{ Auth::guard('admin')->user()->email }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ PHONE }}</label>
                                    <input type="text" name="phone" class="form-control" value="{{ Auth::guard('admin')->user()->phone }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ COUNTRY }}</label>
                                    <input type="text" name="country" class="form-control" value="{{ Auth::guard('admin')->user()->country }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ ADDRESS }}</label>
                                    <input type="text" name="address" class="form-control" value="{{ Auth::guard('admin')->user()->address }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ STATE }}</label>
                                    <input type="text" name="state" class="form-control" value="{{ Auth::guard('admin')->user()->state }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ CITY }}</label>
                                    <input type="text" name="city" class="form-control" value="{{ Auth::guard('admin')->user()->city }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ ZIP }}</label>
                                    <input type="text" name="zip" class="form-control" value="{{ Auth::guard('admin')->user()->zip }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ WEBSITE }}</label>
                                    <input type="text" name="website" class="form-control" value="{{ Auth::guard('admin')->user()->website }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ FACEBOOK }}</label>
                                    <input type="text" name="facebook" class="form-control" value="{{ Auth::guard('admin')->user()->facebook }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ TWITTER }}</label>
                                    <input type="text" name="twitter" class="form-control" value="{{ Auth::guard('admin')->user()->twitter }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ LINKEDIN }}</label>
                                    <input type="text" name="linkedin" class="form-control" value="{{ Auth::guard('admin')->user()->linkedin }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ INSTAGRAM }}</label>
                                    <input type="text" name="instagram" class="form-control" value="{{ Auth::guard('admin')->user()->instagram }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ PINTEREST }}</label>
                                    <input type="text" name="pinterest" class="form-control" value="{{ Auth::guard('admin')->user()->pinterest }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ YOUTUBE }}</label>
                                    <input type="text" name="youtube" class="form-control" value="{{ Auth::guard('admin')->user()->youtube }}">
                                </div>
                            </div>
                        </div>                        
                        <button type="submit" class="btn btn-success">{{ UPDATE }}</button>
                    </div>
                </div>
            </form>        
        </div>
    </div>

@endsection
