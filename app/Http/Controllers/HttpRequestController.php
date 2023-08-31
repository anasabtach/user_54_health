<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HttpRequestController extends Controller
{
    protected $__request;

    public function __construct(Request $request)
    {
        $this->__request = $request;
    }

    public function HttpRequest()
    {   
        $action = $this->__request['action'];
        
        switch($action){
            case 'registration':
                $function = $this->_registration();
                break;
            case 'login':
                $function = $this->_login();
                break;
            case 'forgot-password':
                $function = $this->_forgotPassword();
                break;
            case 'update-profile':
                $function = $this->_updateProfile();
                break;
            case 'change-password':
                $function = $this->_changePassword();
                break;
            case 'subscription':
                $function = $this->_subscription();
                break;
            case 'get-deals':
                $function = $this->_getDeals();
                break;
            case 'related-deals':
                $function = $this->_getRelatedDeals();
                break;
            case 'community':
                $function = $this->_community();
                break;
            case 'vendor-deals':
                $function = $this->_vendorDeals();
                break;
            case 'vendor-review':
                $function = $this->_vendorReviews();
                break;
            case 'notification-setting':
                $function = $this->_notificationSetting();
                break;
            case 'get-quote':
                $function = $this->_getQuote();
                break;
            case 'delete_deal':
                $function = $this->_deleteDeal();
                break;
            case 'vendors-map':
                $function = $this->_vendorsMap();
                break;
            case 'content':
                $function = $this->_getContent();
                break;
            case 'vendor-rating':
                $function = $this->_getVendorRating();
                break;
            case 'statistics':
                $function = $this->_getStatistics();
                break;
            case 'make-favourite-deal':
                $function = $this->_makeFavouriteDeal();
                break;
            case 'deal_redeem':
                $function = $this->_dealRedeem();
                break;
            case 'contact-us':
                $function = $this->_contactUs();
                break;
            case 'get-favourite-deal':
                $function = $this->_getFavouriteDeals();
                break;
            case 'share_referral_link':
                $function = $this->_shareReferralLink();
                break;
            case 'referral_history':
                $function = $this->_referralHistory();
                break;
            case 'subscription_history':
                $function = $this->_subscriptionHistory();
                break;
            case 'addRating':
                $function = $this->_addRating();
                break;
        }
        return $function;
    }

    private function _registration()
    {   
        $request        = $this->__request;
        $params         = $request->all();
        $params['user_group_id'] = 3;
        $attachments = [];
        if( !empty($request['id_card']) ){
            $image_url      = fopen($request['id_card']->getPathName(), 'r');
            $image_name     = $request['id_card']->getClientOriginalName();
            $attachments[]  = [ 'key' => 'id_card' ,'file' => $image_url, 'name' => $image_name ];
        }
        $params['mobile_no'] = '+1-'.$params['mobile_no'];
        $response       = $this->__httpApiPostRequest('user',$params,$attachments);
        if( $response->code == 400 ){
            return redirect()->back()->with('api_error',$response->data)->withInput();
        }
        return redirect()->route('login')->with('success',$response->message);
    }

     private function _login()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $params['user_group_id'] = 3;
        $response       = $this->__httpApiPostRequest('user/login',$params);
        if( $response->code == 400 ){
            return redirect()->route('login')->with('api_error',$response->data)->withInput();
        }
        session(['user' => $response->data]);
        Auth::loginUsingId($response->data->id);
        if ($response->data->user_package == null){
            return redirect()->route('my-account',['tab' => 'v-pills-settings']);
        }
        return redirect()->route('participating-businesses');
    }

    private function _forgotPassword()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $params['user_group_id'] = 3;
        $response       = $this->__httpApiPostRequest('user/forgot-password',$params);
        if( $response->code == 400 ){
            return redirect()->back()->with('api_error',$response->data)->withInput();
        }
        return redirect()->back()->with('success',$response->message);
    }

    public function _updateProfile()
    {
        $user           = session('user');
        $request        = $this->__request;
        $params         = $request->all();
        $params['_method'] = 'PUT';
        $attachments = [];
        if( !empty($request['image_url']) ){
            $image_url      = fopen($request['image_url']->getPathName(), 'r');
            $image_name     = $request['image_url']->getClientOriginalName();
            $attachments[]  = [ 'key' => 'image_url' ,'file' => $image_url, 'name' => $image_name ];
        }
        if( !empty($request['id_card']) ){
            $image_url      = fopen($request['id_card']->getPathName(), 'r');
            $image_name     = $request['id_card']->getClientOriginalName();
            $attachments[]  = [ 'key' => 'id_card' ,'file' => $image_url, 'name' => $image_name ];
        }
        $response       = $this->__httpApiPostRequest('user/' . $user->slug ,$params,$attachments);
        if( $response->code == 400 ){
            return redirect()->back()->with('api_error',$response->data)->withInput();
        }
        session(['user' => $response->data ]);
        return redirect()->back()->with('success',$response->message);
    }

    private function _changePassword()
    {
        session()->flash('tab','#v-pills-changepassword');
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiPostRequest('user/change-password' ,$params);
        if( $response->code == 400 ){
            return redirect()->back()->with('api_error',$response->data)->withInput();
        }
        return redirect()->back()->with('success',$response->message);
    }

    private function _subscription()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiPostRequest('subscription/buy' ,$params);
        if( $response->code == 400 ){
            return redirect()->back()->with('api_error',$response->data)->withInput();
        }
        session(['user' => $response->data ]);
        return redirect()->back()->with('success',$response->message);
    }

    private function _getDeals()
    {
        $request        = $this->__request;
        $params         = $request->all();

        $response       = $this->__httpApiGetRequest('deal',$params);
        if( $response->code != 200 ){
            return response()->json(['code' => $response->code, 'message' => $response->data ]);
        }
        $html = view('ajax-component.deal',['data' => $response->data])->render();
        return response()->json(['html' => $html , 'pagination' => $response->pagination ]);
    }

    private function _getRelatedDeals()
    {
        $request        = $this->__request;
        $params         = $request->all();

        $response       = $this->__httpApiGetRequest('vendor/related-deals',$params);
        if( $response->code != 200 ){
            return response()->json(['code' => $response->code, 'message' => $response->data ]);
        }
        $html = view('ajax-component.related-deal',['data' => $response->data])->render();
        return response()->json(['html' => $html , 'pagination' => $response->pagination ]);
    }

    private function _community()
    {
        $request        = $this->__request;
        $response       = $this->__httpApiGetRequest('vendors',$request->all());
        if( $response->code != 200 ){
            return response()->json(['code' => $response->code, 'message' => $response->data ]);
        }
        $html = view('ajax-component.community',['data' => $response->data])->render();
        return response()->json(['html' => $html , 'pagination' => $response->pagination ]);
    }

    private function _vendorDeals()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiGetRequest('vendor/deals',$params);
        if( $response->code != 200 ){
            return response()->json(['code' => $response->code, 'message' => $response->data ]);
        }
        $html = view('ajax-component.vendor-deal',['data' => $response->data])->render();
        return response()->json(['html' => $html , 'pagination' => $response->pagination ]);
    }

    private function _vendorReviews()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiGetRequest('vendor/rating',$params);
        if( $response->code != 200 ){
            return response()->json(['code' => $response->code, 'message' => $response->data ]);
        }
        $html = view('ajax-component.review',['data' => $response->data])->render();
        return response()->json(['html' => $html , 'pagination' => $response->pagination ]);
    }

    private function _notificationSetting()
    {
        $request           = $this->__request;
        $params            = $request->all();
        $update_params['_method'] = 'PUT';
        $update_params['notification_setting'] = $params['notification_setting'];
        $response = $this->__httpApiPostRequest('user/'.session('user')->slug,$update_params);
        if( $response->code != 200 ){
            return response()->json(['code' => $response->code, 'message' => $response->data ]);
        }
        session(['user' => $response->data ]);
        return response()->json(['message' => 'record has been updated successfully']);
    }

    private function _getQuote()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiGetRequest('quote',$params);
        return response()->json($response);
    }

    private function _deleteDeal()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiDeleteRequest('deal/'.$request['slug']);
        return response()->json($response);
    }

    private function _vendorsMap()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiGetRequest('vendors',$params);
        return response()->json($response);
    }

    private function _getContent()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiGetRequest('content',$params);
        return response()->json($response);
    }

    private function _getVendorRating()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiGetRequest('vendor/rating',$params);
        return response()->json($response);
    }

    private function _getStatistics()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiGetRequest('statistics',$params);
        return response()->json($response);
    }

    private function _makeFavouriteDeal()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response = $this->__httpApiPostRequest('favourite',$params);
        return response()->json($response);
    }

    private function _dealRedeem()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response = $this->__httpApiPostRequest('deal/redeem',$params);
        return response()->json($response);
    }

    private function _contactUs()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiPostRequest('contact-us',$params);
        if( $response->code == 400 ){
            return redirect()->back()->with('api_error',$response->data)->withInput();
        }
        return redirect()->back()->with('success',$response->message);
    }
    private function _addRating()
    {
        $user  = session('user');
       // dd($user);
        $request        = $this->__request;
        $params         = [
              "module" =>  $request->module,
              "module_id" =>  $request->module_id,
              "rating" => $request->rating,
              "review" =>  $request->review,
              "user_id" => $user->id,
        ];//$request->all();

        $response       = $this->__httpApiPostRequest('rating',$params);
        if( $response->code == 400 ){
            return redirect()->back()->with('api_error',$response->data)->withInput();
        }
        return redirect()->back()->with('success',$response->message);
    }

    private function _getFavouriteDeals()
    {
        $request        = $this->__request;
        $params         = $request->all();
        $response       = $this->__httpApiGetRequest('deal',$params);
        $html = view('ajax-component.favourite-deal',['data' => $response->data])->render();
        return response()->json(['html' => $html , 'pagination' => $response->pagination ]);
    }

    private function _shareReferralLink()
    {
        $request = $this->__request;
        $user    = session('user');

        $mail_params['REFERRAL_LINK'] = \URL::to('become-member') . '?referral_code=' . $user->referral_id;
        $mail_params['YEAR']     = date('Y');
        $mail_params['APP_NAME'] = env('APP_NAME');
        sendMail($request->email,'share-referral-link',$mail_params);

        return redirect()->back()->with('success','Referral link has been shared successfully');
    }

    private function _referralHistory()
    {
        $request = $this->__request;
        $response       = $this->__httpApiGetRequest('user-invite',$request->all());
        $html = view('ajax-component.referral_history',['data' => $response->data])->render();
        return response()->json(['html' => $html , 'pagination' => $response->pagination ]);
    }

    private function _subscriptionHistory()
    {
        $request = $this->__request;
        $response       = $this->__httpApiGetRequest('subscription/history',$request->all());
        $html = view('ajax-component.subscription_history',['data' => $response->data])->render();
        return response()->json(['html' => $html , 'pagination' => $response->pagination ]);
    }
}
