<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\{BannerResource,
    CategoryResource,
    CityWithMultimediaResource,
    ConsultantResource,
    InitialPageResource,
    NewsResource,
    PartnerResource,
    ProductResource,
    ServiceResource,
    SocialPageResource,
    UserResource};
use App\Models\{Category, City, Contact, InitialPage, News, Product, Setting, Social, User};
use App\Repositories\{
    IBannerRepository,
    ICategoryRepository,
    IUserRepository
};
use App\Requests\Api\{
    ContactRequest,
    Orders\searchProviderRequest
};
use App\Traits\{
    ApiResponseTrait,
    UploadTrait,
    PaginationTrait
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    App,
    Auth,
    Log
};


class HomeController extends Controller
{
    use ApiResponseTrait, UploadTrait, PaginationTrait;

    protected $Ibanner;
    protected $Icategory;
    protected $Iuser;
    protected $data;

    public function __construct(
        IBannerRepository $Ibanner,
        ICategoryRepository $Icategory,
        IUserRepository $Iuser
    ) {
        $this->Ibanner = $Ibanner;
        $this->Icategory = $Icategory;
        $this->Iuser = $Iuser;
        $this->data = [];
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        $orderBy = ['column' => 'id', 'dir' => 'DESC'];

        $this->data['banners']               = BannerResource::collection($this->Ibanner->getAllActive());
        $this->data['notifications_count']   = auth()->user()?->unreadNotifications?->count() ?? 0;
        $this->data['categories']            = CategoryResource::collection(Category::whereNull('parent_id')->get());
        return $this->ApiResponse($this->data, __('apis.fetched'), 200);
    }

    public function settings()
    {
        $this->data = [
            'onboarding' => InitialPageResource::collection(InitialPage::orderBy('order', 'ASC')->get()),
            'about' => Setting::getLocaleValue('about'),
            'policy' => Setting::getLocaleValue('policy'),
            'terms' => Setting::getLocaleValue('terms'),
            'vision' => Setting::getLocaleValue('vision'),
            'mission' => Setting::getLocaleValue('mission'),
            'whyus' => Setting::getLocaleValue('whyus'),
            'profile' =>  Setting::getAsset('portfolio'),
            'android_version' => Setting::getValue('android_version'),
            'ios_version' => Setting::getValue('ios_version'),
            'android_link' => Setting::getValue('android_link'),
            'ios_link' => Setting::getValue('ios_link'),
            'instagram' => Setting::getValue('instagram'),
            'facebook' => Setting::getValue('facebook'),
            'youtube' => Setting::getValue('youtube'),
            'snapchat' => Setting::getValue('snapchat'),
            'whatsapp' => Setting::getValue('whatsapp'),
            'email' => Setting::getValue('email'),
            'phone' => Setting::getValue('phone'),
           // 'socials' => SocialPageResource::collection(Social::active()->get())
        ];

        return $this->ApiResponse($this->data, __('apis.fetched'), 200);
    }

    public function sendContact(ContactRequest $request)
    {
        Contact::create($request->validated() + ['user_id' => auth()->id()]);

        return $this->ApiResponse(null, __('apis.contact_message_sent'), 200);
    }

    public function categories(Request $request)
    {
        try {
//            ['per_page' => $perPage, 'page' => $page] = $this->getPaginationParams($request);
            if($request->type == 'parent'){
                $data = Category::whereNull('parent_id')->get();
            }else{
                $data = Category::whereNotNull('parent_id')->get();
            }
            return $this->ApiResponse(CategoryResource::collection($data), __('apis.fetched'), 200);

        } catch (Exception $e) {
            Log::error('Failed to fetch categories', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    public function categoryProducts(Request $request)
    {
        $filters = [
            'category' => $request->input('category'),
            'rating' => $request->input('rating'),
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),
        ];

        $products = Product::query()
            ->filterByOptions($filters)
            ->orderByOption($request->sort_option)
            ->get();
        return $this->ApiResponse(ProductResource::collection($products), __('apis.fetched'), 200);

    }

    public function banners()
    {
        $data = BannerResource::collection($this->Ibanner->getAllActive());
        return $this->ApiResponse($data, __('apis.fetched'), 200);
    }


}
