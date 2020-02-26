@extends('templates.Admin.master')
@section('title','Admin Page - Dashboard')
@section('header','Dashboard')
@section('content')
<div class="card-group">
    @foreach ($data as $item)
    <div class="card text-white m-3 text-center">
        <div class="card-body bg-info p-1 d-flex justify-content-center align-items-center">
            <a href="{{ asset('admin\/').$item[1] }}" class="Admin--LeftBar--Effect--Hover">
                <h5 class="m-0 text-uppercase text-white font-weight-bold">Total {{ $item[1] }}</h5>
            </a>
        </div>
        <div class="card-footer bg-dark">
            <h1 class="card-title font-weight-bold">{{ $item[0] }}</h1>
        </div>
    </div>
    @endforeach
</div>
@endsection