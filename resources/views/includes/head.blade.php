<title>{{ config('app.name', 'Blog') }}</title>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Pacifico|Roboto:300,400,500,700" type="text/css">
<link rel="stylesheet" href="{{ asset('css/plugins/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/main.css') }}" />

@stack('scripts')
