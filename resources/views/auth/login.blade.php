@extends('layout')

@push('additional-styles')
<style>

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
@endpush

@section('content')
<div class="form-signin">
    @include('partials.input-errors')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1 class="h3 mb-3 fw-normal text-center text py-5">DevApp Login</h1>

        <div class="form-floating pt-2">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="adresamea@devapp.com">
            <label for="floatingInput">Adresa e-mail</label>
        </div>
        <div class="form-floating pt-2">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Parola dvs.">
            <label for="floatingPassword">Parola</label>
        </div>

        <button class="w-100 btn btn-lg btn-outline-secondary text" type="submit">Login</button>
    </form>
</div>
@endsection
