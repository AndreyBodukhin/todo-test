@extends('layouts.app')

@section('content')
    {{-- TODO: extract meta --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-2">
                <form action="{{ route('todo') }}" method="get">
                    <div class="row align-content-center justify-center">
                        <input type="text" name="q" class="form-control mb-3" value="{{ request()->get('q') }}"
                               placeholder="Type ToDo text">
                        Tags:
                        <select name="tags[]" class="mb-3" size="6" multiple>
                            @foreach($tags as $tag)
                                <option
                                    value="{{ $tag->slug }}"
                                    @selected(in_array($tag->slug, request()->get('tags') ?: []))
                                >
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mb-3">Search</button>
                        <a class="btn btn-danger" href="{{ route('todo') }}">Reset</a>
                    </div>
                </form>
            </div>
            <div class="col-10">
                <form id="todo">
                    @csrf
                    <div class="row align-content-center justify-center">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <input type="text" name="text" class="form-control">
                        </div>
                        <div class="col-2">
                            <button type="button" onclick="todoFormSubmitHandler()" class="btn btn-success">Add</button>
                        </div>
                        <div class="col-2"></div>
                    </div>
                </form>

                <ul id="todo" class="list-group mb-0">
                    {{--Template todoItem--}}
                    <li
                        data-id=""
                        class="list-group-item d-flex d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-0 mb-2">

                        <div class="col-4">
                            <input class="form-check-input me-2" type="checkbox"
                                   onchange="todoCheckboxHandler(this)" value=""
                                   aria-label="..."/>
                            <span class="text"></span>
                        </div>
                        <div class="col-3">
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <a class="edit_tags btn btn-primary me-1" href="{{ route('todo.tags', 'item_id') }}"
                               role="button">Tags</a>
                            <button type="button" class="btn btn-primary upload_image me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#uploadImageModal">
                                Image
                            </button>
                            <form class="delete_item" action="{{ route('todo.destroy', 'item_id') }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </li>
                    @foreach($items as $item)
                        <li
                            data-id="{{ $item->id }}"
                            class="list-group-item d-flex d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-0 mb-2">

                            <div class="col-4">
                                <input class="form-check-input me-2" type="checkbox"
                                       onchange="todoCheckboxHandler(this)" @checked($item->is_done) value=""
                                       aria-label="..."/>
                                <span class="text">{{ $item->text }}</span>
                            </div>
                            <div class="col-3">
                                @foreach($item->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <div class="col-1">
                                @if($item->image)
                                    <div class="ms-5">
                                        <a target="_blank" href="{{ asset('images/' . $item->image) }}">
                                            <img class="rounded-circle" width="60" height="60"
                                                 src="{{ asset('images/150x150_' . $item->image) }}"
                                                 alt="Todo item img">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                @can('todo.edit', $item)
                                    <a class="btn btn-primary me-1" href="{{ route('todo.tags', $item->id) }}"
                                       role="button">Tags</a>
                                    <button type="button" class="btn btn-primary upload_image me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#uploadImageModal">
                                        Image
                                    </button>
                                    <form class="delete_item" action="{{ route('todo.destroy', $item->id) }}"
                                          method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </li>
                    @endforeach
                    @if($items->hasPages())
                        {!! $items->links() !!}
                    @endif
                </ul>
            </div>
        </div>

        <div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <form id="uploadImageForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadImageModalLabel">Upload image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="file" name="image" class="form-control"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="uploadImageBtn" type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endsection

        @section('footer')
            <script src="{{ asset('js/todo.js') }}"></script>
@endsection
