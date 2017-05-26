@extends('layouts.default')
@section('content')

<div class="container-fluid full-height">
    <div class="row">
        <div id="colorbg" class="col-xs-12 valign-center">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 class="spacer">Reset Password</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
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
                        <button type="submit" class="btn btn-success btn-block btn-lg">Send Password Reset Link</button>
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