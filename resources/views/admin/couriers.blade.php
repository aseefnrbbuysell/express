@extends('layouts.admin.dashboard')

@section('content')
<div class="content sm-gutter" ng-controller="CourierController" ng-init="loadCouriersList()">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="panel-heading">
                    <div class="pull-left">
                        <div class="col-xs-12">
                            <a href="{{ url('dashboard/couriers/add') }}" class="btn btn-primary btn-lg">ADD COURIER</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body clearfix">
                    <div class="row col-sm-2 clearfix">
                        <input type="text" class="form-control" ng-model="search_filter" placeholder="Search">
                    </div>

                    <table class="table table-hover demo-table-dynamic table-responsive-block" id="tableWithDynamicRows">
                        <thead>
                            <tr>
                                <th>Name </th>
                                <th>Father's Name</th>
                                <th>Mother's Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-if="couriers.length == 0">
                                <td colspan="3">No Data Available.</td>
                            </tr>
                            <tr ng-repeat="courier in couriers">
                                <td><% courier.first_name %> <% courier.last_name %></td>
                                <td><% courier.father_name %></td>
                                <td><% courier.mother_name %></td>
                                <td><% courier.email %></td>
                                <td><% courier.contact_no_work %></td>
                                <td ng-if="courier.gender == 'M'">Male</td>
                                <td ng-if="courier.gender == 'F'">Female</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection