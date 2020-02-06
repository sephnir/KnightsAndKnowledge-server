@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{__('routes.home')}}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-lg btn-block menu-btn" href="{{route('guilds')}}" role="button">Manage Guilds</a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-lg btn-block menu-btn" href="#" role="button">Display Statistics</a>
                        </div>
                    </div>

                    <div id="example"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
