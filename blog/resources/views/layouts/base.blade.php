<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
    </head>
    <body>
        @include('includes.navbar')
        
        @yield('content')
        
        
        <footer>
            @include('includes.footer')
        </footer>
        @include('includes.scripts')
    </body>
</html>