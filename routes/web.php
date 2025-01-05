<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [HomeController::class, 'welcomePage'])->name('welcome');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');

// Auth::routes();
Route::group(['middleware' => ['web']] , function () {

    Route::get('login', [LoginController::class, 'showloginform'])->name('show.login');
    Route::post('admin-login', [LoginController::class, 'login'])->name('admin-login');

    Route::get('sms-counter', [HomeController::class, 'smsCounter'])->name('sms-counter');
});

Route::group(['middleware' => ['auth',  'admin-lang' , 'web' , 'check-role'] , 'namespace' => 'Dashboard'], function () {
    Route::get('chat', [LoginController::class, 'chat'])->name('chat');
    Route::get('conversation/{room_id}', [LoginController::class, 'conversation'])->name('conversation');
    Route::post('send-message',[LoginController::class, 'sendMessage'])->name('sendmessage');


    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('edit-profile', [AdminController::class, 'editProfile'])->name('edit-profile');
    Route::put('update-profile', [AdminController::class, 'updateProfile'])->name('update-profile');
    Route::get('home', [
        'uses'      => 'HomeController@index',
        'as'        => 'home',
        'title'     => 'dashboard.home',
        'type'      => 'parent'
    ]);
/*------------ start Of roles ----------*/
    Route::get('roles', [
        'uses'      => 'RoleController@index',
        'as'        => 'roles.index',
        'title'     => 'dashboard.roles',
        'type'      => 'parent',
        'child'     => [ 'roles.create','roles.edit',  'roles.destroy'  ,'roles.deleteAll']
    ]);

    # roles store
    Route::get('roles/create', [
        'uses'  => 'RoleController@create',
        'as'    => 'roles.create',
        'type'      => 'child',
        'title' => ['actions.add', 'dashboard.role']
    ]);

    # roles store
    Route::post('roles/store', [
        'uses'  => 'RoleController@store',
        'as'    => 'roles.store',
        'type'      => 'child',
        'title' => ['actions.add', 'dashboard.role']
    ]);

    # roles update
    Route::get('roles/{id}/edit', [
        'uses'  => 'RoleController@edit',
        'as'    => 'roles.edit',
        'type'      => 'child',
        'title' => ['actions.edit', 'dashboard.role']
    ]);

    # roles update
    Route::put('roles/{id}', [
        'uses'  => 'RoleController@update',
        'as'    => 'roles.update',
        'type'      => 'child',
        'title' => ['actions.edit', 'dashboard.role']
    ]);

    # roles delete
    Route::delete('roles/{id}', [
        'uses'  => 'RoleController@destroy',
        'as'    => 'roles.destroy',
        'type'      => 'child',
        'title' => ['actions.delete', 'dashboard.role']
    ]);
    #delete all roles
    Route::post('delete-all-roles', [
        'uses'  => 'RoleController@deleteAll',
        'as'    => 'roles.deleteAll',
        'title' => ['actions.delete_all', 'dashboard.roles']
    ]);
/*------------ end Of roles ----------*/

/*------------ start Of users ----------*/
    Route::get('users', [
        'uses'      => 'UserController@index',
        'as'        => 'users.index',
        'title'     => 'dashboard.users',
        'type'      => 'parent',
        'child'     => [ 'users.create','users.edit', 'users.destroy'  ,'users.deleteAll' , 'user-attachemts']
    ]);

    # users store
    Route::get('users/create', [
        'uses'  => 'UserController@create',
        'as'    => 'users.create',
        'title' => ['actions.add', 'dashboard.user']
    ]);

    # users store
    Route::post('users/store', [
        'uses'  => 'UserController@store',
        'as'    => 'users.store',
        'title' => ['actions.add', 'dashboard.user']
    ]);

    # users update
    Route::get('users/{id}/edit', [
        'uses'  => 'UserController@edit',
        'as'    => 'users.edit',
        'title' => ['actions.edit', 'dashboard.user']
    ]);

    # users update
    Route::put('users/{id}', [
        'uses'  => 'UserController@update',
        'as'    => 'users.update',
        'title' => ['actions.edit', 'dashboard.user']
    ]);

    # users delete
    Route::delete('users/{id}', [
        'uses'  => 'UserController@destroy',
        'as'    => 'users.destroy',
        'title' => ['actions.delete', 'dashboard.user']
    ]);
    #delete all users
    Route::post('delete-all-users', [
        'uses'  => 'UserController@deleteAll',
        'as'    => 'users.deleteAll',
        'title' => ['actions.delete_all', 'dashboard.users']
    ]);
    Route::get('user-attachemts/{userId}',
    [
        'uses'  => 'UserController@userAttachemts',
        'as'    => 'user-attachemts',
        'title' => ['actions.show', 'dashboard.user_attachments']
    ]);
/*------------ end Of users ----------*/





/*------------ start Of admins ----------*/
    Route::get('admins', [
        'uses'      => 'AdminController@index',
        'as'        => 'admins.index',
        'title'     => 'dashboard.admins',
        'type'      => 'parent',
        'child'     => [ 'admins.create','admins.edit', 'admins.destroy'  ,'admins.deleteAll' , 'activations-status' ,'admin-permission']
    ]);

    # admins store
    Route::get('admins/create', [
        'uses'  => 'AdminController@create',
        'as'    => 'admins.create',
        'title' => ['actions.add', 'dashboard.admin']
    ]);

    # admins store
    Route::post('admins/store', [
        'uses'  => 'AdminController@store',
        'as'    => 'admins.store',
        'title' => ['actions.add', 'dashboard.admin']
    ]);

    # admins update
    Route::get('admins/{id}/edit', [
        'uses'  => 'AdminController@edit',
        'as'    => 'admins.edit',
        'title' => ['actions.edit', 'dashboard.admin']
    ]);

    # admins update
    Route::put('admins/{id}', [
        'uses'  => 'AdminController@update',
        'as'    => 'admins.update',
        'title' => ['actions.edit','dashboard.admin']
    ]);

    # admins delete
    Route::delete('admins/{id}', [
        'uses'  => 'AdminController@destroy',
        'as'    => 'admins.destroy',
        'title' => ['actions.delete', 'dashboard.admin']
    ]);
    #delete all admins
    Route::post('delete-all-admins', [
        'uses'  => 'AdminController@deleteAll',
        'as'    => 'admins.deleteAll',
        'title' => ['actions.delete_all', 'dashboard.admins']
    ]);

    Route::get('admin-permissions/{admin_id}', [
        'uses'  => 'AdminController@adminPermissions',
        'as'    => 'admin-permission',
        'title' => ['actions.show', 'dashboard.permissions']
    ]);
    Route::post('activations-status/{admin_id}', [
        'uses'  => 'AdminController@activationStatus',
        'as'    => 'activations-status',
        'title' => ['actions.change', 'dashboard.account_status']
    ]);

/*------------ end Of admins ----------*/




/*------------ start Of categories ----------*/
    Route::get('categories', [
        'uses'      => 'CategoryController@index',
        'as'        => 'categories.index',
        'title'     => 'dashboard.categories',
        'type'      => 'parent',
        'child'     => [ 'categories.create','categories.edit', 'categories.destroy'  ,'categories.deleteAll']
    ]);

    # categories store
    Route::get('categories/create', [
        'uses'  => 'CategoryController@create',
        'as'    => 'categories.create',
        'title' => ['actions.add', 'dashboard.category']
    ]);

    # categories store
    Route::post('categories/store', [
        'uses'  => 'CategoryController@store',
        'as'    => 'categories.store',
        'title' => ['actions.add', 'dashboard.category']
    ]);

    # categories update
    Route::get('categories/{id}/edit', [
        'uses'  => 'CategoryController@edit',
        'as'    => 'categories.edit',
        'title' => ['actions.edit', 'dashboard.category']
    ]);

    # categories update
    Route::put('categories/{id}', [
        'uses'  => 'CategoryController@update',
        'as'    => 'categories.update',
        'title' => ['actions.edit', 'dashboard.category']
    ]);

    # categories delete
    Route::delete('categories/{id}', [
        'uses'  => 'CategoryController@destroy',
        'as'    => 'categories.destroy',
        'title' => ['actions.delete', 'dashboard.category']
    ]);
    #delete all categories
    Route::post('delete-all-categories', [
        'uses'  => 'CategoryController@deleteAll',
        'as'    => 'categories.deleteAll',
        'title' => ['actions.delete_all', 'dashboard.categories']
    ]);
/*------------ end Of categories ----------*/




/*------------ start Of banners ----------*/
    Route::get('banners', [
        'uses'      => 'BannerController@index',
        'as'        => 'banners.index',
        'title'     => 'dashboard.banners',
        'type'      => 'parent',
        'child'     => [ 'banners.create','banners.edit', 'banners.destroy'  ,'banners.deleteAll']
    ]);

    # banners store
    Route::get('banners/create', [
        'uses'  => 'BannerController@create',
        'as'    => 'banners.create',
        'title' => ['actions.add', 'dashboard.banner']
    ]);

    # banners store
    Route::post('banners/store', [
        'uses'  => 'BannerController@store',
        'as'    => 'banners.store',
        'title' => ['actions.add', 'dashboard.banner']
    ]);

    # banners update
    Route::get('banners/{id}/edit', [
        'uses'  => 'BannerController@edit',
        'as'    => 'banners.edit',
        'title' => ['actions.edit', 'dashboard.banner']
    ]);

    # banners update
    Route::put('banners/{id}', [
        'uses'  => 'BannerController@update',
        'as'    => 'banners.update',
        'title' => ['actions.edit', 'dashboard.banner']
    ]);

    # banners delete
    Route::delete('banners/{id}', [
        'uses'  => 'BannerController@destroy',
        'as'    => 'banners.destroy',
        'title' => ['actions.delete', 'dashboard.banner']
    ]);
    #delete all banners
    Route::post('delete-all-banners', [
        'uses'  => 'BannerController@deleteAll',
        'as'    => 'banners.deleteAll',
        'title' => ['actions.delete_all', 'dashboard.banners']
    ]);
/*------------ end Of banners ----------*/


/*------------ start Of initial-pages ----------*/
    Route::get('initial-pages', [
        'uses'      => 'InitialPageController@index',
        'as'        => 'initial-pages.index',
        'title'     => 'dashboard.initial_pages',
        'type'      => 'parent',
        'child'     => [ 'initial-pages.create','initial-pages.edit', 'initial-pages.destroy'  ,'initial-pages.deleteAll']
    ]);

    # initial-pages store
    Route::get('initial-pages/create', [
        'uses'  => 'InitialPageController@create',
        'as'    => 'initial-pages.create',
        'title' => ['actions.add', 'dashboard.initial_page']
    ]);

    # initial-pages store
    Route::post('initial-pages/store', [
        'uses'  => 'InitialPageController@store',
        'as'    => 'initial-pages.store',
        'title' => ['actions.add', 'dashboard.initial_page']
    ]);

    # initial-pages update
    Route::get('initial-pages/{id}/edit', [
        'uses'  => 'InitialPageController@edit',
        'as'    => 'initial-pages.edit',
        'title' => ['actions.edit', 'dashboard.initial_page']
    ]);

    # initial-pages update
    Route::put('initial-pages/{id}', [
        'uses'  => 'InitialPageController@update',
        'as'    => 'initial-pages.update',
        'title' => ['actions.edit', 'dashboard.initial_page']
    ]);

    # initial-pages delete
    Route::delete('initial-pages/{id}', [
        'uses'  => 'InitialPageController@destroy',
        'as'    => 'initial-pages.destroy',
        'title' => ['actions.delete', 'dashboard.initial_page']
    ]);
    #delete all initial-pages
    Route::post('delete-all-initial-pages', [
        'uses'  => 'InitialPageController@deleteAll',
        'as'    => 'initial-pages.deleteAll',
        'title' => ['actions.delete_all', 'dashboard.initial_pages']
    ]);
/*------------ end Of initial-pages ----------*/



/*------------ start Of orders ----------*/
    Route::get('orders', [
        'uses'      => 'OrderController@index',
        'as'        => 'orders.index',
        'title'     => 'dashboard.orders',
        'type'      => 'parent',
        'child'     => [ 'orders.create','orders.edit','user-orders', 'orders.destroy'  ,'orders.deleteAll']
    ]);

    # orders store
    Route::get('orders/create', [
        'uses'  => 'OrderController@create',
        'as'    => 'orders.create',
        'title' => ['actions.add', 'dashboard.user_order']
    ]);

    # orders store
    Route::post('orders/store', [
        'uses'  => 'OrderController@store',
        'as'    => 'orders.store',
        'title' => ['actions.add', 'dashboard.user_order']
    ]);

    # orders update
    Route::get('orders/{id}/edit', [
        'uses'  => 'OrderController@edit',
        'as'    => 'orders.edit',
        'title' => ['actions.edit', 'dashboard.user_order']
    ]);

    # orders update
    Route::put('orders/{id}', [
        'uses'  => 'OrderController@update',
        'as'    => 'orders.update',
        'title' => ['actions.edit', 'dashboard.user_order']
    ]);

    # orders delete
    Route::delete('orders/{id}', [
        'uses'  => 'OrderController@destroy',
        'as'    => 'orders.destroy',
        'title' => ['actions.delete', 'dashboard.user_order']
    ]);
    #delete all orders
    Route::post('delete-all-orders', [
        'uses'  => 'OrderController@deleteAll',
        'as'    => 'orders.deleteAll',
        'title' => ['actions.delete_all', 'dashboard.orders']
    ]);

    Route::get('user-orders/{user_id}', [
        'uses'  => 'OrderController@userOrders',
        'as'    => 'user-orders',
        'title' => ['actions.show', 'dashboard.user_orders']
    ]);
    Route::get('orders-by-status/{status}', [
        'uses'  => 'OrderController@ordersByStatus',
        'as'    => 'orders.orders-by-status',
        'title' =>  ['actions.show', 'dashboard.user_orders_by_status']
    ]);
/*------------ end Of orders ----------*/



/*------------ start Of Settings----------*/
    Route::get('settings', [
        'uses'      => 'SettingController@index',
        'as'        => 'settings',
        'title'     => 'dashboard.settings',
        'type'      => 'parent',
        'child'     => [
            'update-settings','sms-update' ,
        ]
    ]);

    #update
    Route::post('settings', [
        'uses' => 'SettingController@update',
        'as' => 'update-settings',
        'title' =>  ['actions.edit', 'dashboard.settings']
    ]);

    #message all
    Route::post('settings/{type}/message-all', [
        'uses'  => 'SettingController@messageAll',
        'as'    => 'settings.message.all',
        'title' => ['actions.send', 'dashboard.all_users']
    ])->where('type','email|sms|notification');

    #message one
    Route::post('settings/{type}/message-one', [
        'uses'  => 'SettingController@messageOne',
        'as'    => 'settings.message.one',
        'title' => ['actions.send', 'dashboard.user']
    ])->where('type','email|sms|notification');

    #send email
    Route::post('settings/send-email', [
        'uses'  => 'SettingController@sendEmail',
        'as'    => 'settings.send_email',
        'title' =>  ['actions.send_email', 'dashboard.user']

    ]);

    Route::post('sms-update',[
        'uses'  => 'SettingController@updateSms',
        'as'    => 'sms-update',
        'title' => ['actions.edit', 'dashboard.sms_providers']
    ]);

    Route::get('set-lang/{lang}', [
        'uses'  => 'SettingController@SetLanguage',
        'as'    => 'set-lang',
        'title' => 'dashboard.set_lang'
    ]);

/*------------ end Of Settings ----------*/

/*------------ start Of contacts ----------*/
    Route::get('contacts', [
        'uses'      => 'ContactController@index',
        'as'        => 'contacts.index',
        'title'     => 'contacts',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => ['contacts.show','contacts.replay', 'contacts.destroy'  ,'contacts.deleteAll']
    ]);

    # contacts store
    Route::post('contacts/replay', [
        'uses'  => 'ContactController@replay',
        'as'    => 'contacts.replay',
        'title' => ['actions.replay', 'dashboard.contact']

    ]);

    # contacts show
    Route::get('contacts/{id}/Show', [
        'uses'  => 'ContactController@show',
        'as'    => 'contacts.show',
        'title' => ['actions.show','dashboard.contact']
    ]);

    # contacts delete
    Route::delete('contacts/{id}', [
        'uses'  => 'ContactController@destroy',
        'as'    => 'contacts.destroy',
        'title' => ['actions.delete', 'dashboard.contact']
    ]);
    #delete all contacts
    Route::post('delete-all-contacts', [
        'uses'  => 'ContactController@deleteAll',
        'as'    => 'contacts.deleteAll',
        'title' => ['actions.delete_all', 'dashboard.contacts']
    ]);
/*------------ end Of contacts ----------*/


/*------------ start Of notifications ----------*/
    Route::get('notifications', [
        'uses'      => 'NotificationController@index',
        'as'        => 'notifications.index',
        'title'     => 'dashboard.notifications',
        'type'      => 'parent',
        'child'     => ['notifications.store', 'notifications.destroy'  ,'notifications.deleteAll']
    ]);

    # notifications store
    Route::get('notifications/create', [
        'uses'  => 'NotificationController@create',
        'as'    => 'notifications.create',
        'title' => ['actions.add', 'dashboard.notification']
    ]);

    # notifications store
    Route::post('notifications/store', [
        'uses'  => 'NotificationController@store',
        'as'    => 'notifications.store',
        'title' => ['actions.add', 'dashboard.notification']
    ]);


    # notifications delete
    Route::delete('notifications/{id}', [
        'uses'  => 'NotificationController@destroy',
        'as'    => 'notifications.destroy',
        'title' => ['actions.delete', 'dashboard.notification']
    ]);
    #delete all notifications
    Route::post('delete-all-notifications', [
        'uses'  => 'NotificationController@deleteAll',
        'as'    => 'notifications.deleteAll',
        'title' => ['actions.delete_all', 'dashboard.notifications']
    ]);

    Route::post('send-notification', [

        'uses'  => 'NotificationController@sendNotification',
        'as'    => 'send-notification',
        'title' => 'dashboard.send_notification'
    ]);

    Route::post('storeToken', [
        'uses'  => 'NotificationController@storeToken',
        'as'    => 'notifications.storeToken',
        'title' => 'dashboard.store_token'
    ]);
    Route::post('notify', [
            'uses'  => 'NotificationController@notify',
            'as'    => 'notify',
            'title' => 'dashboard.send_one_notification'
        ]);

/*------------ end Of notifications ----------*/




 /*------------ start Of socials ----------*/
 Route::get('socials', [
    'uses'      => 'SocialController@index',
    'as'        => 'socials.index',
    'title'     => 'dashboard.socials',
    'type'      => 'parent',
    'sub_route' => false,
    'child'     => ['socials.create','socials.edit', 'socials.show', 'socials.destroy'  ,'socials.deleteAll' ,]
]);

# socials store
Route::get('socials/create', [
    'uses'  => 'SocialController@create',
    'as'    => 'socials.create',
    'title' => ['actions.add', 'dashboard.social']
]);


# socials store
Route::post('socials/store', [
    'uses'  => 'SocialController@store',
    'as'    => 'socials.store',
    'title' => ['actions.add', 'dashboard.social']

]);

# socials update
Route::get('socials/{id}/edit', [
    'uses'  => 'SocialController@edit',
    'as'    => 'socials.edit',
    'title' => ['actions.edit','dashboard.social']
]);

# socials update
Route::put('socials/{id}', [
    'uses'  => 'SocialController@update',
    'as'    => 'socials.update',
    'title' => ['actions.edit', 'dashboard.social']
]);

# socials show
Route::get('socials/{id}/Show', [
    'uses'  => 'SocialController@show',
    'as'    => 'socials.show',
    'title' => ['actions.show','dashboard.social']
]);

# socials delete
Route::delete('socials/{id}', [
    'uses'  => 'SocialController@destroy',
    'as'    => 'socials.destroy',
    'title' => ['actions.delete', 'dashboard.social']
]);
#delete all socials
Route::post('delete-all-socials', [
    'uses'  => 'SocialController@deleteAll',
    'as'    => 'socials.deleteAll',
    'title' => ['actions.delete_all', 'dashboard.socials']
]);
/*------------ end Of socials ----------*/

/*------------ Never remove this line ----------*/




    
    /*------------ start Of products ----------*/
        Route::get('products', [
            'uses'      => 'ProductController@index',
            'as'        => 'products.index',
            'title'     => 'dashboard.products',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['products.create', 'products.edit', 'products.show', 'products.destroy'  ,'products.deleteAll' ,]
        ]);

        # products store
        Route::get('products/create', [
            'uses'  => 'ProductController@create',
            'as'    => 'products.create',
            'title' => ['actions.add', 'dashboard.product']
        ]);


        # products store
        Route::post('products/store', [
            'uses'  => 'ProductController@store',
            'as'    => 'products.store',
            'title' => ['actions.add', 'dashboard.product']

        ]);

        # products update
        Route::get('products/{id}/edit', [
            'uses'  => 'ProductController@edit',
            'as'    => 'products.edit',
            'title' => ['actions.edit','dashboard.product']
        ]);

        # products update
        Route::put('products/{id}', [
            'uses'  => 'ProductController@update',
            'as'    => 'products.update',
            'title' => ['actions.edit', 'dashboard.product']
        ]);

        # products show
        Route::get('products/{id}/Show', [
            'uses'  => 'ProductController@show',
            'as'    => 'products.show',
            'title' => ['actions.show','dashboard.product']
        ]);

        # products delete
        Route::delete('products/{id}', [
            'uses'  => 'ProductController@destroy',
            'as'    => 'products.destroy',
            'title' => ['actions.delete', 'dashboard.product']
        ]);
        #delete all products
        Route::post('delete-all-products', [
            'uses'  => 'ProductController@deleteAll',
            'as'    => 'products.deleteAll',
            'title' => ['actions.delete_all', 'dashboard.products']
        ]);
    /*------------ end Of products ----------*/
    #new_routes_here
                     




});
