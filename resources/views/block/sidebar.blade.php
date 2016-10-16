<?php $user = Auth::user() ?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="/home" class="site_title">
                <i class="fa fa-cogs"></i> <span>{{config('app.name')}}</span>
            </a>
        </div>

        <div class="clearfix"></div>
        <!-- menu profile quick info -->
        <div class="profile" style="margin-bottom: 35px">
            <div class="profile_pic">
                <img src="/images/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{$user->name}}</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <!-- General DropDown menu
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/home">Dashboard</a></li>
                        </ul>
                    </li>
                </ul>
            </div>-->

            @if(\Module::count() > 0)
                <div class="menu_section">
                    <h3>Modules</h3>

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
                </div>
            @endif

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>