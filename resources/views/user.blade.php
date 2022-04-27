@extends('layout.master')
@section('cssasset')
    <style>
        .table > :not(:first-child) {
            border-top: 0;
        }
    </style>
@endsection
@section('content')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="row  g-gs">



                        <div class="col-sm-12 col-lg-12">
                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-primary" onclick="showModal()">Add User</button>

                            </div>

                        </div>

                        <div class="col-sm-12 col-lg-12 col-xxl-3">
                            <div class="card h-100">
                                <div class="card-inner">

                                    @if($users->isNotEmpty())
                                    <table class="table">
                                        <thead class="thead-light">
                                        <tr class="table-active">
                                            <th scope="col-md-5">Name </th>
                                            <th scope="col-md-2"> </th>
                                            <th scope="col-md-2">Create Date</th>
                                            <th scope="col-md-2">Role</th>
                                            <th scope="col-md-2">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($users as $user)
                                            <tr id="row_{{$user->id}}">
                                                <td scope="row">

                                                    <div class="user-card">
                                                        <div class="user-avatar">
                                                            <span><img src="{{$user->img_url}}"></span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="lead-text">{{$user->first_name}} {{$user->last_name}}</span>
                                                            <span class="sub-text">{{$user->email}}</span>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td scope="row"><a href="#" class="btn btn-sm btn-primary">{{$user->roles->pluck('name')->first()}}</a> </td>
                                                <td>{{$user->created_at->format('d M, Y')}}</td>
                                                <td> {{$user->roles->implode('name',' and ')}} </td>
                                                <td>
                                                    <a href="#" class="btn"><em class="icon ni ni-edit-alt"></em> </a>
                                                    <a href="javascript:void(0)" onclick="confirmDeleteUser('{{$user->id}}')" class="btn"><em class="icon ni ni-trash"></em> </a>

                                                </td>
                                            </tr>

                                        @endforeach


                                        </tbody>
                                    </table>

                                    @else
                                        <p> No user available</p>
                                    @endif


                                </div>
                            </div>

                        </div>

                    </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addUserModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add User</h6>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ url('api/v1/add-user') }}" id="addUserForm" class="form-validate is-alter">
                        <div class="form-group row">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" placeholder="Employee ID *" name="employee_id" id="employee_id" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" placeholder="First Name *" id="first_name" name="first_name" required>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" placeholder="Last Name *" id="last_name" name="last_name" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" placeholder="Email ID *" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" placeholder="Mobile No *" id="mobile_number" name="mobile_number" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-control-wrap">
                                    <select class="form-select form-control form-control-lg" data-search="on" name="role" id="role">
                                        <option>Select Role Type</option>
                                        @foreach($roles as $role)
                                            <option>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" placeholder="Username *" id="username" name="username" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-control-wrap">
                                    <input type="password" class="form-control" placeholder="Password *" id="password" name="password" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-control-wrap">
                                    <input type="password" class="form-control" placeholder="Confirm Password *" id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>


                        <table class="table">
                            <thead class="thead-light">
                            <tr class="table-active">
                                <th scope="col">Modules Permission </th>
                                <th scope="col">Read</th>
                                <th scope="col">Write</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td scope="row">{{$role->name}}</td>
                                    <td>

                                            <input type="checkbox" name="permissions[]" value="read {{$role->name}}" class="checkbox">


                                    </td>
                                    <td>
                                            <input type="checkbox" name="permissions[]" value="write {{$role->name}}" class="checkbox">
                                    </td>
                                    <td>
                                            <input type="checkbox" name="permissions[]" value="delete {{$role->name}}" class="checkbox">
                                            </td>
                                </tr>

                            @endforeach


                            </tbody>
                        </table>


                    </form>
                </div>
                <div class="modal-footer ">
                    <span class="sub-text"><div class="form-group">
                            <button type="submit" onclick="addUser()" class="btn btn-sm btn-primary">Add User</button>
                            <button type="submit" class="btn btn-sm btn-light">Cancel</button>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div id="body-overlay"><div>
            <img src="{{url('loader.gif')}}" width="64px" height="64px" />
        </div></div>

    <style>
        #body-overlay {background-color: rgba(0, 0, 0, 0.6);z-index: 999;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;}
        #body-overlay div {position:fixed;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}
    </style>


@section('jsasset')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        function showModal()
        {
            $('#addUserModal').modal('show')
        }
        function addUser()
        {
            var addUserForm = $("#addUserForm");
            var formData = addUserForm.serializeArray();

            $.ajax( "{{ url('api/v1/user') }}", {
                type:'POST',
                dataType: "json",
                data:formData,
                beforeSend: function(){$("#body-overlay").show();},
                success:function(resp){
                    if(resp.status == "success")
                    {

                        bootbox.alert(resp.message)
                        $('#addUserModal').modal('hide')
                        /*addUserForm.closest('form').find("input[type=text], input[type=email], textarea").val("");
                        addUserForm.closest('form').find("input[type=checkbox]").prop('checked',false);*/
                        location.reload();

                    }
                    else
                    {
                        bootbox.alert(resp.message)
                    }

                    setInterval(function() {$("#body-overlay").hide(); },500);
                },
                error: function (data) {

                    if (data.status ==422)
                    {
                        var errorstr ="";
                        $.each(data.responseJSON.errors, function (key, item) {
                            errorstr += item+"<br />"
                        });
                       //console.log(data.responseJSON.message)
                        bootbox.alert(errorstr)
                    } else {
                        bootbox.alert(data.responseJSON.msg)
                    }
                    setInterval(function() {$("#body-overlay").hide(); },500);
                }
            });

        }


        function confirmDeleteUser(user_id)
        {
            bootbox.confirm({
                message: "Are you sure you want to delete this user?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if(result)
                    {
                        deleteUser(user_id);
                    }
                }
            });
        }
        function deleteUser(user_id)
        {
            $.ajax( "{{ url('api/v1/user') }}/"+user_id, {
                type:'DELETE',
                dataType: "json",
                data:{"_token": "{{ csrf_token() }}"},
                beforeSend: function(){$("#body-overlay").show();},
                success:function(resp){
                    if(resp.status == "success")
                    {
                        bootbox.alert(resp.message)
                        $('#addUserModal').modal('hide')
                        $("#row_"+user_id).remove()

                    }
                    else
                    {
                        bootbox.alert(resp.message)
                    }

                    setInterval(function() {$("#body-overlay").hide(); },500);
                },
                error: function (data) {

                    if (data.status ==422)
                    {
                        var errorstr ="";
                        $.each(data.responseJSON.errors, function (key, item) {
                            errorstr += item+"<br />"
                        });
                        bootbox.alert(errorstr)
                    } else {
                        bootbox.alert(data.responseJSON.message)
                    }
                    setInterval(function() {$("#body-overlay").hide(); },500);
                }
            });

        }
    </script>
@endsection
@endsection