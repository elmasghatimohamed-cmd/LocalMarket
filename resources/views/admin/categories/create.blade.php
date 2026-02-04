@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une catégorie</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <button class="btn btn-primary mt-2">Créer</button>
    </form>
</div>
@endsection
