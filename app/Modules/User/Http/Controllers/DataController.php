<?php

namespace App\Modules\User\Http\Controllers;

use App\Library\BFields;
use App\Modules\User\Http\Requests\CreateRoleRequest;
use App\Modules\User\Http\Requests\EditUserRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\User\Http\Requests\UpdateImageProfileRequest;
use App\Modules\User\Http\Requests\UpdateRolePermissionsRequest;
use App\Role;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Update User action
     *
     * @param $id
     * @param EditUserRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function userEdit($id, EditUserRequest $request)
    {
        $user = $this->getCurrentUser();
        if($user instanceof User){
            if($user->id == $id) {
                return $this->updateUser($user, $request);
            }else {
                return $this->updateProfile($id, $request);
            }
        }
        abort(404);
    }

    /**
     * Update user profile
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    protected function updateProfile($id, Request $request)
    {
        if(!$this->checkPerm('edit.user'))
            return $this->noAccess('Not enough rights to edit user');
        $user = User::whereId($id)->firstOrFail();

        return $this->updateUser($user, $request);
    }

    /**
     * Update current user
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function updateUser(User $user, Request $request)
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->saveOrFail();

        if(!$user->createImage($request)){
            \Flash::warning('Failed to change current photo');
        }

        $bFields = BFields::getInstance();
        $bFields->updateOrCreate($user, $request);

        if($user->is_current())
            $user->reloadCurrentUser();

        return redirect()->route('user.profile',$user->id);
    }

    /**
     * Create role
     *
     * @param CreateRoleRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function rolesCreate(CreateRoleRequest $request)
    {
        $role = Role::create($request->all());
        if($role instanceof Role){
            \Flash::success('New role "' . $role->name . '" created!');
            return redirect()->route('user.roles.show_slug',['slug' => $role->slug]);
        }else{
            \Flash::error('Role not created!');
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Update permissions for role
     *
     * @param $id
     * @param UpdateRolePermissionsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rolesUpdatePermissions($id, UpdateRolePermissionsRequest $request)
    {
        $role = Role::whereId($id)->firstOrFail();

        $role->syncPermissions($request->get('permissions'));
        if($role->save()){
            \Flash::success('Permissions updated for the role of "' . $role->name . '"!');
        }else{
            \Flash::error('Could not update permissions for the ' . $role->slug . ' role!');
        }

        return redirect()->route('user.roles.show_slug',['slug' => $role->slug]);
    }

    /**
     * @param $id
     * @param $image
     * @param UpdateImageProfileRequest $request
     * @return RedirectResponse|string
     */
    public function userUpdateImage($id, $image, UpdateImageProfileRequest $request)
    {
        $result = null;
        $currentUser = $this->getCurrentUser();
        $update_ses = ($currentUser->id == $id);
        if(!$update_ses && !$this->checkPerm('edit.user')){
            if($request->isXmlHttpRequest()){
                return json_encode([
                    'status' => 'warning',
                    'message' => 'Access is denied. You do not have permission for this operation!',
                    'data' => []
                ]);
            }
            \Flash::warning('Access is denied. You do not have permission for this operation!');
            return $this->noAccess('Access is denied');
        }

        $user = User::whereId($id)->firstOrFail();

        $imageModel = $user->photos()->where('id',$request->get('image'))->firstOrFail();
        if($user->updateProfileImage($imageModel)){
            if($request->isXmlHttpRequest()){
                $result = json_encode([
                    'status' => 'success',
                    'message' => 'You\'r profile image updated!',
                    'data' => $imageModel->toArray()
                ]);
            }else{
                \Flash::success('You\'r profile image updated!');
                $result = redirect()->route('user',['id' => $id]);
            }
        }else{
            if($request->isXmlHttpRequest()){
                $result = json_encode([
                    'status' => 'error',
                    'message' => 'You\'r profile image not updated!',
                    'data' =>[]
                ]);
            }else{
                \Flash::error('You\'r profile image not updated!');
                $result = redirect()->route('user',['id' => $id]);
            }
        }

        return $result;
    }
}
