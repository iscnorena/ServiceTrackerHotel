@extends('layout')

@section('scripts')
{{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js') }}
{{ HTML::script ('app.js')}}
@endsection

@section('content')

<div class="container" ng-app="ServiceTrackerApp">
    <div class="row" ng-controller="SearchCtrl">
        <div class="col-md-6">
            <h1>Buscar Tickets</h1>
            <div>
                <h3>Nombre:</h3>


                <input type="text" class="form-control" ng-model="searchInput" ng-change="search()">
                <div class="list-group">
                    <a href"#" class="list-group-item" ng-repeat="user in users">
                        <h4 class="list-group-item-heading">
                            @{{ user.full_name}}
                        </h4>
                        <p class="list-group-item-text">
                            @{{ user.email}}
                        </p>
                    </a>  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection