@extends('layout')

@push('additional-styles')
<style>
    .page-header {
        text-transform: uppercase;
        color: #696969;
    }
    .content {
        width:100%;
        margin-left: 25px;
        margin-right: 25px;
    }
    .custom-link {
        letter-spacing: 0.1rem;
        font-size: 0.9rem;
        font-weight: 500;
    }
</style>
@stack('page-styles')
@endpush

@section('content')
@include('partials.sidebar')
<div class="content">
    <h1 class="page-header"> @yield('page-header') </h1>
    @yield('page-content')
</div>
@endsection

@push('additional-scripts')
@stack('page-scripts')
@endpush
