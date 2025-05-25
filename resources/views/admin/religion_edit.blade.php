@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">{{ EDIT_RELIGION }}</h1>

    <form action="{{ route('admin_religion_update', $religion->id) }}" method="post">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">{{ EDIT_RELIGION }}</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin_religion_view') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i> {{ VIEW_ALL }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">{{ NAME }} *</label>
                    <input type="text" name="religion_name" class="form-control" value="{{ $religion->name }}" autofocus>
                </div>
                <button type="submit" class="btn btn-success">{{ UPDATE }}</button>
            </div>
        </div>
    </form>
@endsection
