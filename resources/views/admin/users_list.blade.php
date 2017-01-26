@extends('layouts.admin.dashboard')

@section('content')
<div class="content sm-gutter" ng-controller="ClientController" ng-init="initialize('{{ $user_type }}')">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="panel-heading">
                    <div class="pull-left">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg pull-right" data-target="#modalSlideUp" data-toggle="modal">ADD {{strtoupper($user_type)}}</button>
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
                                <th>Name</th>
                                <th>Company</th>
                                <th>Email Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="user in filtered = (users_list | filter : search_filter)" ng-cloak>
                                <th><% user.first_name %> <% user.last_name %></th>
                                <th><% user.company %></th>
                                <th><% user.email %></th>
                            </tr>
                            <tr ng-if="filtered.length == 0">
                                <td colspan="3">
                                    No data found.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade stick-up" id="modalSlideUp" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                        <h5>{{ strtoupper($user_type) }} <span class="semi-bold">INFORMATION</span></h5>
                        <p class="p-b-10">We need client information inorder to process the order</p>
                    </div>
                    <div class="modal-body">
                        <form role="form" name="userRegistrationForm" novalidate>
                            <div class="form-group-attached">

                                <div class="row">
                                    <div class="col-sm-12" ng-if="msg != ''">
                                            <label><span style="color:red"><% msg %></span></label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>First Name <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="first_name" ng-model="user.first_name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>Last name <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="last_name" ng-model="user.last_name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6" ng-if="userRegistrationForm.first_name.$dirty && userRegistrationForm.first_name.$invalid">
                                        <label><span style="color:red">First name is required</span></label>
                                    </div>
                                    <div class="col-sm-6" ng-if="!userRegistrationForm.first_name.$invalid && (userRegistrationForm.last_name.$dirty && userRegistrationForm.last_name.$invalid)">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-6" ng-if="userRegistrationForm.last_name.$dirty && userRegistrationForm.last_name.$invalid">
                                            <label><span style="color:red">Last name is required</span></label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" name="company" ng-model="user.company">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>Account Type</label>
                                            <select class="form-control select2js"  name="account_type" ng-model="user.account_type">
                                                <option value="1">Individual</option>
                                                <option value="2">Corporate</option>
                                                <option value="3">Government</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Email Address <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" ng-model="user.email_address" ng-required="true" name="email_address" ng-pattern="/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]*\.([a-z]{2,4})$/" ng-model-options="{updateOn: 'blur'}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12" ng-if="userRegistrationForm.email_address.$dirty && userRegistrationForm.email_address.$invalid">
                                        <label><span style="color:red">Email address must be valid.</span></label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>Password <span style="color:red">*</span></label>
                                            <input type="password" class="form-control" ng-model="user.password" ng-pattern="/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/" name="password" ng-model-options="{updateOn: 'blur'}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>Retype Password <span style="color:red">*</span></label>
                                            <input type="password" class="form-control" name="retype_password" ng-model="user.retype_password" ng-required="true" ng-model-options="{updateOn: 'blur'}" ng-pattern="password">
                                        </div>
                                    </div>
                                    <div class="col-sm-6" ng-if="userRegistrationForm.password.$dirty && userRegistrationForm.password.$invalid">
                                        <label><span style="color:red">Password must be at least 8 characters long and should contain one number,one character and one special character.</span></label>
                                    </div>
                                    <div class="col-sm-6" ng-if="!userRegistrationForm.password.$invalid && (userRegistrationForm.retype_password.$dirty && userRegistrationForm.retype_password.$invalid)">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-6" ng-if="userRegistrationForm.retype_password.$dirty && userRegistrationForm.retype_password.$invalid">
                                        <label><span style="color:red">Password and re-type password must be same.</span></label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>Role <span style="color:red">*</span></label>
                                            <select class="form-control" name="role" ng-model="user.role" ng-required="true">
                                                <option ng-repeat="role in roles" value="<% role.id %>"><% role.name %></option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                <a class="btn btn-primary btn-block m-t-5" ng-disabled="userRegistrationForm.$invalid" ng-click="registerUser(userRegistrationForm, '{{$user_type}}')">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</div>

@endsection