@extends('layouts.app')
@section('content')

    <div class="card card-title">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Category Name
                </th>

                <th>
                    Editing Category
                </th>

                <th>
                    Deleting Category
                </th>
                </thead>
                <tbody>

                @if ($categories->count() >0)

                @foreach($categories as $category)

                    <tr>
                        <td>
                            {{$category->name}}
                        </td>
                        <td>
                            <a href="{{route('category.edit',['id'=>$category->id])}}" class="btn btn-sm btn-info" >Edit</a>
                        </td>
                        <td>
                            <a href="{{route('category.delete',['id'=>$category->id])}}" class="btn btn-sm btn-danger" >Delete</a>

                        </td>
                    </tr>
                @endforeach

                    @else
                    <tr>
                        <th colspan="5" class="text-center"> No Published Categories</th>
                    </tr>
                @endif

                </tbody>
            </table>

        </div>
    </div>

@endsection
