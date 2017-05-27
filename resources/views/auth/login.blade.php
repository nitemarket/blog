@extends('layouts.default')
@section('content')
<div class="container-fluid full-height">
    <div class="row">
        <div class="col-md-6 valign-center">
            <h1 class="spacer">Login</h1>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="sr-only" for="email">Email address</label>
                    <input type="email" name="email" class="form-control input-lg" id="email" placeholder="Email address" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="sr-only" for="password">Password</label>
                    <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password" required>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember me
                    </label>
                </div>
                <button type="submit" class="btn btn-success btn-block btn-lg">Sign In</button>
            </form>
            <div class="spacer"></div>
            <div><a href="{{ route('register') }}">Sign up now</a></div>
            <div><a href="{{ route('password.request') }}">Forgot Your Password?</a></div>
        </div>
        <div id="colorbg" class="col-md-6 valign-center hidden-xs hidden-sm">
            <h1>Welcome back</h1>
            <h4>Share your story to loved one.</h4>
        </div>
    </div>
</div>
@endsection

@push('endscripts')
<script src="{{ asset('js/colorbg.js') }}"></script>
@endpush
