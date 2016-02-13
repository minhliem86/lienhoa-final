<?php
namespace admin\controllers;

use Confide, View, Config;
use services\User\RepoInterface as User;
use services\Role\RepoInterface as Role;
use services\Permission\RepoInterface as Permission;
use validations\RolePerForm as RolePer;
use validations\ChangePassForm as ChangePass;
use validations\CustomException\FormValidationException;
/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends \BaseController
{
    protected $user;
    protected $role;
    protected $pers;
    protected $validator;
    protected $changepass;

    protected $newpass = "123456";

    public function __construct(User $user, Role $role, Permission $permission, RolePer $roleper, ChangePass $changepass){
        $this->user = $user;
        $this->role = $role;
        $this->pers = $permission;
        $this->validator = $roleper;
        $this->changepass = $changepass;
    }

    public function index(){
        // $user = $this->user->select_except($this->user->findCurrent()->id);
        $user = $this->user->select_all();
        return \View::make('admin::pages.user.index')->with(compact('user'));
    }

    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
        $role = $this->role->select_list('name','id');
        return View::make(Config::get('confide::signup_form'))->with(compact('role'));
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {
        $repo = \App::make('UserRepository');
        $user = $repo->signup(\Input::all());

        if ($user->id) {
            // if (\Config::get('confide::signup_email')) {
            //     \Mail::queueOn(
            //         \Config::get('confide::email_queue'),
            //         \Config::get('confide::email_account_confirmation'),
            //         compact('user'),
            //         function ($message) use ($user) {
            //             $message
            //                 ->to($user->email, $user->username)
            //                 ->subject(L\ang::get('confide::confide.email.account_confirmation.subject'));
            //         }
            //     );
            // }

            $role = $this->role->find(\Input::get('role'));
            $user->attachRole($role);

            return \Redirect::route('admin.category.index')
                ->with('notice', \Lang::get('confide::confide.alerts.account_created'));
        } else {
            $error = $user->errors()->all(':message');

            return \Redirect::back()
                ->withInput(\Input::except('password'))
                ->with('error', $error);
        }
    }

    /**
     * Displays the login form
     *
     * @return  Illuminate\Http\Response
     */
    public function login()
    {
        if (Confide::user()) {
            return \Redirect::to('/');
        } else {
            return \View::make(Config::get('confide::login_form'));
        }
    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function doLogin()
    {
        $repo = \App::make('UserRepository');
        $input = \Input::all();

        if ($repo->login($input)) {
            return \Redirect::route('dashboard');
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = \Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = \Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = \Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return \Redirect::back()
                ->withInput(\Input::except('password'))
                ->with('error', $err_msg);
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     *
     * @return  Illuminate\Http\Response
     */
    public function confirm($code)
    {
        if (\Confide::confirm($code)) {
            $notice_msg = \Lang::get('confide::confide.alerts.confirmation');
            return \Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = \Lang::get('confide::confide.alerts.wrong_confirmation');
            return \Redirect::action('UsersController@login')
                ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        return \View::make(\Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function doForgotPassword()
    {
        if (\Confide::forgotPassword(\Input::get('email'))) {
            $notice_msg = \Lang::get('confide::confide.alerts.password_forgot');
            return \Redirect::route('getLogin')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = \Lang::get('confide::confide.alerts.wrong_password_forgot');
            return \Redirect::back()
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function resetPassword($token)
    {
        return \View::make('admin::pages.user.reset_password')
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function doResetPassword()
    {
        $repo = \App::make('UserRepository');
        $input = array(
            'token'                 =>\Input::get('token'),
            'password'              =>\Input::get('password'),
            'password_confirmation' =>\Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = \Lang::get('confide::confide.alerts.password_reset');
            return \Redirect::route('getLogin')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = \Lang::get('confide::confide.alerts.wrong_password_reset');
            return \Redirect::back()
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function logout()
    {
        Confide::logout();

        return \Redirect::route('getLogin')->with('notice','See you again!');
    }

    public function delete($id){
        $this->post->delete($id);
        \Notification::success('Deleted !');
        return \Redirect::back();
    }

    public function deleteall(){
        if(!\Request::ajax()){
         return \View::make('404');
        }else{
         $data = \Input::get('arr');
         if(!$data){
             return \Response::json(array('msg'=>'error'));
         }else{
             $this->post->delete($data);
             return \Response::json(array('msg'=>'success'));
         }
        }
    }

    public function resetPass($id){
        $user = $this->user->find($id);
        $user->password = $this->newpass;    
        $user->save();

        $data = array('user'=>$user->first_name,'email'=>$user->email,'newpass'=>$this->newpass);
        \Mail::send('admin::emails.resetpassword',$data, function($msg) use($data){
         $msg->from('trungtamthongbao@gmail.com', 'Admin');
         $msg->to($data['email'], 'Reset Password')->subject('Reset Password');
        });
        Confide::logout();

        \Notification::success("New Password sent to user's email");
        return \Redirect::intended('admin/login');
    }

    // CHANGE PASSWORD
    public function changePass(){
        return \View::make('admin::pages.user.changepass');
    }

    public function dochangePass(){
        $input = \Input::all();
        try{
            $this->changepass->validate($input);
        }
        catch(FormValidationException $e){
            return \Redirect::back()->withErrors($e->getErrors());
        }
        $user_id = \Auth::user()->id;
        $newpass = \Hash::make(\Input::get('newpassword'));

        $this->user->update($user_id, array('password'=>$newpass));
        \Notification::success('Password has changed. Please login with new password !');
        \Auth::logout();
        return \Redirect::route('getLogin');
    }



    // CREATE ROLE
    public function createRole(){
        $role = $this->role->select_all();
        return \View::make('admin::pages.role.create')->with(compact('role'));
    }
    public function docreateRole(){
        $pers = \Input::get('name_per');
        try{
            $this->validator->validate(\Input::all());
        }
        catch(FormValidationException $e){
            return \Redirect::back()->withErrors($e->getErrors());
        }
        $data = array('name'=>\Input::get('name_role'));
        $role = $this->role->createGet($data);
        $id_role = $role->id;
        $role_att = $this->role->find($id_role);
        // print_r($role_att);
        foreach($pers as $k=>$per){
                    $check_per = $this->pers->whereFirst('name',\Str::lower($per),array());
                    if($check_per == null){
                            $data= array('name'=>\Str::lower($per), 'display_name'=>\Unicode::make($per));
                            $news[$k] = $this->pers->createGet($data);
                    }else{
                            $news[$k] = $check_per;
                    }
                    $role_att->attachPermission($news[$k]);                        
        }
        \Notification::success('Create Role with Permission');
        return \Redirect::back();
    }

    // UPDATE ROLE
    public function updateRole($id){
        $user = $this->user->getRole($id,array('roles'));
        $roles = $user->roles()->get();
        // return \View::make('admin::pages.role.update')->with(compact('user','roles'));
    }
}
