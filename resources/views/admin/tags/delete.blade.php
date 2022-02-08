@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')



        <div class="card-body">
            <form action="{{ route('tag.destroy',['tag'=>$tag->id]) }}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger btn-icon">
                    <i data-feather="delete"></i>
                </button>

            </form>
        </div>
    </div>

@endsection
