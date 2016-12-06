<div class="col-md-4">
    <div class="profile_gal_image">
        <img class="img-responsive" src="/upload/images/{{$photo->src}}" alt="Photo #{{$photo->id}} - {{$user->name}}"/>
        <p>{{$photo->name}}</p>
        <div class="links">
            <a href="{{route('user.update.image',['id' => $user->id, 'image' => $photo->id])}}" title="Set as default" data-image-id="{{$photo->id}}" class="set_default_image"><i class="fa fa-user"></i></a>
        </div>
    </div>
</div>