<tr>
    <th>#{{$permission->id}}</th>
    <th>{{trans("user::permissions.".$permission->name)}}</th>
    <th>{{$permission->description or 'None'}}</th>
    <th>{{date('d-m-Y H:i', strtotime($permission->updated_at))}}</th>
    <th>
        <div class="btn-group">
            <a href="{{route('user.perms.show',['id' => $permission->id])}}" class="btn btn-small btn-default" title="{{trans('user::role_and_perms.go_view_permission',['permission' => trans("user::permissions.".$permission->name)])}}"><i class="fa fa-eye"></i></a>
            {{--
            <a href="{{route('user.perms.edit',['id' => $permission->id])}}" class="btn btn-small btn-default" title="{{trans('user::role_and_perms.go_edit_permission',['permission' => trans("user::permissions.".$permission->name)])}}"><i class="fa fa-pencil-square-o"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
            --}}
        </div>
    </th>
</tr>