@extends('layouts.app')

@section('content')
    <div class="page">
        <div class="page-header">
            <h1 class="page-title">Create a new Article</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route(HOME) }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Articles</a></li>
                <li class="breadcrumb-item active">Create Article</li>
            </ol>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-body container-fluid">
                    <create-article />
                </div>
            </div>


        </div>
    </div>
@endsection
