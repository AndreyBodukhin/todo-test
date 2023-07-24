@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <form action="{{ route('todo.tags.store', $itemId) }}" method="post">
                @csrf
                <div class="row align-content-center justify-center">
                    <div class="col">
                        <input type="text" name="tag" class="form-control">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <ul>
                @foreach($tags as $tag)
                    <li class="list-group-item d-flex d-flex justify-content-between align-items-center mb-2">
                        {{ $tag->name }}
                        <form class="delete_item"
                              action="{{ route('todo.tags.destroy', ['item' => $itemId, 'tag' => $tag->id]) }}"
                              method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
