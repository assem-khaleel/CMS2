@extends('layouts.app')
@section('content')

    <div class="card card-title">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Tag Name
                </th>

                <th>
                    Editing Tag
                </th>

                <th>
                    Deleting Tag
                </th>
                </thead>
                <tbody>

                @if ($tags->count() >0)

                    @foreach($tags as $tag)

                        <tr>
                            <td>
                                {{$tag->tag}}
                            </td>
                            <td>
                                <a href="{{route('tag.edit',['tag'=>$tag->id])}}" class="btn btn-sm btn-info" >Edit</a>
                            </td>
                            <td>
                                <a href="{{route('tag.destroy',['tag'=>$tag->id])}}" class="btn btn-sm btn-danger" >Delete</a>

                            </td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <th colspan="5" class="text-center"> No Published Tags</th>
                    </tr>
                @endif

                </tbody>
            </table>

        </div>
    </div>

@endsection
