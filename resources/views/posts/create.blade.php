@extends('layouts.app')

@section('content')
    <div class="card card-default">

        <div class="card-header">
            {{-- اذا في داتا معناه تعديل اذا ما في داتا معناه بدو ينشا داتا جديدة --}}
            {{ isset($post) ? 'Edit Post' : 'Create Post' }}

            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        </div>

        <div class="card-body">
            <form action="{{ isset($post) ? url('posts', $post->id) : route('posts.store') }}" method="POST"
                enctype="multipart/form-data">
               

                @if(isset($post))
                    @method('PUT')
                @endif
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title"
                        value="{{ isset($post) ? $post->title : '' }}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description"
                        value="{{ isset($post) ? $post->description : '' }}" cols="5"
                        rows="5">{{ isset($post) ? $post->description : '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    {{-- <textarea name="content" class="form-control" id="content" cols="5"
                        rows="5"></textarea> --}}
                    {{-- to use this we have 2 link ( from the library cdnjs.com)one for css
                    (trix.css) and the other for scripts
                    and we made the input hidden beacuse we want to sent it to the server --}}

                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
                    <trix-editor input="content"></trix-editor>
                </div>

                <div class="form-group">
                    {{-- to use this we have 2 link (https://flatpickr.js.org/) one for css
                    and the other for scripts
                    and we put id and use it in the scripts below --}}

                    <label for="published_at">Published At</label>
                    <input type="text" class="form-control" name="published_at" id="published_at"
                        value="{{ isset($post) ? $post->published_at : '' }}">
                </div>

                @if (isset($post))
                    <div class="form-group">
                        <img src="{{ asset('images/' . $post->image) }}" width="200px" height="200px">
                    </div>

                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{ isset($post) ? 'update Post' : ' Add Post' }}

                    </button></div>
            </form>
        </div>
    </div>
@endsection

@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr("#published_at", {

            enableTime: true
        })

    </script>


@endsection
