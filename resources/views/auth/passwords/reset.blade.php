@extends('layouts.default')
@section('content')

<div class="container-fluid full-height">
    <div class="row">
        <div id="colorbg" class="col-xs-12 valign-center">
            <div class="panel panel-default black">
                <div class="panel-body">
                    <h1 class="spacer">Reset Password</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('password.request') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="sr-only" for="email">Email address</label>
                            <input type="email" name="email" class="form-control input-lg" id="email" placeholder="Email address" value="{{ $email or old('email') }}" required>
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
                        <button type="submit" class="btn btn-success btn-block btn-lg">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('endscripts')
    <script src="{{ asset('js/colorbg.js') }}"></script>
@endpush
