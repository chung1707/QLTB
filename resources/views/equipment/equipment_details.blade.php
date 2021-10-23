@extends('layouts.master')

@section('content')
<div class="container">

    <!-- Portfolio Item Heading -->
    <h1 class="my-4">{{$equipment->name}}
    </h1>

    <!-- Portfolio Item Row -->
    <div class="row">

        <div class="col-md-8">
            @if($equipment->thumbnail == null)
            <img class="img-fluid" src="https://via.placeholder.com/750x500" alt="không có ảnh của sản phẩm">
            @else
            <img class="img-fluid" style="width: 700px;" src="{{ asset('storage/thumbnails/'.$equipment->thumbnail)}}" alt="Ảnh sản phẩm">
            @endif
        </div>

        <div class="col-md-4">
            <h3 class="my-3">Thông tin thiết bị</h3>
            <p>{{ $equipment->description }}</p>
            <div>
                <a class="btn btn-danger " href="{{ redirect()->back()->getTargetUrl() }}">Quay lại</a>
                <a class="btn btn-primary " href="{{ route('equipment.edit',['equipment' => $equipment]) }}">Sửa thông tin sản phẩm</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
        <h3 class="my-3">Thông tin chính</h3>
            <ul>
                <li>Tên sản phẩm: {{$equipment->name}}</li>
                <li>Giá trị: {{ $equipment->price }} VNĐ</li>
                <li>Số lượng: {{ $equipment->quantity }}</li>
                <li>Mã sản phẩm: {{ $equipment->device_code }}</li>
            </ul>
        </div>
        <div class="col-md-4">
        <h3 class="my-3">Nhà cung cấp</h3>
            <ul>
                <li>Nhà cung cấp: {{ $equipment->supplier->name }}</li>
                <li>Số điện thoại: {{ $equipment->supplier->phoneNumber }}</li>
                <li>Email: {{ $equipment->supplier->email }}</li>
            </ul>
        </div>
        <div class="col-md-4">
        <h3 class="my-3">Danh mục thiết bị</h3>
            <ul>
                <li>Danh mục: {{$equipment->category->name}}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
