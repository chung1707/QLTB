@extends('layouts.master')

@section('content')
<edit-equipment :equipment="{{ json_encode($equipment) }}"></edit-equipment>
@endsection
