<?php

namespace App\Modules\User\Http\Controllers;

use App\Image;
use App\Library\BFields;
use App\Modules\User\Http\Requests\CreateRoleRequest;
use App\Modules\User\Http\Requests\CreateUserRequest;
use App\Modules\User\Http\Requests\CreateUserRequisiteRequest;
use App\Modules\User\Http\Requests\EditUserRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\User\Http\Requests\UpdateImageProfileRequest;
use App\Modules\User\Http\Requests\UpdateRolePermissionsRequest;
use App\Modules\User\Http\Requests\UpdateRoleRequest;
use App\Modules\User\Http\Requests\UpdateUserPasswordRequest;
use App\Modules\User\Http\Requests\UpdateUserRequisitesRequest;
use App\Modules\User\Http\Requests\UpdateUserRoleRequest;
use App\Requisite;
use App\Role;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Create a user
     *
     * @param CreateUserRequest $request
     * @return RedirectResponse
     */
    public function userCreate(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        foreach ($request->get('roles') as $roleID){
            $user->assignRole($roleID);
        }

        if($user instanceof User){
            \Flash::success(trans('user::module.messages.user.created_successfully'));
            return redirect()->route('user.profile',['id' => $user->id]);
        }else{
            \Flash::error(trans('user::module.messages.user.could_not_create'));
            return redirect()->back();
        }

    }

    /**
     * Create requisite for user
     *
     * @param $id
     * @param CreateUserRequisiteRequest $request
     * @return RedirectResponse
     */
    public function createUserRequisite($id, CreateUserRequisiteRequest $request)
    {
        $user = User::where('id',$id)->firstOrFail();
        $requisite = $user->createRequisite($request);
        if ($requisite instanceof Requisite){
            \Flash::success(trans('user::profile.messages.requisite_created_successfully'));
            if ($user->is_current()) {
                $this->reloadCurrentUser($user);
            }
            return redirect()->route('user.profile',['id' => $user->id]);
        }else{
            return redirect()
                ->route('user.edit',['id' => $user->id, 'tab' => 'requisite'])
                ->withErrors(['requisite_not_created' => trans('user::profile.messages.requisite_not_created')]);
        }
    }

    public function requisitesUpdate($id, UpdateUserRequisitesRequest $request)
    {
        $user = User::where('id',$id)->firstOrFail();
        $requisite = $user->requisites()->where('id',$request->get('req_id'))->firstOrFail();
        if($request->has('legal_name'))
            $requisite->legal_name = $request->get('legal_name');
        if($request->has('bank'))
            $requisite->bank = $request->get('bank');
        if($request->has('iik'))
            $requisite->iik = $request->get('iik');
        if($request->has('iin'))
            $requisite->iin = $request->get('iin');
        if($request->has('bin'))
            $requisite->bin = $request->get('bin');
        if($request->has('cbe'))
            $requisite->cbe = $request->get('cbe');

        if($requisite->save()){
            if ($request->ajax()){
                return json_encode([
                    'status' => 'success',
                    'title' => trans('user::profile.messages.updated_successfully'),
                    'message' => trans('user::profile.messages.requisite_updated_successfully'),
                ]);
            }else{
                \Flash::success(trans('user::profile.messages.requisite_updated_successfully'));
                return redirect()->route('user.prodile',['id' => $id]);
            }
        }

        if ($request->ajax()){
            return json_encode([
                'status' => 'error',
                'title' => trans('user::profile.messages.not_updated'),
                'message' => trans('user::profile.messages.requisite_not_updated'),
            ]);
        }else{
            \Flash::success(trans('user::profile.messages.requisite_not_updated'));
            return redirect()->back();
        }
    }

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
     * Update user password
     *
     * @param $id
     * @param UpdateUserPasswordRequest $request
     * @return RedirectResponse
     */
    public function updatePassword($id, UpdateUserPasswordRequest $request)
    {
        $user = User::where('id',$id)->firstOrFail();

        if (\Auth::validate(['email' => $user->email, 'password' => $request->get('current_password')])) {
            $user->password = bcrypt($request->get('password'));

            if ($user->save()){
                \Flash::success(trans('user::profile.auth.password_updated'));
                return redirect()->route('user.profile',['id' => $user->id]);
            }else{
                \Flash::success(trans('user::profile.auth.password_not_updated'));
                return redirect()->route('user.profile',['id' => $user->id]);
            }
        }

        return redirect()->route('user.edit',['id' => $id, 'tab' => 'password'])->withErrors([
            'current_password' => trans('user::profile.auth.password_is_not_valid')
        ]);
    }

    public function updateUserRole($id, UpdateUserRoleRequest $request)
    {
        $user = User::where('id', $id)->firstOrFail();

        $user->syncRoles($request->get('roles'));
        if($user->is_current()) $this->reloadUserRoles();

        \Flash::info(trans('user::module.messages.user.user_role_updated'));
        return redirect()->route('user.profile',['id' => $id]);

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
            return $this->noAccess( trans('user::module.messages.access_denied') );
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rolesCreate(CreateRoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'special' => null
        ]);

        if($request->has('create_has_role')){
            $rolePerms = Role::whereSlug($request->get('has_role'))->first();
            $permissions = [];

            foreach ($rolePerms->permissions as $permission) {
                $permissions[]  = $permission->id;
            }

            $role->syncPermissions($permissions);
        }


        if($role instanceof Role){
            \Flash::success(trans('user::module.messages.role.created_successfully',['name' => $role->name]));
            return redirect()->route('user.roles.show_slug',['slug' => $role->slug]);
        }else{
            \Flash::error(trans('user::module.messages.role.could_not_create',['name' => $request->input('name')]));
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
            \Flash::success(trans('user::module.messages.permission.updated_for_role',['name' => $role->name]));
        }else{
            \Flash::error(trans('user::module.messages.permission.could_not_updated_for_role',['name' => $role->name]));
        }

        return redirect()->route('user.roles.show_slug',['slug' => $role->slug]);
    }

    /**
     * Update role attributes
     *
     * @param $id
     * @param UpdateRoleRequest $request
     * @return RedirectResponse
     */
    public function rolesUpdate($id, UpdateRoleRequest $request)
    {
        $role = Role::where('id',$id)->firstOrFail();
        $updateData = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description')
        ];
        if($role->update($updateData)){
            \Flash::success(trans('user::module.messages.role.updated_successfully',['name' => $role->name]));
            $result = redirect()->route('user.roles.show_slug',['slug' => $role->slug]);
        }else{
            \Flash::error(trans('user::module.messages.role.could_not_updated',['name' => $role->name]));
            $result = redirect()->back()->withInput($request->all());
        }
        return $result;
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
                    'message' => trans('user::module.messages.access_denied'),
                    'data' => []
                ]);
            }
            \Flash::warning( trans('user::module.messages.access_denied') );
            return $this->noAccess( trans('user::module.messages.access_denied') );
        }

        $user = User::whereId($id)->firstOrFail();

        $imageModel = $user->photos()->where('id',$request->get('image'))->firstOrFail();
        if($user->updateProfileImage($imageModel)){
            if($request->isXmlHttpRequest()){
                $result = json_encode([
                    'status' => 'success',
                    'message' => trans('user::module.messages.user.image_updated_successfully'),
                    'data' => $imageModel->toArray()
                ]);
            }else{
                \Flash::success( trans('user::module.messages.user.image_updated_successfully') );
                $result = redirect()->route('user',['id' => $id]);
            }
        }else{
            if($request->isXmlHttpRequest()){
                $result = json_encode([
                    'status' => 'error',
                    'message' => trans('user::module.messages.user.image_could_not_updated'),
                    'data' =>[]
                ]);
            }else{
                \Flash::error( trans('user::module.messages.user.image_could_not_updated') );
                $result = redirect()->route('user',['id' => $id]);
            }
        }

        return $result;
    }

    public function uploaderImages(Request $request)
    {
        if(!$request->hasFile('files')){
            if($request->isXmlHttpRequest()){
                return json_encode([
                    'status' => 'error',
                    'message' => 'empty request',
                    'data' => []
                ]);
            }
            \Flash::warning('empty request');
            return redirect()->back();
        }

        $result = null;
        $currentUser = $this->getCurrentUser();
        if(!\Auth::check()){
            if($request->isXmlHttpRequest()){
                return json_encode([
                    'status' => 'warning',
                    'message' => trans('user::module.messages.access_denied'),
                    'data' => []
                ]);
            }
            \Flash::warning( trans('user::module.messages.access_denied') );
            return $this->noAccess( trans('user::module.messages.access_denied') );
        }

        $file = $request->file('files')[0];
        $destinationPath = base_path() . '/public/upload/images/';
        $image_name = time() . "_" . $file->getClientOriginalName();
        $userPhoto = $file->move($destinationPath, $image_name);

        $image = Image::create([
            'name' => 'User Image',
            'src' => $image_name,
            'alt' => 'User Image',
            'imageable_id' => $currentUser->id,
            'imageable_type' => $currentUser::TYPE,
        ]);

        if ($image instanceof Image) {
            $this->reloadCurrentUser();
            if($request->isXmlHttpRequest()){
                return json_encode([
                    'status' => 'success',
                    'message' => trans('user::module.messages.user.image_uploaded_successfully'),
                    'data' => $image->toArray()
                ]);
            }
            \Flash::success(trans('user::module.messages.user.image_uploaded_successfully'));
            return redirect()->back();
        } else {
            unlink($userPhoto->getPath());
            if($request->isXmlHttpRequest()){
                return json_encode([
                    'status' => 'error',
                    'message' => trans('user::module.messages.user.image_could_not_upload'),
                    'data' => []
                ]);
            }
            \Flash::warning(trans('user::module.messages.user.image_could_not_upload'));
            return redirect()->back();
        }

    }


    public function rolesDelete($id)
    {
        $role = Role::where('id', $id)->firstOrFail();
        if($role->delete()){
            \Flash::success(trans('user::module.messages.role.deleted_successfully',['name' => $role->name]));
            $result = redirect()->route('user.roles');
        }else{
            \Flash::error(trans('user::module.messages.role.could_not_deleted',['name' => $role->name]));
            $result = redirect()->back();
        }
        return $result;
    }
}
