@extends('layouts.app')

@section('content')
    {{-- TODO: extract meta --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

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
                        class="list-group-item d-flex d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-0 mb-2">

                        <div class="col-9">
                            <div class="d-flex align-items-center">
                                <input class="form-check-input me-2" onchange="todoCheckboxHandler(this)" type="checkbox" value="" aria-label="..."/>
                                <span class="text"></span>
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-primary upload_image" data-bs-toggle="modal"
                                    data-bs-target="#uploadImageModal">
                                Upload image
                            </button>
                        </div>
                        <div class="col-1">
                            <div class="col-6">
                                <form class="delete_item" action="{{ route('todo.destroy', 'item_id') }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </li>
                    @foreach($items as $item)
                        <li
                            data-id="{{ $item->id }}"
                            class="list-group-item d-flex d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-0 mb-2">

                            <div class="col-9">
                                <div class="d-flex align-items-center">
                                    <input class="form-check-input me-2" type="checkbox" onchange="todoCheckboxHandler(this)" @checked($item->is_done) value="" aria-label="..."/>
                                    <span class="text">{{ $item->text }}</span>
                                </div>
                            </div>
                            <div class="col-2">
                                @if($item->image)
                                    <a target="_blank" href="{{ asset('images/' . $item->image) }}">
                                        <img width="100" height="100"
                                             src="{{ asset('images/150x150_' . $item->image) }}" alt="Todo item img">
                                    </a>
                                @else
                                    @can('todo.edit', $item)
                                        <button type="button" class="btn btn-primary upload_image" data-bs-toggle="modal"
                                                data-bs-target="#uploadImageModal">
                                            Upload image
                                        </button>
                                    @endcan
                                @endif
                            </div>
                            <div class="col-1">
                                @can('todo.edit', $item)
                                    <div class="col-6">
                                        <form class="delete_item" action="{{ route('todo.destroy', $item->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
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

        <!-- Modal -->
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
