<tr>
    <th>#{{$user->id}}</th>
    <th>{{$user->name or 'None'}}</th>
    <th>{{$user->email or 'None'}}</th>
    <th>{{date('d-m-Y H:i', strtotime($user->updated_at))}}</th>
    <th>
        <div class="btn-group">
            <a href="{{route('user.profile',['id' => $user->id])}}" class="btn btn-small btn-default" title="Go to the profile of {{$user->name}}"><i class="fa fa-eye"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
        </div>
    </th>
</tr>