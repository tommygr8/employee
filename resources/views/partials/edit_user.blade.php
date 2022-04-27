<div class="modal-header">
    <h6 class="modal-title">Edit  {{$user->first_name}} {{$user->last_name}}</h6>
    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
        <em class="icon ni ni-cross"></em>
    </a>
</div>
<div class="modal-body">
    <form action="#" id="editUserForm" class="form-validate is-alter">
        <div class="form-group row">
            <div class="form-control-wrap">
                <input type="text" readonly class="form-control" placeholder="Employee ID *" value="{{$user->employee_id}}" name="employee_id" id="employee_id" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <div class="form-control-wrap">
                    <input type="text" class="form-control" placeholder="First Name *" value="{{$user->first_name}}" id="first_name" name="first_name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-control-wrap">
                    <input type="text" class="form-control" placeholder="Last Name *" value="{{$user->last_name}}" id="last_name" name="last_name" required>
                </div>
            </div>
        </div>


        <div class="form-group row">
            <div class="col-md-4">
                <div class="form-control-wrap">
                    <input type="email" readonly class="form-control" value="{{$user->email}}" placeholder="Email ID *" id="email" name="email" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-control-wrap">
                    <input type="text" readonly class="form-control" placeholder="Mobile No *" value="{{$user->mobile_number}}" id="mobile_number" name="mobile_number" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-control-wrap">
                    <select class="form-select form-control form-control-lg" data-search="on" name="role" id="role">
                        <option>Select Role Type</option>
                        @foreach($roles as $role)
                            <option @if($user->hasRole($role->name)) selected @endif>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <div class="form-control-wrap">
                    <input type="text" readonly class="form-control" value="{{$user->username}}" placeholder="Username *" id="username" name="username" required>
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

                        <input type="checkbox" @if($user->hasPermissionTo('read '.$role->name)) checked="checked" @endif name="permissions[]" value="read {{$role->name}}" class="checkbox">


                    </td>
                    <td>
                        <input type="checkbox" name="permissions[]" @if($user->hasPermissionTo('write '.$role->name)) checked="checked" @endif value="write {{$role->name}}" class="checkbox">
                    </td>
                    <td>
                        <input type="checkbox" name="permissions[]" @if($user->hasPermissionTo('delete '.$role->name)) checked="checked" @endif value="delete {{$role->name}}" class="checkbox">
                    </td>
                </tr>

            @endforeach


            </tbody>
        </table>


    </form>
</div>
<div class="modal-footer ">
                    <span class="sub-text"><div class="form-group">
                            <button type="submit" onclick="updateUser('{{$user->id}}')" class="btn btn-sm btn-primary">Edit User</button>
                            <button type="submit" class="btn btn-sm btn-light">Cancel</button>
                        </div>
                    </span>
</div>