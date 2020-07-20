@extends('layouts.app')

@section('content')
    <div class="page">
        <div class="page-header">
            <a class="text-white btn btn-info btn-show float-right" style="text-decoration: none" href="{{route(CREATE_CATEGORY)}}">
                <i class="fa fa-plus-square"></i>
            </a>
            <h1 class="page-title">Categories</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route(HOME) }}">Home</a></li>
                <li class="breadcrumb-item">Categories</li>
            </ol>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-body container-fluid">
                    <list-category :categories-data="{{ json_encode($categories) }}"/>
                </div>
            </div>


        </div>
    </div>

@endsection
