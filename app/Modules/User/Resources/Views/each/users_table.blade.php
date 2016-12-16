
<tr>
    <th>#{{$user->id}}</th>
    <th>
        @if($user->roles()->first() != null)
            @if($user->isRole('admin'))
                <span class="label label-info">{{$user->roles()->first()->name}}</span>
            @elseif($user->isRole('accountant'))
                <span class="label label-warning">{{$user->roles()->first()->name}}</span>
            @elseif($user->isRole('manager'))
                <span class="label label-primary">{{$user->roles()->first()->name}}</span>
            @else
                <span class="label label-default">{{$user->roles()->first()->name}}</span>
            @endif
        @else
            ERROR
        @endif
    </th>
    <th>{{$user->name or trans('user::module.empty')}}</th>
    <th>{{$user->surname or trans('user::module.empty')}}</th>
    <th>{{$user->patronymic or trans('user::module.empty')}}</th>
    <th>{{$user->email or trans('user::module.empty')}}</th>
    <th>{{date('d-m-Y H:i', strtotime($user->updated_at))}}</th>
    <th>
        <div class="btn-group">
            <a href="{{route('user.profile',['id' => $user->id])}}" class="btn btn-small btn-default" title="{{trans('user::module.view_profile',['name' => $user->name])}}"><i class="fa fa-eye"></i></a>
            <a href="#" class="btn btn-small btn-default"><i class="fa fa-info"></i></a>
        </div>
    </th>
</tr>