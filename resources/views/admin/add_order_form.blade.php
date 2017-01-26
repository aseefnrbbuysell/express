@extends('layouts.admin.dashboard')

@section('content')
<div class="content sm-gutter" ng-controller="OrderController" ng-init="initialize()">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                    </button>
                    <h5> Order <span class="semi-bold">INFORMATION</span></h5>
                    <p class="p-b-10">We need client information inorder to process the order</p>
                </div>
                 <form role="form" name="OrderRequestForm" novalidate>
                  <div class="row col-sm-12">
                    <div class="row">
                        <h3 class="text text-success">Date & Time</h3>
                        <div class="col-sm-4">
                            <div class="form-group form-group-default">
                                <label>Pick Up Your Date <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="pickup_date" id="default_datetimepicker" ng-model="user.pickup_date" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                            </div>
                        </div>
                    </div>
                  </div>
                    <div class="col-sm-6">

                      <div class="row" id="test">
                            <h3 class="text text-success">Sender Information</h3>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Sender <span style="color:red">*</span></label>
                                    <select class="form-control select2js" name="user_id" ng-model="user.user_id" ng-required="true">
                                        <option value="">Choose a customer</option>
                                        <option ng-repeat="user in users_list" value="<% user.id %>"><% user.first_name %></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="sender_phone" ng-model="user.sender_phone">
                                </div>
                            </div>
                            <div class="col-sm-12" id="locationField">
                                <div class="form-group form-group-default">
                                    <label>Enter your address</label>
                                    <input placeholder="Enter your address" class="form-control autocomplete" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Street</label>
                                    <input class="form-control street_number" id="sender_street">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Address</label>
                                    <input class="form-control route" id="sender_address">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>City</label>
                                    <input class="form-control locality" id="sender_city">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>State</label>
                                    <input class="form-control administrative_area_level_1" id="sender_state">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Zip Code</label>
                                    <input class="form-control postal_code" id="sender_postcode">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Country</label>
                                    <input class="form-control country" id="sender_country">
                                </div>
                            </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row" id="test2">
                            <h3 class="text text-success">Reciever Information</h3>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Name <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="sender_name" ng-required="true" ng-model="user.reciever_name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                                </div>
                            </div>
                            <div class="col-sm-12" ng-if="OrderRequestForm.reciever_name.$dirty && OrderRequestForm.reciever_name.$invalid">
                                <label><span style="color:red">Name is required</span></label>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Email Address</label>
                                    <input type="text" class="form-control" name="sender_email" ng-model="user.reciever_email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="sender_phone" ng-model="user.reciever_phone">
                                </div>
                            </div>
                            <div class="col-sm-12" id="locationField">
                                <div class="form-group form-group-default">
                                    <label>Enter your address</label>
                                    <input placeholder="Enter your address" class="autocomplete form-control" type="text"></input>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Street</label>
                                    <input class="form-control street_number" id="sender_street_2"></input>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Address</label>
                                    <input class="form-control route" id="sender_address_2"></input>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>City</label>
                                    <input class="form-control locality" id="sender_city_2"></input>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>State</label>
                                    <input class="form-control administrative_area_level_1" id="sender_state_2"></input>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Zip Code</label>
                                    <input class="form-control postal_code" id="sender_postcode_2"></input>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Country</label>
                                    <input class="form-control country" id="sender_country_2"></input>
                                </div>
                            </div>
                      </div>

                    </div>
                    <div class="row">
                                    <h3 class="text text-success">Shipment Information</h3>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label>Item <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="item" ng-model="user.item">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label>Type</label>
                                            <input type="text" class="form-control" name="type" ng-model="user.type">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label>Weight</label>
                                            <input type="text" class="form-control" name="weight" ng-model="user.weight">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label>Length</label>
                                            <input type="text" class="form-control" name="length" ng-model="user.length">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label>Width</label>
                                            <input type="text" class="form-control" name="width" ng-model="user.width">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label>Height</label>
                                            <input type="text" class="form-control" name="height" ng-model="user.height">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default col-sm-2">
                                            <a class="btn btn-danger btn-block m-t-5" ng-click="addItem(OrderRequestForm)">Add Item</a>
                                        </div>
                                    </div>
                                    <div class="row" ng-if="items.length > 0">
                                    <div class="col-sm-2">
                                        <div style="background-color: #0479cc; color: white" class="form-group form-group-default">
                                            <label>Item </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div style="background-color: #0479cc; color: white" class="form-group form-group-default">
                                            <label>Type </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div style="background-color: #0479cc; color: white" class="form-group form-group-default">
                                            <label>Weight </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div style="background-color: #0479cc; color: white" class="form-group form-group-default">
                                            <label>Length </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div style="background-color: #0479cc; color: white" class="form-group form-group-default">
                                            <label>Width </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div style="background-color: #0479cc; color: white" class="form-group form-group-default">
                                            <label>Height </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" ng-if="items.length > 0"  ng-repeat="item in items">
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label> <% item[0] %> </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label> <% item[1] %> </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label> <% item[2] %> </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label> <% item[3] %> </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label> <% item[4] %> </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-default">
                                            <label> <% item[5] %> </label>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                            <a class="btn btn-primary btn-block m-t-5" ng-click="addOrder(OrderRequestForm)">Create Order</a>
                                        </div>
                                    </div>
                    </div>
                  </form>

            </div>
        </div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_bR92LYDBvuBtQLZOnxp_1fatpnFYbXQ&libraries=places" async defer></script>
@endsection