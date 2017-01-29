<tr>
    <th>#{{$role->id}}</th>
    <th>{{$role->name or 'None'}}</th>
    <th>{{$role->slug or 'None'}}</th>
    <th>{{$role->description or 'None'}}</th>
    <th>{{date('d-m-Y H:i', strtotime($role->updated_at))}}</th>
    <th>
        <div class="btn-group">
            <a href="{{route('user.roles.show_slug',['slug' => $role->slug])}}" class="btn btn-small btn-default" title="{{trans('user::role_and_perms.go_view_role',['role' => $role->name])}}"><i class="fa fa-eye"></i></a>
            <a href="{{route('user.roles.edit',['id' => $role->slug])}}" class="btn btn-small btn-default" title="{{trans('user::role_and_perms.go_edit_role',['role' => $role->name])}}"><i class="fa fa-pencil-square-o"></i></a>
            <button onclick="event.preventDefault();document.getElementById('role-{{$role->id}}-delete-form').submit();" class="btn btn-small btn-danger"><i class="fa fa-trash-o"></i></button>
        </div>
        @include('forms.role_delete_form',['id' => $role->id])
    </th>
</tr>