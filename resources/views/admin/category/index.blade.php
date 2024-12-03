@extends('admin.layouts.admin')

@section('title', 'Список рецептов')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Список рецептов</h1>
            <a href="{{ route('recipes.create') }}" class="btn btn-primary mb-3">Добавить рецепт</a>
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item">
                        <a href="{{ route('recipes.show', $category->id) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
