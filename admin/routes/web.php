<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConfessionController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\ForumCategoryController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PaymentConntroller;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubAdminController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmailTemplateController;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



//Will take you to the login-page when you run the project
Route::get('/', function () {
    return view('auth.login');
});

//Route for logout
Route::get('/logout', [AuthController::class, 'logout']);

//Route for login
Route::middleware(['alreadyLoggedIn'])->group(function () {
    Route::get('/Nepstate-admin-login-page', [AuthController::class, 'login']);
    Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user');
});

//Routes after you login
Route::middleware(['isLoggedIn'])->group(function () {
    //Route for dashboard
    Route::get('/dashboard', [AuthController::class, 'trying']);

    Route::get('/all-reviews', [UserController::class, 'allreviews'])->name('all.reviews');
    Route::delete('/order-review/{id}/delete', [UserController::class, 'deleteReview'])->name('delete.order.review');

    
    Route::get('/all-approval', [BlogController::class, 'approval'])->name('all.approved');
    Route::get('/approve-blog/{id}', [BlogController::class, 'approveBlog'])->name('approve.blog');
    Route::get('/blog/reject/{id}', [BlogController::class, 'reject'])->name('reject.blog');

    //-----------------------Routes for dealers---------------------------------
    //Route for Dealer
    // Route::get('/users', [UserController::class, 'showUser'])->name('users.index');

    // Route to show and create user
    Route::get('/addUser', [UserController::class, 'storeUser'])->name('user.store');
    Route::get('/users', [UserController::class, 'showUser'])->name('users.user.index');
    Route::post('/users', [UserController::class, 'storeAndAuthenticate'])->name('users.storeAndAuthenticate');

    // Route to delete the user
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.user.destroy');

    // Route to edit the users
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.user.update');
    Route::get('/users/{id}', [UserController::class, 'displayUser'])->name('user.show');


    //-----------------------Routes for forum-categories---------------------------------
    //Route for Forums
    Route::get('/forum-category', [ForumCategoryController::class, 'index'])->name('forum.index');

    //Route to get and create forum
    Route::get('/forum-category/create', [ForumCategoryController::class, 'create'])->name('forum.create');
    Route::post('/forum-category', [ForumCategoryController::class, 'store'])->name('forum.store');

    //Route to show and edit fourm
    Route::get('/forum-category/{forum}/edit', [ForumCategoryController::class, 'edit'])->name('forum.edit');
    Route::put('/forum-category/{forum}', [ForumCategoryController::class, 'update'])->name('forum.update');

    //Route  to delete the forum
    Route::delete('/forum-category/{forum}', [ForumCategoryController::class, 'destroy'])->name('forum.destroy');


    //-----------------------Routes for Settings---------------------------------
    // Display settings page
    Route::get('/setting', [SettingController::class, 'index']);

    // Update settings
    Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update');
    Route::get('/rules', [SettingController::class, 'rules'])->name('rules');
    Route::get('/google-ads', [SettingController::class, 'showGoogleAds'])->name('googleAds.show');
    Route::post('/google-ads/update', [SettingController::class, 'updateGoogleAds'])->name('googleAds.update');

    //-----------------------Routes for Admin Countries---------------------------------
    // Display list of countries
    Route::get('/admin-countries', [CountryController::class, 'index'])->name('countries.index');

    // Show form to create a new country
    Route::get('/admin-countries/create', [CountryController::class, 'create'])->name('countries.create');

    // Store a new country
    Route::post('/admin-countries', [CountryController::class, 'store'])->name('countries.store');


    // Show form to edit a country
    Route::get('/admin-countries/{country}/edit', [CountryController::class, 'edit'])->name('countries.edit');

    // Update a country
    Route::put('/admin-countries/{country}', [CountryController::class, 'update'])->name('countries.update');

    // Delete a country
    Route::delete('/admin-countries/{country}', [CountryController::class, 'destroy'])->name('countries.destroy');
    Route::get('admin-countries/{country}/show-info', [CountryController::class, 'show'])->name('countries.show');
    Route::get('admin-countries/{country}/show-info/category/{slug}', [CountryController::class, 'showCategoryInfo'])->name('CategoryInfo.show');
    // Route::get('admin-countries/{country}/show-info/users/{username}',[CountryController::class,'showUsersInfo'])->name('UsersInfo.show');



    //-----------------------Routes for Category---------------------------------
    // Display list of categories
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');

    // Show category by ID
    Route::get('/category/{id}', [CategoryController::class, 'showById'])->name('category.showById');

    // Store sub-category
    Route::post('/category/store-sub-category', [CategoryController::class, 'storeSubCategory'])->name('category.storeSubCategory');

    // Edit sub-category
    Route::get('category/{id}/edit', [CategoryController::class, 'editSubCategory'])->name('category.editSubCategory');

    // Update sub-category
    Route::put('category/{id}', [CategoryController::class, 'updateSubCategory'])->name('category.updateSubCategory');

    // Delete sub-category
    Route::delete('category/{id}', [CategoryController::class, 'destroySubCategory'])->name('category.destroySubCategory');
    Route::get('/categories/{id}/MainCategoryEdit', [CategoryController::class,  'MainEdit'])->name('category.MainEditRoute');
    Route::put('/categories/{id}', [CategoryController::class, 'updateMain'])->name('category.update');


    //-----------------------Routes for Blog---------------------------------
    // Display list of blogs
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('blogs/create', [BlogController::class, 'create'])->name('blogs.create.show');
    Route::post('blogs', [BlogController::class, 'store'])->name('blogs.store');
    // Route::get('blogs/edit', [BlogController::class, 'edit'])->name('blogs.edit.show');
    Route::get('blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit.show');
    Route::put('blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    // Show a specific blog
    Route::get('/blog-view/{id}', [BlogController::class, 'show'])->name('blogs.show');

    // Delete a blog
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    // Delete a like on a blog
    Route::delete('/likes/{id}', [BlogController::class, 'destroyLike'])->name('blogs.likes.destroy');

    // Delete a comment on a blog
    Route::delete('/comments/{id}', [BlogController::class, 'destroyComment'])->name('blogs.comments.destroy');


    //---------------------------Routes for Confessions-------------------------
    // Display list of confessions
    Route::get('/type-confessions', [ConfessionController::class, 'showConfession'])->name('confessions.index');

    // Show a specific confession
    Route::get('/type-confessions/{id}', [ConfessionController::class, 'show'])->name('confessions.show');

    // Delete a confession
    Route::delete('/type-confessions/{id}', [ConfessionController::class, 'destroy'])->name('confessions.destroy');

    // Delete a like on a confession
    Route::delete('/type-confessions/likes/{id}', [ConfessionController::class, 'destroyLike'])->name('confessions.likes.destroy');

    // Delete a comment on a confession
    Route::delete('/type-confessions/comments/{id}', [ConfessionController::class, 'destroyComment'])->name('confessions.comments.destroy');


    //---------------------------Routes for Forums-------------------------
    // Display list of forums
    Route::get('/type-forums', [ForumController::class, 'showForum'])->name('typeforums.index');

    // Show a specific forum
    Route::get('/type-forums/{id}', [ForumController::class, 'show'])->name('forums.show');

    // Delete a forum
    Route::delete('/type-forums/{id}', [ForumController::class, 'destroy'])->name('forums.destroy');

    // Delete a like on a forum
    Route::delete('/type-forums/likes/{id}', [ForumController::class, 'destroyLike'])->name('forums.likes.destroy');

    // Delete a comment on a forum
    Route::delete('/type-forums/comments/{id}', [ForumController::class, 'destroyComment'])->name('forums.comments.destroy');


    //---------------------------Routes for Products-------------------------
    // Display list of products
    // In web.php
    Route::get('/show-classifer-Events', [ProductController::class, 'events'])->name('events');

    Route::get('/show-classifer-IT_Training', [ProductController::class, 'trainings'])->name('trainings');
    Route::get('/show-classifer-Jobs', [ProductController::class, 'jobs'])->name('jobs');
    Route::get('/show-classifer-Roomates&Rental', [ProductController::class, 'rentals'])->name('rentals');
    Route::get('/show-classifer-Services', [ProductController::class, 'services'])->name('services');


    Route::get('/show-classifer-Events/{id}', [ProductController::class, 'showEvent'])->name('events.show');
    Route::get('/show-classifer-IT_Training/{id}', [ProductController::class, 'showTrainings'])->name('train.show');
    Route::get('/show-classifer-Jobs/{id}', [ProductController::class, 'showJobs'])->name('job.show');
    Route::get('/show-classifer-Roomates&Rental/{id}', [ProductController::class, 'showRentals'])->name('rental.show');
    Route::get('/show-classifer-Services/{id}', [ProductController::class, 'showServices'])->name('service.show');
    Route::delete('listing/{id}', [ProductController::class, 'destroyClassified'])->name('destroy.Classified');

    //----------------------------Password reset---------------------------------------
    Route::get('/reset-password', [AuthController::class, 'password'])->name('reset_password');
    Route::put('/change-password', [AuthController::class, 'changePassword'])->name('change_password');

    //--------------------------------ADVERTISMENT--------------------------------------

    Route::get('/countryAdvertisment', [ProductController::class, 'countryAdvertisment'])->name('countryAdvertisment');

    Route::get('/countryAdvertisment/{id}/products-ads', [ProductController::class, 'productAd'])->name('product_ad');

    Route::delete('/product-ads/{id}', [ProductController::class, 'productAddelete'])->name('ad_destroy');
    Route::get('/product-ads/create', [ProductController::class, 'AdCreate'])->name('ad_create');

    Route::get('/product-ads/{id}/edit', [ProductController::class, 'edit'])->name('ad_edit');
    Route::put('/product-ads/{id}/update', [ProductController::class, 'update'])->name('ad_update');
    Route::get('/product-ads/{id}/view', [ProductController::class, 'view'])->name('ad_view');
    //    ----------------------------------------------------------------------------------------
    Route::get('/ad-create/1', [ProductController::class, 'createPage']);

    Route::get('ad-create/2', [ProductController::class, 'createAd2']);

    Route::get('ad-create/3', [ProductController::class, 'createAd3']);

    Route::get('ad-create/4', [ProductController::class, 'createAd4']);

    Route::get('ad-create/5', [ProductController::class, 'createAd5']);

    Route::get('ad-create/6', [ProductController::class, 'createAd6']);

    Route::get('ad-create/7', [ProductController::class, 'createAd7']);

    Route::get('ad-create/8', [ProductController::class, 'createAd8']);

    //--------------------------------ADVERTISMENT--------------------------------------
    Route::get('/faqs', [FAQController::class, 'index'])->name('faqs.index');
    Route::get('/faqs/create', [FAQController::class, 'create'])->name('faqs.create');
    Route::post('/faqs', [FAQController::class, 'store'])->name('faqs.store');
    Route::delete('/faqs/{faq}', [FAQController::class, 'destroy'])->name('faqs.destroy');
    Route::get('/faqs/{faq}/edit', [FAQController::class, 'edit'])->name('faqs.edit');
    Route::put('/faqs/{faq}', [FAQController::class, 'update'])->name('faqs.update');

    Route::get('/static-page', [PageController::class, 'index'])->name('static.index');
    // Route::get('/static-page/{id}/edit', [PageController::class, 'edit'])->name('edit.static');
    // Route::put('/static-page/{id}', [PageController::class, 'update'])->name('staticpage.update');

    Route::get('/static-page/{slug}/edit', [PageController::class, 'edit'])->name('edit.static');
    Route::put('/static-page/{slug}', [PageController::class, 'update'])->name('staticpage.update');

    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/create', [TestimonialController::class, 'show'])->name('testimonials.store');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.return');

    Route::get('/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Route::delete('AdSave', [TestimonialController::class, 'destroy'])->name('AdSave');
    // Route::post('/product-ads', [ProductController::class, 'ad1Store'])->name('store1');

    // ------------------------------Ads by number ---------------------------------------------
    Route::post('/ad1', [ProductController::class, 'ad1Store'])->name('save1');
    Route::post('/ad2', [ProductController::class, 'ad2Store'])->name('save2');
    Route::post('/ad3', [ProductController::class, 'ad3Store'])->name('save3');
    Route::post('/ad4', [ProductController::class, 'ad4Store'])->name('save4');
    Route::post('/ad5', [ProductController::class, 'ad5Store'])->name('save5');
    Route::post('/ad6', [ProductController::class, 'ad6Store'])->name('save6');
    Route::post('/ad7', [ProductController::class, 'ad7Store'])->name('save7');
    Route::post('/ad8', [ProductController::class, 'ad8Store'])->name('save8');


    // ------------------------------All comments---------------------------------------
    Route::get('/all-comments', [BlogController::class, 'allComments'])->name('all_comments');
    Route::delete('/all-comments/{id}', [BlogController::class, 'allCommentsDelete'])->name('delete.comment.page');

    // ------------------------------Coupons---------------------------------------
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::put('/coupons/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
    Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');

    // ------------------------------Coupons---------------------------------------
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/toggle-read', [NotificationController::class, 'toggleRead'])->name('notifications.toggleRead');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // ------------------------------Admin Profile---------------------------------------
    Route::get('/manage-profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/manage-profile-update', [AuthController::class, 'updateProfile'])->name('admin.updateProfile');

    // ------------------------------Payment Plans---------------------------------------
    Route::get('/payment-plans', [PaymentConntroller::class, 'index'])->name('payment.index');
    Route::get('/payment-plans/create', [PaymentConntroller::class, 'create'])->name('payment.create');
    Route::post('/payment-plan/store', [PaymentConntroller::class, 'store'])->name('payment.store');
    Route::get('/payment-plan/{id}/edit', [PaymentConntroller::class, 'edit'])->name('payment.edit');
    Route::put('/payment-plan/{id}/update', [PaymentConntroller::class, 'update'])->name('payment.update');
    Route::delete('/payment-plans{id}/delete', [PaymentConntroller::class, 'destroy'])->name('payment.destroy');
    Route::post('/payment-plan/{id}/move-up', [PaymentConntroller::class, 'moveUp'])->name('payment.moveUp');
    Route::post('/payment-plan/{id}/move-down', [PaymentConntroller::class, 'moveDown'])->name('payment.moveDown');
    Route::post('/payment-plans/update-order', [PaymentConntroller::class, 'updateOrder'])->name('payment.updateOrder');

    //--------------------------------------SUB_ADMINS-------------------------------------------
    Route::get('sub-admin', [SubAdminController::class, 'index'])->name('subadmin-index');
    Route::get('sub-admin/create', [SubAdminController::class, 'create'])->name('subadmin-create');
    Route::post('sub-admin/store', [SubAdminController::class, 'store'])->name('subadmin-store');
    Route::get('sub-admin/{subAdmin}/edit', [SubAdminController::class, 'edit'])->name('subadmin-edit');
    Route::put('sub-admin/{subAdmin}/update', [SubAdminController::class, 'update'])->name('subadmin-update');
    Route::get('sub-admin-delete/{id}', [SubAdminController::class, 'destroy']);



    Route::get('email-templates', [EmailTemplateController::class, 'show'])->name('emailTemplateShow');
    Route::post('email-templates/update', [EmailTemplateController::class, 'update'])->name('emailTemplateUpdate');
});

//404 error page not found error
Route::fallback(
    function () {
        return view('pagenotfound');
    }
);
