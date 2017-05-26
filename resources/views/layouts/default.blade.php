<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name', 'Blog') }}</title>
        
        @include('includes.head')
        
        @stack('scripts')
    </head>
    <body>
        @yield('content')
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        @stack('endscripts')
    </body>
</html>