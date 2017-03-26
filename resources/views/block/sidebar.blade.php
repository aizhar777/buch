<?php
    if(\Session::has('current.user')){
        $user = \Session::get('current.user');
    }else{
        $user = \Auth::user();
    }
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/upload/images/{{(\Session::has('current.image'))? session('current.image') : 'user.png' }}" class="img-circle cur_pr_img" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{$user->name}}</p>
                <!-- Status -->
                <a href="{{route('user.profile',['id' => $user->id])}}"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->



        @if(\Module::count() > 0)
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">LINKS</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
            <li><a href="{{ route('clearCache') }}"><i class="fa fa-eraser"></i> <span>Очистить кэш</span></a></li>

            <li class="header">MODULES</li>
            @foreach(\Module::all() as $module)
                @if ($module['enabled'])
                    <?php

                    $name = $module['name'];
                    $classModule = config('modules.namespace').$name.'\\'.$name.'Module';
                    if(class_exists($classModule)){
                        $mod = new $classModule();
                        if(!empty($mod->menuSidebar())){
                            echo $mod->menuSidebar();
                        }
                    }

                    ?>
                @endif
            @endforeach
        </ul>
        <!-- /.sidebar-menu -->
        @endif

    </section>
    <!-- /.sidebar -->
</aside>