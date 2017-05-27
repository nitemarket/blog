@extends('layouts.default')
@section('content')
<div class="container-fluid full-height">
    <div class="row">
        <div id="colorbg" class="col-md-6 valign-center hidden-xs hidden-sm">
            <h1>Hi there. Welcome!</h1>
            <h4>Share your story to loved one.</h4>
        </div>
        <div class="col-md-6 valign-center">
            <h1 class="spacer">Register</h1>
            <form action="{{ route('register') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="sr-only" for="name">Name</label>
                    <input type="email" name="name" class="form-control input-lg" id="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="sr-only" for="email">Email address</label>
                    <input type="email" name="email" class="form-control input-lg" id="email" placeholder="Email address" value="{{ old('email') }}" required>
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
                <div class="form-group">
                    <label class="sr-only" for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control input-lg" id="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-success btn-block btn-lg">Create Account</button>
            </form>
            <div class="spacer"></div>
            <div><a href="{{ route('login') }}">Already have an account?</a></div>
        </div>
    </div>
</div>
@endsection

@push('endscripts')
<script src="{{ asset('js/colorbg.js') }}"></script>
@endpush
