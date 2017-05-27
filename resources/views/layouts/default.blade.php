<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        @yield('content')

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        @stack('endscripts')
    </body>
</html>
