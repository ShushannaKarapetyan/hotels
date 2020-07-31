@extends('layouts.app')

@section('title', 'Change Password')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="{{ route('reset_password') }}">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="old_password" class="col-form-label text-md-right">Old Password</label>
                            <input id="old_password" type="password"
                                   class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                   name="old_password" value=""
                                   placeholder="Enter old password" required>
                            @if ($errors->has('old_password'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">New Password</label>
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" value=""
                                   placeholder="Enter new password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-form-label text-md-right">New Password Confirmation</label>
                            <input id="password_confirmation" type="password"
                                   class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                   name="password_confirmation" value=""
                                   placeholder="Enter new password again" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round">
                            Change
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
