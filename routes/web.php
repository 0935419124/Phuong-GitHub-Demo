<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CateItemController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiscountsCodeController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ContactsController;




Route::prefix('/')->group(function () {
    Route::get('/',[ClientController::class,'index'] )->name('index');
    Route::get('/category/{id}',[ClientController::class,'getProByCate'])->name('getProByCate');
    Route::get('/cateitem/{id}',[ClientController::class,'getProByCateItem'])->name('getProByCateItem');
    Route::post('/getcateitem',[ClientController::class,'getCateItemByCate'])->name('getCateItemByCate');
    Route::get('product/{id}',[ClientController::class,'getProById'])->name('getProById');
    Route::post('/getVarItemByid',[ClientController::class,'getVarItemByid'])->name('getVarItemByid');
    Route::get('wishlist', [ClientController::class,'wishlist'])->name('listWish');
    Route::get('/add/{id}', [ClientController::class,'add'])->name('addWish');
    Route::get('deleteWish/{id}', [ClientController::class,'delete'])->name('deleteWish');
    Route::get('wishcount', [ClientController::class,'showcount'])->name('wishlistcount');
    Route::get('contact',[ClientController::class,'contact'] )->name('contacts');
    Route::post('/addcontact',[ClientController::class,'addcontact'] )->name('addcontact');
    Route::get('/showContact/{id}',[ClientController::class,'showContact'])->name('showContact');
    Route::post('editContact',[ClientController::class,'editContact'])->name('editContact');
    Route::get('deletecontact/{id}', [ClientController::class,'deletecontact'])->name('deletecontact');

    Route::get('signup',[ClientController::class,'signup'] )->name('signup');
    

    Route::post('/loginclient',[ClientController::class,'loginClient'])->name('loginClient');
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->middleware('guest')->name('password.request');
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);
     
        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');
    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');
    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    })->middleware('guest')->name('password.update');
    Route::get('forgotpassword',[ClientController::class,'forgotpassword'] )->name('forgotpassword');
    Route::get('/manager',[ClientController::class,'manager'] )->name('manager');
    Route::get('edit_profile',[UserController::class,'edit_profile'] )->name('edit_profile');
    Route::post('updateAccount',[UserController::class,'updateAccount'] )->name('updateAccount');
    Route::get('/useraddress',[ClientController::class,'useraddress'] )->name('useraddress');
    Route::post('/addAddress',[ClientController::class,'addAddress'] )->name('addAddress');
    Route::get('/editaddress/{id}',[ClientController::class,'geteditAddress'] )->name('geteditAddress');
    Route::post('/editaddress',[ClientController::class,'editAddress'] )->name('editAddress');
    Route::get('deleteAddress/{id}', [ClientController::class,'deleteAddress'])->name('deleteAddress');

    Route::get('/search',[ClientController::class,'search'] )->name('search');
    Route::post('/product/comment/{id}',[ClientController::class,'store'])->name('store');

    Route::get('/checkout', function () {
        return view('client/checkout');
    });
    
    Route::get('/dk', function () {
        return view('client/pages/register');
    });

    Route::prefix('cart')->group(function () {
        Route::get('/index', [ClientController::class,'viewCart'] )->name('viewCart');
        Route::post('/addCart',[ClientController::class,'addCart'])->name('addCart');
        Route::get('/deleteItemCart/{name}',[ClientController::class,'deleteItemCart'])->name('deleteItemCart');
        Route::post('/getAddressById',[ClientController::class,'getAddressById'])->name('getAddressById');
        Route::post('/updateCart',[ClientController::class,'updatCart'])->name('updateCart');
    });

    Route::post('/paymentPage',[ClientController::class,'paymentPage'])->name('paymentPage');
    Route::post('/insertOrder',[ClientController::class,'insertOrder'])->name('insertOrder');
    Route::get('/orders',[ClientController::class,'orders'])->name('myOrders');
    Route::get('/orderdetails/{id}',[ClientController::class,'orderdetails'])->name('myOrderDetails');
    Route::get('/cancelOrders/{id}',[ClientController::class,'cancelOrders'])->name('cancelOrders');

    Route::post('/discountCode',[ClientController::class,'discountCode'])->name('discountCode');
});


// Admin Login
Route::post('adminLogin', [UserController::class,'adminLogin'])->name('adminLogin');
Route::get('adminlogin', function () {
        return view('admin.pages.login');
    });

