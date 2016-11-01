<tr>
    <th>#{{$permission->id}}</th>
    <th>{{$permission->name or 'None'}}</th>
    <th>{{$permission->slug or 'None'}}</th>
    <th>{{$permission->description or 'None'}}</th>
    <th>{{date('d-m-Y H:i', strtotime($permission->updated_at))}}</th>
    <th>
        <div class="btn-group">
            <a href="{{route('user.perms.show_slug',['slug' => $permission->slug])}}" class="btn btn-small btn-default" title="Go to the view of {{$permission->name}}"><i class="fa fa-eye"></i></a>
            <a href="{{route('user.perms.edit',['id' => $permission->id])}}" class="btn btn-small btn-default"><i class="fa fa-pencil-square-o"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
        </div>
    </th>
</tr>