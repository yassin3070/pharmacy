<?php

use App\Http\Controllers\Api\{AddressController,
    DashboardController,
    HomeController,
    AuthController,
    OrderController,
    RateController,
    UserController,
    NotificationController,
    ChatController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Register API routes for your application. These routes are loaded
| by the RouteServiceProvider within the "api" middleware group.
|
*/

Route::group(['middleware' => ['api-cors', 'json.response', 'lang']], function () {

    // Public Routes
    Route::get('send-whatsapp', [DashboardController::class, 'sendWhatsAppMessage']);

    // Registration and Authentication

    //register
    // Route::get('user-types', [AuthController::class, 'userTypes']);
    Route::post('register', [AuthController::class, 'register']);
    // Route::post('login', [AuthController::class, 'login']);
//     Route::post('send-code', [AuthController::class, 'OtpForPhoneOrMail']);
    Route::post('send-code', [AuthController::class, 'OtpForPhone']);
    Route::post('activate-account', [AuthController::class, 'activateByGeneralCode']);
    Route::get('sms-counter', [HomeController::class, 'smsCounter']);


    // Optional Sanctum Middleware Routes
    Route::group(['middleware' => ['OptionalSanctumMiddleware']], function () {
        Route::get('user-types', [UserController::class, 'userTypes']);
        Route::get('categories', [HomeController::class, 'categories']);
        Route::get('settings', [HomeController::class, 'settings']);
        Route::get('home', [HomeController::class, 'index']);
    });

    // Authenticated Routes
    Route::group(['middleware' => ['auth:sanctum']], function () {


        //User Routes
        Route::get('category-products', [HomeController::class, 'categoryProducts']);




        /***************************** Orders Start *****************************/

        Route::get('orders', [OrderController::class, 'myOrders']);
        Route::get('get-order/{id}', [OrderController::class, 'getOrder']);
        Route::get('get-cart', [OrderController::class, 'getCart']);
        Route::post('add-to-cart', [OrderController::class, 'addToCart']);
        Route::post('remove-item', [OrderController::class, 'removeItemFromOrder']);
        Route::post('clear-cart', [OrderController::class, 'clearCart']);
        Route::post('proceed-order', [OrderController::class, 'proceedOrder']);
        Route::post('upload-item-recipe/{order_item_id}', [OrderController::class, 'uploadItemRecipe']);
        /***************************** Orders End *****************************/


        /***************************** Address Start *****************************/
        Route::get('addresses', [AddressController::class, 'index']);
        Route::get('addresses/{address}', [AddressController::class, 'show']);
        Route::post('addresses', [AddressController::class, 'store']);
        Route::put('addresses/{address}', [AddressController::class, 'update']);
        Route::delete('addresses/{address}', [AddressController::class, 'destroy']);
        /***************************** Address End *****************************/


        /***************************** Rates Start *****************************/
        Route::get('rates', [RateController::class, 'index']);
        Route::post('rates', [RateController::class, 'store']);
        /***************************** Rates End *****************************/

        // Profile Routes
        Route::post('change-lang', [UserController::class, 'changeLang']);
        Route::get('profile', [UserController::class, 'getProfile'])->name('profile');
        Route::post('update-profile', [UserController::class, 'updateProfile']);
        Route::get('toggle-notifications', [UserController::class, 'switchNotificationStatus']);
        Route::post('contact', [UserController::class, 'sendContactMessage'])->name('user.contact');

        //Auth Routes

        Route::post('update-password', [AuthController::class, 'updatePassword']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('delete-account/{id}', [UserController::class, 'deleteAccount']);


        // ChatController Routes
        Route::get('create-room', [ChatController::class, 'createRoom']);
        Route::post('create-private-room', [ChatController::class, 'createPrivateRoom']);
        Route::get('room-members/{room}', [ChatController::class, 'getRoomMembers']);
        Route::get('join-room/{room}', [ChatController::class, 'joinRoom']);
        Route::get('leave-room/{room}', [ChatController::class, 'leaveRoom']);
        Route::get('get-room-messages/{room}', [ChatController::class, 'getRoomMessages']);
        Route::get('get-room-unseen-messages/{room}', [ChatController::class, 'getRoomUnseenMessages']);
        Route::get('get-rooms', [ChatController::class, 'getMyRooms']);
        Route::post('send-message/{room}', [ChatController::class, 'sendMessage']);
        Route::post('upload-room-file/{room}', [ChatController::class, 'uploadRoomFile']);
        Route::get('getMyMessagesWith/{id}', [ChatController::class, 'getMyMessagesWith']);
        Route::post('deleteRoom/{id}', [ChatController::class, 'deleteRoom']);
        Route::delete('delete-message-copy/{message}', [ChatController::class, 'deleteMessageCopy']);


        // Notifications Routes
        Route::get('notifications', [NotificationController::class, 'getNotifications']);
        Route::get('count-notifications', [NotificationController::class, 'countUnreadNotifications']);
        Route::delete('delete-notification/{notification_id}', [NotificationController::class, 'deleteNotification']);
        Route::delete('delete-notifications', [NotificationController::class, 'deleteNotifications']);
    });
});
