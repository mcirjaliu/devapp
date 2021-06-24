@extends('dashboard')


@section('page-header', 'Biblioteca mea')

@push('page-styles')
<style>
    .table>tbody>tr>td,
    .table>tbody>tr>th {
        vertical-align: middle;
    }
</style>
@endpush

@section('page-content')
<div class="float-end">
    <h5>Cheia secreta pentru biblioteca dvs este </h5> <span class="badge bg-info">{{ $user->secret_key }}</span>
</div>
<div class="clearfix my-2"></div>

@if(session()->has('book.created'))
<div class="alert alert-success">
    Cartea a fost adaugata.
</div>
@endif

@if(session()->has('book.updated'))
<div class="alert alert-success">
    Cartea a fost actualizata.
</div>
@endif

@if(session()->has('book.deleted'))
<div class="alert alert-success">
    Cartea a fost stearsa.
</div>
@endif

<div class="card mt-5">
    <div class="card-body">
        <div class="col-xl-12">
            <a href="{{ route('books.create') }}" class="btn btn-info text-white float-end custom-link"><i
                    class="fa fa-plus-square"></i> Adauga carte</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titlu</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Data lansare</th>
                    <th scope="col">Adaugata la</th>
                    <th scope="col">Actualizata la</th>
                    <th scope="col">Actiuni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <th scope="row">{{ $book->id }}</th>
                    <td>{{ \Str::limit($book->title, 40) }}</td>
                    <td>{{ \Str::limit($book->author, 40) }}</td>
                    <td>{{ $book->published_at->format('d-m-Y') }}</td>
                    <td>{{ $book->created_at->format('d-m-Y H:i')  }}</td>
                    <td>{{ $book->updated_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-clean"><i
                                class="fa fa-edit"></i></a>
                        <a href="{{ route('books.destroy', $book->id) }}" class="btn btn-clean"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        <div class="d-flex align-items-center text-center justify-content-center">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection
