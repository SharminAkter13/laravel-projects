@include('layouts.header')
@include('layouts.sidebar') 

<div class="main-content"> 

    @include('layouts.navbar')

    @yield('page') 

    @include('layouts.footer')

</div>