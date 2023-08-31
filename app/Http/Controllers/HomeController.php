<?php
namespace App\Http\Controllers;

use App\Models\ContentManagement;
use App\Models\ResetPassword;
use App\Models\User;
use App\Models\UserApiToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->__viewData['header_class'] = '';
        $this->__viewData['body_class'] = '';
        $this->__viewData['is_show_footer'] = true;
        $this->__viewData['footer_class'] = 'mt';
    }

    public function index()
    {
        $this->__viewData['footer_class'] = '';
        return $this->__renderView('index');
    }

    public function about()
    {
        return $this->__renderView('about');
    }

    public function participatingBusinesses()
    {
        if (!auth()->user()){
            return redirect()->route('home')->with('LoginError','You are not logged in');
        }

        if (empty(session('user')->user_package->package_id)){
            return redirect()->route('home')->with('error','Please buy a subscription plan');
        }
        $current_date = date('Y-m-d');
        if (strtotime($current_date) > strtotime(session('user')->user_package->expiry_date)){
            return redirect()->route('home')->with('error','Your subscription has been expired. Please upgrade your plan  ');
        }
        $response = $this->__httpApiGetRequest('category',['type' => 'promote']);
        $this->__viewData['businessCategories'] = $response->data;

        return $this->__renderView('brands');
    }

    public function brandsMap()
    {
        $response = $this->__httpApiGetRequest('category',['type' => 'promote']);
        $this->__viewData['businessCategories'] = $response->data;

        $this->__viewData['is_show_footer'] = false;
        return $this->__renderView('brands-map');
    }

    public function participatingBusinessDetail($slug)
    {
        $response = $this->__httpApiGetRequest('vendor/'.$slug);
        if( empty($response->data) )
            return redirect()->route('participating-businesses');

        $this->__viewData['record'] = $response->data;
        return $this->__renderView('brand-detail');
    }

    public function recipeDetail($slug)
    {
        $params['user_id'] = Auth::check() ? session('user')->id : 0;
        $response = $this->__httpApiGetRequest('vendor/deal/'.$slug,$params);
        if( empty($response->data) )
            return redirect()->route('participating-businesses');

        $this->__viewData['record'] = $response->data;
        $this->__viewData['header_class'] = 'sticky-top';
        return $this->__renderView('recipe-detail');
    }

    public function membership()
    {
		
        $this->__viewData['header_class'] = 'sticky-top';
        $this->__viewData['footer_class'] = '';
        return $this->__renderView('membership');
    }

    public function contact()
    {
        $this->__viewData['footer_class'] = '';
        $this->__viewData['header_class'] = 'sticky-top';
        return $this->__renderView('contact');
    }

    public function login()
    {
        $this->__viewData['box_center_class'] = 'logins-boxs-center';
        return $this->__renderView('auth.login');
    }

    public function forgotPassword()
    {
        $this->__viewData['box_center_class'] = 'forget-password-center';
        return $this->__renderView('auth.forgot-password');
    }

    public function resetPassword(Request $request,$token)
    {
        $checkRequest = ResetPassword::getUserRequest($token);
        if( !isset($checkRequest->id) )
            return redirect('login')->with('error',__('app.invalid_new_password_link'));

        if( strtotime(Carbon::now()) > strtotime(Carbon::make($checkRequest->created_at)->addHour()) )
            return redirect('login')->with('error',__('app.invalid_new_password_link'));

        if( $request->isMethod('post') )
            return $this->_submitResetPassword($request,$checkRequest);

        $this->__viewData['main_section_class'] = 'forgert-sec';
        $this->__viewData['box_center_class'] = 'logins-boxs-center';
        return $this->__renderView('auth.reset-password');
    }

    private function _submitResetPassword($request,$reset_pass_record)
    {
        $custom_messages = [
            'new_password.regex' => __('app.password_regex')
        ];
        $validator = Validator::make($request->all(), [
            'new_password'     => [
                'required',
                'regex:/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,150}$/'
            ],
            'confirm_password' => 'required|same:new_password',
        ],$custom_messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator) ->withInput();
        }
        //update new password
        User::updateUserByEmail($reset_pass_record->email,['password' => Hash::make($request['new_password'])]);
        //delete reset password request
        $reset_pass_record->forceDelete();
        //delete all api token
        UserApiToken::where('user_id',$reset_pass_record->user_id)->forceDelete();

        return redirect('login')->with('success',__('app.password_success_msg'));
    }

    public function becomeMember()
    {   
        $this->__viewData['box_center_class'] = 'suscribtion-center';
        return $this->__renderView('auth.become-member');
    }

    public function subscription()
    {
        $this->__viewData['box_center_class'] = 'suscribtions-box-center';
        return $this->__renderView('auth.subscription');
    }

    public function myAccount()
    {
        $this->__viewData['is_show_footer'] = false;
        $this->__viewData['body_class'] = 'my-account';
        return $this->__renderView('account.my-account');
    }

    public function welcome()
    {
        $this->__viewData['box_center_class'] = 'forget-password-center';
        return $this->__renderView('auth.welcome');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}
