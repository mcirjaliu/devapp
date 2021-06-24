@extends('dashboard')

@push('page-styles')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush

@section('page-header', 'Adaugare carte')

@section('page-content')
<div class="d-flex align-items-end justify-content-end">
    <a class="btn btn-clean" href="{{ route('books.index') }}"><i class="fa fa-chevron-left"></i> Inapoi</a>
</div>

@include('partials.input-errors')
<form class="py-5" action="{{ route('books.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Titlu Carte</label>
        <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text text-muted">Titlul cartii trebuie sa fie unic.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Autor</label>
        <input type="text" name="author" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text text-muted">Autorul cartii trebuie sa fie unic.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Data lansare</label>
        <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control" name="published_at">
            <div class="input-group-addon">
                <span class="fa fa-time"></span>
            </div>
        </div>

    </div>
    <button type="submit" class="btn btn-success float-end">Salveaza</button>
</form>
@endsection

@push('page-scripts')
<script src="https://code.jquery.com/jquery-1.9.0.min.js"
    integrity="sha256-f6DVw/U4x2+HjgEqw5BZf67Kq/5vudRZuRkljnbF344=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(window).ready(function() {
        var $datepicker = $('.datepicker').datepicker({
            highlightToday: true,
            format: 'dd/mm/yyyy',
        });
    });
</script>
@endpush
