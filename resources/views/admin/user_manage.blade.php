@extends('layouts.master')

@section('content')
<h2 style="text-align: center;
    padding: 20px;">Danh sách tài khoản</h2>
<div class="container-fluid">
    <p>Tổng số tài khoản: {{ count($users)*($users->currentPage()) }} / {{ count($users)*($users->lastPage()) }}</p>
    <body>
        <table data-toggle="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Quyền</th>
                    <th>Trạng thái</th>
                    <th colspan="3">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                    <block-user :user="{{ json_encode($user) }}"></block-user>
                    </td>
                    <td>Xem chi tiết</td>
                    <td>
                        <a class="btn btn-default btn-sm"
                        href="{{ route('users.edit',['user' => $user]) }}">Sửa</a>
                    </td>
                    <td class="table__content">
                        <form action="{{ route('users.destroy',['user' => $user]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-default btn-sm" type='submit'>Xóa</button>
                        </form>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
    <div style="padding: 20px 0px;">
    {{ $users->links()}}
    </div>
</div>

@endsection
