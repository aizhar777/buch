<!-- page content -->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">


        <form action="{{route('user.roles.store')}}" method="post" class="form-horizontal form-label-left">
            {{csrf_field()}}

            <div class="form-group">
                <label for="role_name" class="control-label col-md-3 col-sm-3 col-xs-12">Name role</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <input name="name" id="role_name" type="text" class="form-control" placeholder="Role name"
                           value="{{old('name')}}">
                </div>
            </div>

            <div class="form-group">
                <label for="role_slug" class="control-label col-md-3 col-sm-3 col-xs-12">Slug role</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <input name="slug" id="role_slug" type="text" class="form-control" placeholder="Slug name"
                           value="{{old('slug')}}">
                </div>
            </div>

            <div class="form-group">
                <label for="role_desc" class="control-label col-md-3 col-sm-3 col-xs-12">Description role</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="description" id="role_desc" rows="5">{{old('description')}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="role_desc" class="control-label col-md-3 col-sm-3 col-xs-12">Admin role</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="checkbox" name="special"> has administrator role
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-large btn-primary" type="submit">Create</button>
            </div>

        </form>
    </div>
</div>
<!-- /page content -->
