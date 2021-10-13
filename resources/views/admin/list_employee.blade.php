@extends('layouts.master')

@section('content')
<h2 style="text-align: center;
    padding: 20px;">Danh sách tài khoản</h2>
<div class="container-fluid">
    <p>Tổng số tài khoản: {{ $totalPage }} / {{ $total }}</p>
    <body>
        <table data-toggle="table">
            <thead>
                <tr>
                    <th>Mã Nhân viên</th>
                    <th>Họ Tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Số CMND</th>
                    <th>Phòng ban</th>
                    <th>Trạng thái tài khoản kho</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->MaNV }}</td>
                    <td>{{ $employee->Hoten }}</td>
                    <td>{{ $employee->NgaySinh }}</td>
                    <td>{{ $employee->Gioitinh }}</td>
                    <td>{{ $employee->Socmnd }}</td>
                    <td>Nhân viên quản lý thiết bị</td>
                    @if(isset($employee->user->id))
                    <td>{{ $employee->user->username }}</td>
                    @else
                    <td>Chưa có tài khoản</td>
                    @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
    <div style="padding: 20px 0px;">
    {{ $employees->links()}}
    </div>
</div>

@endsection
