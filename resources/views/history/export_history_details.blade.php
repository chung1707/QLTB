@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header">
            Thông tin hóa đơn
        </div>
        <div class="card-body" style="display: flex;
               justify-content: space-between;">
            <ul>
                <li style="list-style: circle;
    padding: 5px;">
                    Mã giao dịch: <span style="color: #dd5757;">{{ $bill->transaction_id }}</span>
                </li>
                <li style="list-style: circle;
    padding: 5px;">
                    Nhân viên lập hóa đơn: <span style="color: #dd5757;">{{ $bill->user->name }}</span>
                </li>
            </ul>
            @if(isset($bill->area->name))
            <ul>
                <li style="list-style: circle;
    padding: 5px;">
                    Đơn vị nhận thiết bị <span style="color: #dd5757;">{{ $bill->area->name }}</span>
                </li>
                <li style="list-style: circle;
    padding: 5px;">
                    Mô tả: <span style="color: #dd5757;">{{ Str::limit($bill->area->description, 30)}}</span>
                </li>
            </ul>
            @else
            <ul>

            </ul>
            @endif
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết hóa đơn nhập</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" aria-controls="dataTable" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 194px;">Mã thiết bị</th>
                                        <th class="sorting" aria-controls="dataTable" aria-label="Position: activate to sort column ascending" style="width: 296px;">Tên thiết bị</th>
                                        <th class="sorting" aria-controls="dataTable" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 141x;">Số lượng</th>
                                        <th class="sorting" aria-controls="dataTable" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 100px;">Ảnh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                    <tr class="odd">
                                        <td class="sorting_1">{{ $item->device_code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->pivot->quantity }}</td>
                                        <td>
                                            @if($item->thumbnail == null)
                                            <img class="img-fluid" src="https://via.placeholder.com/750x500" alt="không có ảnh của sản phẩm">
                                            @else
                                            <img class="img-fluid" style="width: 200px;" src="{{ asset('storage/thumbnails/'.$item->thumbnail)}}" alt="Ảnh sản phẩm">
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <a class="btn btn-danger " href="{{route('export_history')}}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
