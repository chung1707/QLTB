@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lịch sử nhập thiết bị</h6>
            <p>Tổng hóa đơn nhập thiết bị: {{ $totalPage }}/ {{ $total }}</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div id="dataTable_filter" class="dataTables_filter"><label>Tìm kiếm:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" aria-controls="dataTable"  aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 194px;">ID</th>
                                        <th class="sorting" aria-controls="dataTable"  aria-label="Position: activate to sort column ascending" style="width: 296px;">Mã giao dịch</th>
                                        <th class="sorting" aria-controls="dataTable"  colspan="1" aria-label="Age: activate to sort column ascending" style="width: 141x;">Tổng tiền</th>
                                        <th class="sorting" aria-controls="dataTable"  colspan="1" aria-label="Age: activate to sort column ascending" style="width: 141px;">Người lập</th>

                                        <th class="sorting" aria-controls="dataTable"  colspan="2" aria-label="Office: activate to sort column ascending" style="width: 50px;">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($importbills as $importbill)
                                    <tr class="odd">
                                        <td class="sorting_1">{{ $importbill->id }}</td>
                                        <td>{{ $importbill->transaction_id }}</td>
                                        <td>{{ $importbill->total_price }}</td>
                                        <td>{{ $importbill->user->name }}</td>
                                        <td><a  class="btn btn-primary btn-sm" href="/import/{{$importbill->id}}">Xem chi tiết</a></td>
                                        <td class="table__content">
                                            @if(auth()->user()->role->name == 'admin')
                                            <form action=" {{ route('import.destroy',['importbill' => $importbill]) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type='submit'>Xóa</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            <div style="padding: 20px 0px;">
                                {{ $importbills->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
