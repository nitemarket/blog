@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Mass upload</h3>
                    <form action="{{ route('upload') }}" class="dropzone" id="dropzone">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="{{ asset('css/plugins/dropzone.min.css') }}"/>
@endpush

@push('endscripts')
<script src="{{ asset('js/plugins/dropzone.min.js') }}"></script>
<script>
    Dropzone.options.dropzone = {
        paramName: "image",
        maxFilesize: 5, // MB
    };
</script>
@endpush
