@extends('layouts.app')
@section('content')

    <div class="card card-title">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Image
                </th>
                <th>
                    Name
                </th>

                <th>
                    Permissions
                </th>

                <th>
                    Delete
                </th>
                </thead>
                <tbody>

                @if ($users->count() >0)



                    @foreach($users as $user)

                        <tr>
                            <td>
                                <img src="{{asset($user->profile->avatar)}}" alt="" width="60px" height="60px" style="border-radius: 50%">
                            </td>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                @if ($user->admin)
                                    <a href="{{route('user.normal',['id'=>$user->id])}}" class="btn btn-sm btn-danger">Make not Admin</a>
                                @else
                                    <a href="{{route('user.admin',['id'=>$user->id])}}" class="btn btn-sm btn-success">Make Admin</a>
                                @endif
                            </td>
                            <td>
                                @if (\Illuminate\Support\Facades\Auth::id() !== $user->id)
                                    <a href="{{route('user.delete',['id'=>$user->id])}}" class="btn btn-sm btn-success">Delete User</a>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                @else

                    <tr>
                        <th colspan="5" class="text-center"> No Users</th>
                    </tr>
                @endif

                </tbody>
            </table>

        </div>
    </div>

@endsection
