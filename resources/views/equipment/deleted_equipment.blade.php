@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row" style="height: 150px;">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tổng số thiết bị hư hỏng:</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalEquipment }} thiết bị</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->

        <!-- Pending Requests Card Example -->
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh mục sản phẩm hư hỏng</h6>
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
                                        <th class="sorting sorting_asc" aria-controls="dataTable" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 194px;">ID</th>
                                        <th class="sorting" aria-controls="dataTable" aria-label="Position: activate to sort column ascending" style="width: 296px;">Tên thiết bị</th>
                                        <th class="sorting" aria-controls="dataTable" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 141x;">Số lượng</th>
                                        <th class="sorting" aria-controls="dataTable" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 141x;">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($equipments as $equipment)
                                    <tr class="odd" style="position: relative;">
                                        <td class="sorting_1">{{ $equipment->id }}</td>
                                        <td>{{ $equipment->equipment->name }}</td>
                                        <td>{{ $equipment->quantity }}</td>
                                        @if($equipment->sold)
                                        <td>Đã thanh lý</td>
                                        @else
                                        <td>Chưa thanh lý</td>
                                        @endif
                                        <td><a class="btn btn-primary btn-sm" href="{{ route('equipment.show',['equipment'=>$equipment] ) }}">Xem chi tiết</a></td>
                                        @if($equipment->quantity > 0)
                                        <td>
                                            <add-to-sell-cart :equipment="{{ json_encode( $equipment) }}" ></add-to-sell-cart>
                                        </td>
                                        @endif
                                        <td class="table__content">
                                            @if(auth()->user()->role->name == 'admin')
                                            <form action="/deleted_equipment/{{$equipment->id}}" method="post">
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
                                {{ $equipments->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
