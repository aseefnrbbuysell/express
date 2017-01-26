@extends('layouts.admin.dashboard')

@section('content')
<div class="content sm-gutter" ng-controller="OrderController" ng-init="loadOrdersList()">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="panel-heading">
                    <div class="pull-left">
                        <div class="col-xs-12">
                            <a href="{{ url('dashboard/orders/add') }}" class="btn btn-primary btn-lg">ADD ORDER</a>
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
                                <th>Sender</th>
                                <th>Reciever</th>
                                <th>Pickup Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-if="orders.length == 0">
                                <td colspan="3">No Data Available.</td>
                            </tr>
                            <tr ng-repeat="order in orders">
                                <td><% order.sender_name %></td>
                                <td><% order.reciever_name %></td>
                                <td><% order.pickup_date %></td>
                                <td ng-if="order.flag == 0">Processing</td>
                                <td ng-if="order.flag == 9">Delivered</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection