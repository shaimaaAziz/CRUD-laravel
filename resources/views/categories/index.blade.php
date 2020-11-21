@extends('layouts.app')

@section('content')

    <div>
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
    </div>

    <div class="card card-default">
        <div class="card-header">categories </div>
        <div class="card-body">
            @if ($categories->count() > 0)
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td><a href="" class="btn btn-success">Edit</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <h3 class="text-center"> No Categories Yet </h3>
            @endif
        </div>

    </div>
@endsection
