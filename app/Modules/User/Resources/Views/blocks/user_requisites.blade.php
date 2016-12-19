
@if($requisites->count() > 0)
    <table id="requisites_table" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>{{ trans('user::form.requisite.legal_name') }}</th>
            <th>{{ trans('user::form.requisite.iin') }}</th>
            <th>{{ trans('user::form.requisite.bank') }}</th>
            <th>{{ trans('user::form.requisite.bin') }}</th>
            <th>{{ trans('user::form.requisite.iik') }}</th>
            <th>{{ trans('user::form.requisite.cbe') }}</th>
        </tr>
        </thead>
        @foreach($user->requisites as $req)
            <tr>
                <td>
                    <div class="user_requisites">{{$req->legal_name}}</div>
                    <form action="{{route('user.req.update',['id' => $user_id])}}" method="post" style="display: none;">
                        {{method_field('PUT')}}
                        <div class="input-group">
                        <span class="input-group-btn">
                            <button onclick="application.hideUserRequisitesForm(this)" class="btn btn-danger" type="button"><i class="fa fa-times"></i></button>
                        </span>
                            <input type="hidden" name="req_id" value="{{$req->id}}">
                            <input
                                    class="form-control"
                                    type="text"
                                    name="legal_name"
                                    value="{{$req->legal_name}}"
                                    placeholder="{{ trans('user::form.requisite.legal_name') }}"
                            >
                            <span class="input-group-btn">
                                <button onclick="application.updateUserRequisite(this)" class="btn btn-success" type="button"><i class="ion ion-checkmark"></i></button>
                            </span>
                        </div>
                    </form>
                </td>
                <td>
                    <div class="user_requisites">{{$req->iin}}</div>
                    <form action="{{route('user.req.update',['id' => $user_id])}}" method="post" style="display: none;">
                        {{method_field('PUT')}}
                        <div class="input-group">
                        <span class="input-group-btn">
                            <button onclick="application.hideUserRequisitesForm(this)" class="btn btn-danger" type="button"><i class="fa fa-times"></i></button>
                        </span>
                            <input type="hidden" name="req_id" value="{{$req->id}}">
                            <input
                                    class="form-control"
                                    type="text"
                                    name="iin"
                                    value="{{$req->iin}}"
                                    placeholder="{{ trans('user::form.requisite.iin') }}"
                            >
                            <span class="input-group-btn">
                                <button onclick="application.updateUserRequisite(this)" class="btn btn-success" type="button"><i class="ion ion-checkmark"></i></button>
                            </span>
                        </div>
                    </form>
                </td>
                <td>
                    <div class="user_requisites">{{$req->bank}}</div>
                    <form action="{{route('user.req.update',['id' => $user_id])}}" method="post" style="display: none;">
                        {{method_field('PUT')}}
                        <div class="input-group">
                        <span class="input-group-btn">
                            <button onclick="application.hideUserRequisitesForm(this)" class="btn btn-danger" type="button"><i class="fa fa-times"></i></button>
                        </span>
                            <input type="hidden" name="req_id" value="{{$req->id}}">
                            <input
                                    class="form-control"
                                    type="text"
                                    name="bank"
                                    value="{{$req->bank}}"
                                    placeholder="{{ trans('user::form.requisite.bank') }}"
                            >
                            <span class="input-group-btn">
                                <button onclick="application.updateUserRequisite(this)" class="btn btn-success" type="button"><i class="ion ion-checkmark"></i></button>
                            </span>
                        </div>
                    </form>
                </td>
                <td>
                    <div class="user_requisites">{{$req->bin}}</div>
                    <form action="{{route('user.req.update',['id' => $user_id])}}" method="post" style="display: none;">
                        {{method_field('PUT')}}
                        <div class="input-group">
                        <span class="input-group-btn">
                            <button onclick="application.hideUserRequisitesForm(this)" class="btn btn-danger" type="button"><i class="fa fa-times"></i></button>
                        </span>
                            <input type="hidden" name="req_id" value="{{$req->id}}">
                            <input
                                    class="form-control"
                                    type="text"
                                    name="bin"
                                    value="{{$req->bin}}"
                                    placeholder="{{ trans('user::form.requisite.bin') }}"
                            >
                            <span class="input-group-btn">
                                <button onclick="application.updateUserRequisite(this)" class="btn btn-success" type="button"><i class="ion ion-checkmark"></i></button>
                            </span>
                        </div>
                    </form>
                </td>
                <td>
                    <div class="user_requisites">{{$req->iik}}</div>
                    <form action="{{route('user.req.update',['id' => $user_id])}}" method="post" style="display: none;">
                        {{method_field('PUT')}}
                        <div class="input-group">
                        <span class="input-group-btn">
                            <button onclick="application.hideUserRequisitesForm(this)" class="btn btn-danger" type="button"><i class="fa fa-times"></i></button>
                        </span>
                            <input type="hidden" name="req_id" value="{{$req->id}}">
                            <input
                                    class="form-control"
                                    type="text"
                                    name="iik"
                                    value="{{$req->iik}}"
                                    placeholder="{{ trans('user::form.requisite.iik') }}"
                            >
                            <span class="input-group-btn">
                                <button onclick="application.updateUserRequisite(this)" class="btn btn-success" type="button"><i class="ion ion-checkmark"></i></button>
                            </span>
                        </div>
                    </form>
                </td>
                <td>
                    <div class="user_requisites">{{$req->cbe}}</div>
                    <form action="{{route('user.req.update',['id' => $user_id])}}" method="post" style="display: none;">
                        {{method_field('PUT')}}
                        <div class="input-group">
                        <span class="input-group-btn">
                            <button onclick="application.hideUserRequisitesForm(this)" class="btn btn-danger" type="button"><i class="fa fa-times"></i></button>
                        </span>
                            <input type="hidden" name="req_id" value="{{$req->id}}">
                            <input
                                    class="form-control"
                                    type="text"
                                    name="cbe"
                                    value="{{$req->cbe}}"
                                    placeholder="{{ trans('user::form.requisite.cbe') }}"
                            >
                            <span class="input-group-btn">
                                <button onclick="application.updateUserRequisite(this)" class="btn btn-success" type="button"><i class="ion ion-checkmark"></i></button>
                            </span>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        <tbody>
        </tbody>
    </table>
@else
    <div class="alert alert-info">
        <p>{{trans('user::profile.requisites_not_found')}}</p>
    </div>
@endif
