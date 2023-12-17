<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - {{ config('global.project_name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/timespro-logo.svg') }}">

    {{-- Include Styles --}}
    @include('includes/styles')

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body translate="no">

    @auth()
        <div class="app-main container-fluid">
            {{-- Include Navbar --}}
            @include('includes/sidebar')

            {{-- Include Content --}}
            <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">

                {{-- Include Navbar --}}
                @include('includes/navbar')

                <main class="p-4 min-vh-100">
                    @yield('content')
                </main>
            </div>
        </div>
    @else
        <div class="app-main container-fluid">
            {{-- Include Content --}}
            <div class="col-md-12 col-lg-12 ml-md-auto px-0 ms-md-auto">
                {{-- Include Navbar --}}
                @include('includes/navbar')

                <main class="p-4 min-vh-100">
                    @yield('content')
                </main>
            </div>
        </div>
    @endauth

    {{-- Include Footer --}}
    @include('includes/footer')

</body>

{{-- Include Default Scripts --}}
@include('includes/scripts')

</html>
