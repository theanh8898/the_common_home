@extends('layouts.app')

@section('content')
    <div class="page">
        <div class="page-header">
            <a class="text-white btn btn-info btn-show float-right" style="text-decoration: none" href="{{route(CREATE_ARTICLE)}}">
                <i class="fa fa-plus-square"></i>
            </a>
            <h1 class="page-title">Articles</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route(HOME) }}">Home</a></li>
                <li class="breadcrumb-item">Articles</li>
            </ol>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-body container-fluid">
                    <list-article :articles-data="{{ json_encode($articles) }}"/>
                </div>
            </div>


        </div>
    </div>

@endsection
