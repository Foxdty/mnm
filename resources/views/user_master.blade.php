<!DOCTYPE html>
<html lang="en">

<head>
    
    <!-- Include CSS -->
    @include('head')

</head>

<body>
    <!-- Including the main component -->
    @include('topnav')
    {{-- Include everythings else --}}
    @yield('user_content')
    <!-- Including the footer -->
    @include('footer')
    <!-- Include Script -->
    @include('script')
</body>

</html>
