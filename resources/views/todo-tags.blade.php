@extends('layouts.app')

@section('content')
    <ul>
        @foreach($tags as $tag)
            <li>
                <form class="delete_item" action="{{ route('todo.tags.destroy', ['item' => $item_id, 'tag' => $tag->id]) }}"
                      method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                {{ $tag->name }}
            </li>
        @endforeach
    </ul>
@endsection
