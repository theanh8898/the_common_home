@extends('layouts.app')

@section('content')
    <div class="page">
        <div class="page-header">
            <h1 class="page-title">Create a new Category</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route(HOME) }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route(LIST_CATEGORY) }}">Categories</a></li>
                <li class="breadcrumb-item active">Create Category</li>
            </ol>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-body container-fluid">
                    <create-category />
                </div>
            </div>


        </div>
    </div>

@endsection
