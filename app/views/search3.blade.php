@extends('layout')

@section('content')

<div class="container" ng-app="ServiceTrackerApp">
    <div class="row" ng-controller="SearchCtrl">
        <div class="col-md-6">
            <h1>Directorio</h1>
            <div>
                <h3>Escribe el Nombre</h3>
                <input type="text" class="form-control" ng-model="searchInput" ng-change="search()">
                <div class="list-group">
                    <a href"#" class="list-group-item" ng-repeat="user in users">
                        <h4 class="list-group-item-heading">
                           @{{ user.full_name }} 
                        </h4>
                        <p class="list-group-item-text">
                           @{{ user.ext }}
                        </p>
                    </a>  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection