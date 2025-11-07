@extends('master') 

@section('page')
@vite(['resources/js/app.js'])
@livewireScripts

    @livewire('messenger')
@endsection