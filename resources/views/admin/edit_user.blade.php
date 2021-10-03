@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <account-infos :roles="{{ json_encode($roles) }}" :user="{{ json_encode($user) }}"></account-infos>
            </div>
        </div>
    </div>

</div>
@endsection