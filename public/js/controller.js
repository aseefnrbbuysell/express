var app = {};
app.host = "http://localhost:3000/nrbexpress/public/";

myApp = angular.module('myApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

angular.module('myApp').controller('LoginController', function($scope, $http, $window){
    $scope.err = 0;
    $scope.doLogin = function(){
        var data = $.param({
            username: $scope.email_address,
            password: $scope.password
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        console.log(data)
        $http.post('processLogin', data, config).success(function (result, status) {
            if(result == -1)
            {
                $scope.err = 1;
                $scope.login_msg = "Invalid email address / password. Please try again.";
            }
            else
            {
                $scope.err = 0;
                localStorage.setItem('loginUser', JSON.stringify(result));
                console.log(localStorage)
                $window.location.href = 'dashboard';
            }
        }).error(function (result, status) {
            $scope.err = 1;
            $scope.login_msg = "Internal problem occured. Please contact the administrtator.";
        });
    };
});

angular.module('myApp').controller('ClientController', function($scope, $http, $window) {
    $scope.msg = "";
    $scope.initialize = function(user_type){
        $scope.user_type = user_type;
        $http.get(app.host + 'getUsersList/'+$scope.user_type).then(function(response){
            $scope.users_list = response.data.users;
        })
        $http.get(app.host + 'roles').then(function(response){
            $scope.roles = response.data.roles;
        })
    }

    $scope.registerUser = function(form, user_type){
        var data = $.param({
            first_name: $scope.user.first_name,
            last_name: $scope.user.last_name,
            email_address: $scope.user.email_address,
            password: $scope.user.password,
            company: $scope.user.company,
            account_type: $scope.user.account_type,
            user_type: user_type,
            role_id: $scope.user.role
        });
        console.log(data)
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        console.log(data)
        $http.post(app.host + 'registerUser', data, config).success(function (result, status) {
            if(result == -1)
            {
                $scope.msg = "Email address already exists.";
            }
            else
            {
                $('#modalSlideUp').modal('toggle');
                $('.top-right').notify({
                    type: 'info',
                    message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation has been successful.</strong>' },
                    closable: false,
                    fadeOut: { enabled: true, delay: 2000 }
                }).show();
                $scope.msg = "";
                $scope.user = {};
                form.$setPristine();
                $http.get(app.host + 'getUsersList/'+user_type).then(function(response){
                    $scope.users_list = response.data.users;
                })
            }

        }).error(function (result, status) {
            console.log(result)
        });
    };
})

angular.module('myApp').controller('RoleController', function($scope, $http, $window) {
    $scope.loadRoles = function(){
        $http.get(app.host + 'roles').then(function(response){
            $scope.roles = response.data.roles;
        })
    };
    $scope.addRole = function(form, user_type){
        var data = $.param({
            name: $scope.role.name,
            description: $scope.role.description
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        console.log(data)
        $http.post(app.host + 'roles', data, config).success(function (result, status) {
            $('#modalSlideUp').modal('toggle');
            $('.top-right').notify({
                type: 'info',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation has been successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.role = {};
            form.$setPristine();
            $http.get(app.host + 'roles').then(function(response){
                $scope.roles = response.data.roles;
            })
        }).error(function (result, status) {
            console.log(result)
        });
    };

    $scope.assignPermission = function (role_id) {
        var data = $.param({
            role_id: role_id,
            permission_list: $scope.permission_list
        });
        console.log('----')
        console.log(data)
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'assignPermissions', data, config).success(function (result, status) {
            $('.top-right').notify({
                type: 'info',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation has been successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            console.log(result)

        }).error(function (result, status) {
            console.log(result)
        });
    }

    $scope.selectPermission = function (val, id) {
        if(val.permissions_id)
            $scope.permission_list[id] = val.permissions_id;
        else
            delete $scope.permission_list[  id];
        console.log($scope.permission_list)
    }
    $scope.loadPermissions = function(){
        $http.get(app.host + 'permissions').then(function(response){
            $scope.permissions = response.data.permissions;
        })
        $scope.permission_list = [];
    };
    $scope.addPermission = function(form, user_type){
        var data = $.param({
            name: $scope.permission.name,
            display_name: $scope.permission.display_name,
            description: $scope.permission.description
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        console.log(data)
        $http.post(app.host + 'permissions', data, config).success(function (result, status) {
            $('#modalSlideUp').modal('toggle');
            $('.top-right').notify({
                type: 'info',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation has been successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.permission = {};
            form.$setPristine();
            $http.get(app.host + 'permissions').then(function(response){
                $scope.permissions = response.data.permissions;
            })
        }).error(function (result, status) {
            console.log(result)
        });
    };
})
angular.module('myApp').controller('OrderController', function($scope, $http, $window) {

    var n = 0;
    var items = new Array();
    $scope.items = new Array();
    $scope.user = {};
    $scope.loadOrdersList = function(){
        $http.get(app.host + 'getOrdersList').then(function(response){
            $scope.orders = response.data.orders;
        })
    }
    $scope.initialize = function(){
        var autocomplete = {};
        var autocompletesWraps = ['test', 'test2'];
        var test_form = { street_number: 'short_name', route: 'long_name', locality: 'long_name', administrative_area_level_1: 'short_name', country: 'long_name', postal_code: 'short_name' };
        var test2_form = { street_number: 'short_name', route: 'long_name', locality: 'long_name', administrative_area_level_1: 'short_name', country: 'long_name', postal_code: 'short_name' };

        $.each(autocompletesWraps, function(index, name) {

            if($('#'+name).length == 0) {
                return;
            }

            autocomplete[name] = new google.maps.places.Autocomplete($('#'+name+' .autocomplete')[0], { types: ['geocode'] });

            google.maps.event.addListener(autocomplete[name], 'place_changed', function() {

                var place = autocomplete[name].getPlace();
                var form = eval(name+'_form');

                for (var component in form) {
                    $('#'+name+' .'+component).val('');
                    $('#'+name+' .'+component).attr('disabled', false);
                }

                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];
                    if (typeof form[addressType] !== 'undefined') {
                        var val = place.address_components[i][form[addressType]];
                        $('#'+name+' .'+addressType).val(val);
                    }
                }
            });
        });

    }
    $http.get(app.host + 'getUsersList/clients').then(function(response){
        $scope.users_list = response.data.users;
    })

    $scope.addOrder = function (myform) {
        var data = $.param({
            user_id: $scope.user.user_id,
            sender_email: $scope.user.sender_email,
            sender_phone: $scope.user.sender_phone,
            sender_street: $('#sender_street').val(),
            sender_address_1: $('#sender_address').val(),
            sender_city: $('#sender_city').val(),
            sender_state: $('#sender_state').val(),
            sender_zipcode: $('#sender_postcode').val(),
            sender_country: $('#sender_country').val(),
            reciever_name: $scope.user.reciever_name,
            reciever_email: $scope.user.reciever_email,
            reciever_phone: $scope.user.reciever_phone,
            reciever_street: $('#sender_street_2').val(),
            reciever_address_1: $('#sender_address_2').val(),
            reciever_city: $('#sender_city_2').val(),
            reciever_state: $('#sender_state_2').val(),
            reciever_zipcode: $('#sender_postcode_2').val(),
            reciever_country: $('#sender_country_2').val(),
            pickup_date: $scope.user.pickup_date,
            shipment_info: $scope.items
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $http.post(app.host + 'orders/add', data, config).success(function (result, status) {
            $('.top-right').notify({
                type: 'info',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation has been successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();

            $scope.user = {};
            myform.$setPristine();
            n = 0;
            items = new Array();
            $scope.items = new Array();
            $('.autocomplete').val('');
            $('#sender_street').val('');
            $('#sender_address').val('');
            $('#sender_city').val('');
            $('#sender_state').val('');
            $('#sender_state').val('');
            $('#sender_postcode').val('');
            $('#sender_country').val('');

            $('#sender_street_2').val('');
            $('#sender_address_2').val('');
            $('#sender_city_2').val('');
            $('#sender_state_2').val('');
            $('#sender_state_2').val('');
            $('#sender_postcode_2').val('');
            $('#sender_country_2').val('');

        }).error(function (result, status) {
            console.log(result)
        });
    }

    $scope.addItem = function(){console.log('dddd')
        items[n] = [ $scope.user.item, $scope.user.type, $scope.user.weight, $scope.user.length, $scope.user.width, $scope.user.height];
        $scope.items = items;
        console.log($scope.items)
        n++;
    }

})
angular.module('myApp').controller('CourierController', function($scope, $http, $window) {
    $scope.loadCouriersList = function(){
        $http.get(app.host + 'getCouriersList').then(function(response){
            $scope.couriers = response.data.couriers;
        })
    }
    var references = new Array();
    var experiences = new Array();
    var n=0;
    var i=0;
    $scope.references = {};
    $scope.experiences = {};
    $scope.add_referee = function(){
        $('#modalSlideUp').modal('toggle');
        references[n] = [$scope.referee.referee_name, $scope.referee.referee_company, $scope.referee.referee_designation, $scope.referee.referee_email, $scope.referee.referee_contact]
        n++
        $scope.referee = {}
        $scope.references = references;
        $('#references').val(JSON.stringify(references))
    }
    $scope.add_experience = function(){
        $('#modalSlideUpExperience').modal('toggle');
        experiences[i] = [$scope.exp.company, $scope.exp.designation, $scope.exp.start_date, $scope.exp.end_date]
        i++
        $scope.exp = {}
        $scope.experiences = experiences;
        $('#experiences').val(JSON.stringify(experiences))
    }
})
