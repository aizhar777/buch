<tr>
    <th>#{{$role->id}}</th>
    <th>{{$role->name or 'None'}}</th>
    <th>{{$role->slug or 'None'}}</th>
    <th>{{$role->description or 'None'}}</th>
    <th>{{date('d-m-Y H:i', strtotime($role->updated_at))}}</th>
    <th>
        <div class="btn-group">
            <a href="{{route('user.roles.show_slug',['slug' => $role->slug])}}" class="btn btn-small btn-default" title="Go to the view of {{$role->name}}"><i class="fa fa-eye"></i></a>
            <a href="{{route('user.roles.edit',['id' => $role->id])}}" class="btn btn-small btn-default"><i class="fa fa-pencil-square-o"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
        </div>
    </th>
</tr>