Route::get('cateItems',[ProductController::class,'loadCateItem'])->name('CateItems');
// admin
Route::prefix('admin')->middleware('checkAdmin')->group(function () {
        Route::get('index',[AdminController::class,'index'])->name('indexAdmin');
    Route::prefix('products')->group(function () {
        Route::get('index',[ProductController::class,'index'])->name('listPro');

        Route::get('/index5',[ProductController::class,'index5'] )->name('search5');
        Route::get('/index6',[ProductController::class,'index6'] )->name('search6');
        Route::get('/index7',[ProductController::class,'index7'] )->name('search7');

        Route::get('create',[ProductController::class,'createView'])->name('loadCreatePro');
        Route::post('cateItems',[ProductController::class,'loadCateItem'])->name('loadCateItems');
        Route::post('create',[ProductController::class,'create'])->name('createPro');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('deletePro');
        Route::get('edit/{id}',[ProductController::class,'loadEdit'])->name('loadEditPro');
        Route::post('edit',[ProductController::class,'edit'])->name('editPro');
        Route::get('variants/{id}',[ProductController::class,'showVariants'])->name('showVariants');
        Route::post('variant',[ProductController::class,'createVariant'])->name('createVariant');

        Route::post('createColor',[ProductController::class,'createColor'])->name('createColor');
        Route::get('deleteColor/{id}',[ProductController::class,'deleteColor'])->name('deleteColor');

        Route::post('createMemory',[ProductController::class,'createMemory'])->name('createMemory');
        Route::get('deleteMemory/{id}',[ProductController::class,'deleteMemory'])->name('deleteMemory');
    }); 
    Route::prefix('categories')->group(function () {
        Route::get('index', [CategoryController::class,'index'])->name('listCate');
        Route::post('create',[CategoryController::class,'create'])->name('createCate');
        Route::get('edit/{id}',[CategoryController::class,'loadEdit'])->name('loadEditCate');
        Route::post('edit', [CategoryController::class,'edit'])->name('editCate');
        Route::get('delete/{id}', [CategoryController::class,'delete'])->name('deleteCate');
    });
    Route::prefix('cateitems')->group(function () {
        Route::get('index/{id}',[CateItemController::class,'index'])->name('getCateItems');
        Route::post('create', [CateItemController::class,'create'])->name('createCateItem');
        Route::get('delete/{id}', [CateItemController::class,'delete'])->name('deleteCateItem');
        Route::get('edit/{id}',[CateItemController::class,'loadEdit'])->name('loadEditCateItem');
        Route::post('edit', [CateItemController::class,'edit'])->name('editCateItem');
    });
    Route::prefix('comments')->group(function () {
        Route::get('index',[CommentController::class,'index'])->name('listCom');
        Route::get('delete/{id}',[CommentController::class,'destroy'])->name('deleteCom');
        Route::get('/index1',[CommentController::class,'index1'] )->name('search1');
        Route::get('/index2',[CommentController::class,'index2'] )->name('search2');
        Route::get('/index3',[CommentController::class,'index3'] )->name('search3');

    }); 
    Route::prefix('contacts')->group(function () {
        Route::get('index',[ContactsController::class,'index'])->name('contact');
        Route::get('searchContact',[ContactsController::class,'searchContact'])->name('searchContact');
    });
    Route::prefix('users')->group(function () {
        Route::get('index',[UserController::class,'index'])->name('listUser');
        Route::get('index5',[UserController::class,'index5'])->name('listUserAd');
        Route::get('show/{id}',[UserController::class,'show'])->name('showUser');
        Route::post('update',[UserController::class,'update'])->name('updateUser');
        Route::get('block/{id}',[UserController::class,'block'])->name('blockUser');
        Route::get('delete/{id}',[UserController::class,'destroy'])->name('deleteUser');
        Route::get('/index4',[UserController::class,'index4'] )->name('search4');
        Route::get('/index6',[UserController::class,'index6'] )->name('search8');

    });
    Route::prefix('discounts')->group(function () {
        Route::get('index',[DiscountsCodeController::class,'index'])->name('listDiscount');
        Route::get('show',[DiscountsCodeController::class,'show'])->name('loadDiscount_code');
        Route::post('store',[DiscountsCodeController::class,'store'])->name('storeDiscount_code');
        Route::get('showid/{id}',[DiscountsCodeController::class,'showid'])->name('loadUpdateDiscount_code');
        Route::post('update', [DiscountsCodeController::class,'update'])->name('updateDiscount_code');
        Route::get('delete/{id}',[DiscountsCodeController::class,'destroy'])->name('deleteDiscount_code');

    });
    Route::prefix('slider')->group(function () {
        Route::get('index', [SLideController::class,'index'])->name('listSlide');
        Route::get('create', [SLideController::class,'loadCreate'])->name('loadCreateSlide');
        Route::post('create',[SLideController::class,'create'])->name('createSlide');
        Route::get('edit/{id}',[SLideController::class,'loadEdit'])->name('loadEditSlide');
        Route::post('edit', [SLideController::class,'edit'])->name('editSlide');
        Route::get('delete/{id}', [SLideController::class,'delete'])->name('deleteSlide');
        Route::get('unactive/{id}', [SLideController::class,'unactive'])->name('off');
        Route::get('active/{id}', [SLideController::class,'active'])->name('on');
    });
    Route::prefix('order')->group(function () {
        Route::get('index', [OrderController::class,'index'])->name('orders');
        Route::get('detail/{id}', [OrderController::class,'detail'])->name('orderDetail');
        Route::get('edit/{id}', [OrderController::class,'edit'])->name('edit');
        Route::get('delete/{id}', [OrderController::class,'delete'])->name('orderDelete');
        Route::post('/update', [OrderController::class,'update'])->name('orderUpdate');
        Route::post('/orderByStatus', [OrderController::class,'orderByStatus'])->name('orderByStatus');
    });
    Route::prefix('delivery')->group(function () {
        Route::get('index', [DeliveryController::class,'index'])->name('ListDelivery');
        Route::get('create', [DeliveryController::class,'CreateDelivery'])->name('CreateDelivery');
        Route::post('create_', [DeliveryController::class,'CreateDelivery_'])->name('CreateDelivery_');
        Route::get('edit/{id}', [DeliveryController::class,'getedit'])->name('EditDelivery');
        Route::post('edit', [DeliveryController::class,'edit'])->name('EditDelivery_');
        Route::get('delete/{id}',[DeliveryController::class,'DeleteDelivery'])->name('DeleteDelivery');
    });

});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
