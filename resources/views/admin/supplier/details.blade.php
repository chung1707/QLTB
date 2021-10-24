@extends('layouts.master')

@section('content')
<div class="container">

    <!-- Portfolio Item Heading -->
    <h1 class="my-4">{{$supplier->name}}
    </h1>

    <!-- Portfolio Item Row -->
    <div class="row">

        <div class="col-md-8">
            @if(!isset($supplier->thumbnail))
            <img class="img-fluid" src="https://via.placeholder.com/750x500" alt="không có ảnh của sản phẩm">
            @else
            <img class="img-fluid" style="width: 700px;" src="{{ asset('storage/thumbnails/'.$supplier->thumbnail)}}" alt="Ảnh nhà cung cấp">
            @endif
        </div>

        <div class="col-md-4">
            <h3 class="my-3">Thông tin nhà vận chuyển</h3>
            <p>{{ $supplier->description }}</p>
            <div>
                <a class="btn btn-danger " href="{{ redirect()->back()->getTargetUrl() }}">Quay lại</a>
                <a class="btn btn-primary " href="{{ route('supplier.edit',['supplier' => $supplier]) }}">Sửa thông tin nhà vận chuyển</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
        <h3 class="my-3">Thông tin chính</h3>
            <ul>
                <li>Tên nhà vận chuyển: {{$supplier->name}}</li>
                <li>Số điện thoại: {{ $supplier->phoneNumber }}</li>
                <li>Eamil: {{ $supplier->email }}</li>
            </ul>
        </div>
        <div class="col-md-4">
        <h3 class="my-3">Địa chỉ</h3>
            <ul>
                <li>Địa chỉ: {{ $supplier->address }}</li>
            </ul>
        </div>
        <div class="col-md-4">
        <h3 class="my-3">Thiết bị cung cấp</h3>
            <ul>
                <li>Số loại thiết bị đã cung cấp: {{$total}}</li>
                <li>Sản phẩm cung cấp nhiều nhất: {{$mostItem->name}}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
