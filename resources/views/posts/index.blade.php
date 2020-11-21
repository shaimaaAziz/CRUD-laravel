@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add Posts</a>
    </div>

    <div>

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>

        @endif
    </div>
    <div class="card card-default">
        <div class="card-header">Posts </div>
        <div class="card-body">
            @if($posts->count() >0 )
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                </thead>
                <tbody>
                    @foreach ($posts as $key => $post)
                        <tr>

                            <td>
                                <img src="{{ asset('images/' . $post->image) }}" width="150px" height="150px" alt=" " />
                            </td>

                            <td>{{strip_tags( $post->content)}}</td>

                            <td>
                                @if (!$post->trashed())
                                {{-- //apper just when  the post is  not trashed  --}}
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">Edit </a>
                                @endif
                            </td>

                            <td>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        {{ $post->trashed() ? 'Delete' : 'Trash' }}

                                    </button>

                                </form>


                        </tr>
                    @endforeach

                </tbody>
            </table>

            @else
                 <h3 class="text-center"> No posts Yet</h3>
        @endif
        </div>
    </div>
@endsection
