@extends('layout.master')
@section('title', 'Danh sách người dùng')
@section('content')
    <div class="card">
        <div class="btn btn-secondary">
            <h3 class="card-title">Users</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr id="user-{{$user->id}}">
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->address}}</td>
                        <td>
                            @forelse($user->roles as $role)
                                {{ $role->name . ', ' }}
                            @empty
                                User
                            @endforelse
                        </td>
                        <td>
                            <a href="{{route('user.profile', $user->id)}}" class="btn btn-primary form-control">View</a>
                            @can('crud')
                            <a href="{{route('user.edit', $user->id)}}" class="btn btn-primary form-control">Update</a>
                                <a href="{{route('user.delete', $user->id)}}" class="btn btn-primary form-control">Delete</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
