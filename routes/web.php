<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\admin', 'middleware' => 'HtmlMinifier'], function () {
  Route::get('/', 'AuthController@login');
  Route::get('/dashbord', 'DashbordController@index')->name('admin.dashbord');
  Route::get('login', 'AuthController@login');
  Route::post('loggedin', 'AuthController@logggedin');
  Route::get('change_password', 'UserController@changepassword')->name('reset-password');
  Route::post('update_password', 'UserController@updatepassword')->name('update-password');
  Route::get('logout/', 'AuthController@logout')->name('admin.logout');
  //Route::get('cms/{slug?}','CmsController@index');
  // Route::post('cms/update','CmsController@update');
  /*** Customer module */
  Route::get('user/{user_type}', 'UserController@customerlist');
  Route::get('customer/add', 'UserController@addcustomer');
  Route::post('customer/save', 'UserController@createcustomer')->name('admin.create.customer');
  Route::get('customer/delete/{id}', 'UserController@deletecustomer')->name('admin.user.delete');
  Route::get('customer/edit/{id?}', 'UserController@addcustomer')->name('admin.user.edit');
  /** color module */
  Route::get('colors/', 'ColorController@index')->name('admin.colors');
  Route::get('add/color', 'ColorController@add')->name('admin.color.add');
  Route::post('add/store', 'ColorController@save')->name('admin.store.color');
  Route::get('color/edit/{id?}', 'ColorController@add')->name('admin.color.edit');
  Route::get('color/delete/{id}', 'ColorController@delete')->name('admin.color.deleted');
  /** category module */
  Route::get('categories/', 'CategoryController@index')->name('admin.category');
  Route::get('categories/add/', 'CategoryController@add')->name('admin.category.add');
  Route::get('categories/edit/{id?}', 'CategoryController@add')->name('admin.category.edit');
  Route::post('categories/save', 'CategoryController@save')->name('admin.category.save');
  Route::get('categories/delete/{id}', 'CategoryController@delete')->name('admin.categories.deleted');
  /** Sub category module */
  Route::get('categories/sub', 'CategoryController@getallsubcategory')->name('admin.category.sub');
  Route::get('categories/sub/add/', 'CategoryController@addsubcat')->name('admin.category.sub.add');
  Route::get('categories/sub/edit/{id?}', 'CategoryController@addsubcat')->name('admin.category.sub.edit');
  Route::post('categories/sub/save', 'CategoryController@savesubcategory')->name('admin.category.sub.save');
  Route::get('categories/sub/delete/{id}', 'CategoryController@subdelete')->name('admin.categories.sub.deleted');
  /** shapes module */
  Route::get('shapes/', 'ShapeController@index')->name('admin.shapes');
  Route::get('shapes/add', 'ShapeController@add')->name('admin.shapes.add');
  Route::get('shapes/edit/{id?}', 'ShapeController@add')->name('admin.shapes.edit');
  Route::get('shapes/delete/{id?}', 'ShapeController@delete')->name('admin.shapes.delete');
  Route::post('shapes/save', 'ShapeController@save')->name('admin.shapes.save');
  /** Attribute  */
  Route::get('attribute/', 'AttributeController@index')->name('admin.attribute');
  Route::get('add', 'AttributeController@add')->name('admin.attribute.add');
  Route::post('attribute/save', 'AttributeController@save')->name('admin.attribute.save');
  Route::get('attribute/delete/{id?}', 'AttributeController@delete')->name('admin.attribute.delete');
  Route::get('attribute/edit/{id?}', 'AttributeController@add')->name('admin.attribute.edit');
  /** discount */
  Route::get('discount', 'DiscountController@index')->name('admin.discount');
  Route::post('discount/save', 'DiscountController@update')->name('admin.discount.save');

  /**size */
  Route::get('sizes/', 'SizeController@index')->name('admin.sizes');
  Route::get('sizes/add', 'SizeController@add')->name('admin.size.add');
  Route::post('sizes/save', 'SizeController@save')->name('admin.size.save');
  Route::get('sizes/delete/{id?}', 'SizeController@delete')->name('admin.size.delete');
  Route::get('sizes/edit/{id?}', 'SizeController@add')->name('admin.size.edit');
  /** products  */
  Route::get('product/add', 'ProductController@add')->name('admin.product.add');
  Route::post('product/save', 'ProductController@save')->name('admin.product.save');
  Route::get('products/', 'ProductController@products')->name('admin.products');
  Route::post('product/all', 'ProductController@allproducts')->name('admin.product.all');
  Route::get('products/export', 'ProductController@download')->name('admin.products.export');
  Route::get('product/published/status/{id}/{status}', 'ProductController@changepublishedstatus');
  Route::get('product/ispurchased', 'ProductController@changeispurchasestatus')->name('admin.ispurchase');
  Route::post('product/shipping/cost', 'ProductController@productshippingcost')->name('admin.shipping.cost');

  Route::get('product/attributes/','ProductController@loadproductattribute')->name('admin.product.attribute');
  Route::get('product/remove/attribute/{id}','ProductController@removeproductattribute')->name('admin.productattribute.remove');

  Route::get('product/edit/{id?}', 'ProductController@edit')->name('admin.product.edit');
  Route::get('product/find/{id?}', 'ProductController@find')->name('admin.product.find');

  Route::post('product/update', 'ProductController@update')->name('admin.product.update');
  /** CONTACT  */
  Route::get('contact', 'ContactController@index')->name('admin.contact');
  Route::post('contact/save', 'ContactController@save')->name('admin.contact.save');

  /** SLIDER */
  Route::get('slider', 'SliderController@index');
  Route::get('slider/add', 'SliderController@addOrEdit')->name('admin.slider.add');
  Route::get('slider/edit/{id}', 'SliderController@addOrEdit')->name('admin.slider.edit');
  Route::get('slider/delete/{id}', 'SliderController@deleteSlider')->name('admin.slider.delete');
  Route::post('slider/add', 'SliderController@saveSlider')->name('admin.slider.save');

  /** MENU */
  Route::get('menu', 'MenuController@index')->name('admin.menu');
  Route::get('menu/add', 'MenuController@addOrEdit')->name('admin.menu.add');
  Route::get('menu/edit/{id}', 'MenuController@addOrEdit')->name('admin.menu.edit');
  Route::get('menu/delete/{id}', 'MenuController@deleteMenu')->name('admin.menu.delete');
  Route::post('menu/add', 'MenuController@saveMenu')->name('admin.menu.save');
  Route::get('menu/status/{id?}', 'MenuController@changeStatus')->name('admin.menu.status');
  Route::get('menu/set-mega-menu/{id}', 'MenuController@setMegamenu')->name('admin.menu.megamenu');
  Route::get('menu/set-on-head/{id}', 'MenuController@setOnTop')->name('admin.menu.top');
  Route::get('menu/set-on-side/{id}', 'MenuController@setOnSide')->name('admin.menu.side');


  /** MENU SUB CATEGORY */
  Route::get('menu-sub-category', 'MenuController@subcatList')->name('submenus');
  Route::get('menu-sub-category/add', 'MenuController@addsubmenu')->name('admin.productSubCategory.add');
  Route::get('menu-sub-category/edit/{id}', 'MenuController@editsubmenu')->name('admin.menu.subcat.edit');
  Route::get('menu-sub-category/delete/{id}', 'MenuController@deleteSubmenu')->name('admin.menu.subcat.delete');
  Route::post('menu-sub-category/save', 'MenuController@saveSubcategory')->name('admin.saveSubcategory.save');
  Route::post('menu-sub-category-update', 'MenuController@updateSubcat')->name('admin.update.subcat');

  /** Add mega menu category */
  Route::get('mega-menu-category-add','MenuController@addmegamenucategory')->name('admin.megamenu.category.add');
  Route::post('mega-menu-category-save','MenuController@savemegamenucategory')->name('admin.megamenu.category.save');
  Route::get('mega-menu-category-list','MenuController@allmegasubcategory')->name('admin.mega.menu.cat.list');
  Route::get('mega-menu-category-sub','MenuController@removemega_sub')->name('admin.mega.menu.cat.sub');

  /** Mega Menu */

  /** menu assign*/
  Route::get('admin/assign/menu', 'MenuController@products_menu_assignview')->name('admin.assign.menu');
  Route::post('admin/assign/product/list', 'MenuController@product_list')->name('assign.product.menu.list');
  Route::get('menu/submenus/', 'MenuController@getsubmenus')->name('assign.product.subcategory');
  Route::post('menu/add/products', 'MenuController@updatemenu')->name('assign.menu.products');

  // /** MENU CATEGORY */
  // Route::get('menu-category', 'ProductCategoryController@index');
  // Route::get('menu-category/add', 'ProductCategoryController@addOrEdit')->name('admin.productCategory.add');
  // Route::get('menu-category/edit/{id}', 'ProductCategoryController@addOrEdit')->name('admin.productCategory.edit');
  // Route::get('menu-category/delete/{id}', 'ProductCategoryController@delete')->name('admin.productCategory.delete');
  // Route::post('menu-category/add', 'ProductCategoryController@saveMenuCategory')->name('admin.productCategory.save');
  // Route::get('menu-category/megamenu/{id}/{id2}', 'ProductCategoryController@megaMenu')->name('admin.productCategory.status');

  

  /**Subscribers **/
  Route::get('subscribers', 'SubscriberController@index')->name('admin.subscribers');
  Route::get('subscribers/edit/{id}', 'SubscriberController@edit')->name('admin.subscribers.edit');
  Route::post('subscriber/save', 'SubscriberController@save')->name('admin.save.subscriber');

  /** Gallery  */
  Route::get('product/galleries/{product_id}', 'GalleryController@index')->name('admin.galleries');
  Route::get('product/galleries/add/{product_id}', 'GalleryController@add')->name('admin.gallery.add');
  Route::post('product/galleries/save', 'GalleryController@save')->name('admin.gallery.save');
  Route::get('product/galleries/delete/{id}/{product_id}', 'GalleryController@delete')->name('admin.gallery.delete');

  /** Gift **/
  Route::get('category/gifts/', 'CategoryController@gifts')->name('admin.gifts');
  Route::get('category/gifts/add', 'CategoryController@addgift')->name('admin.add.gifts');
  Route::post('gift/save', 'CategoryController@savegifts')->name('admin.gift.save');
  Route::get('gifts/remove/{id}', 'CategoryController@remove_gift')->name('admin.gift.remove');
  Route::get('category/gifts/edit/{id}', 'CategoryController@addgift')->name('admin.gift.edit');
  /* Price */
  Route::get('product/price_range', 'ProductController@price_range')->name('admin.price_range');
  Route::get('product/price_range/edit/{id}', 'ProductController@price_range')->name('admin.price_range.edit');
  Route::get('product/price_range/all', 'ProductController@all_price_ranges')->name('admin.price_range.all');
  Route::get('product/price_range/delete/{id}', 'ProductController@delete_range')->name('admin.price_range.delete');
  Route::post('product/price_rang/add', 'ProductController@save_range')->name('admin.range.save');

  /** Assign Category to product*/
  Route::get('product/assign/category', 'ProductController@productlist')->name('admin.assign.category');
  Route::post('product/assgin/products', 'ProductController@getAllproducts')->name('admin.product.assign');
  Route::post('product/size/update', 'ProductController@updatesize')->name('admin.product.updatesize');
  Route::post('product/gift/update', 'ProductController@addgift')->name('admin.product.updateaddgift');
  Route::post('product/shape/update', 'ProductController@addshape')->name('admin.product.updateshape');
  Route::post('product/category/update', 'ProductController@addCategory')->name('admin.product.updatecategory');
  Route::post('product/color/update', 'ProductController@addColors')->name('admin.product.colorupdate');
  Route::post('product/attribute/update', 'ProductController@addattribute')->name('admin.product.attributeupdate');
  Route::post('product/attribute/update/value', 'ProductController@getattributefromproduct')->name('admin.attributeupdate.product');
  Route::post('product/attribute/save/value', 'ProductController@updatedateattributevalue')->name('admin.attributeupdate.save');

  /* Review */
  Route::get('product/review', 'ReviewController@index')->name('admin.review');
  Route::get('product/review/delete/{id}', 'ReviewController@destroy')->name('admin.review.delete');
  Route::get('product/review/reply/{id}', 'ReviewController@admin_reply')->name('admin.review.reply');
  Route::post('product/review/save', 'ReviewController@save')->name('admin.review.save');

  /** Coupon */
  Route::get('coupon/', 'CouponController@index')->name('admin.product.coupon');
  Route::get('coupon/add', 'CouponController@add')->name('admin.product.coupon.add');
  Route::get('coupon/edit/{id}', 'CouponController@add')->name('admin.product.coupon.edit');
  Route::post('coupon/create', 'CouponController@save')->name('admin.product.coupon.create');
  Route::get('coupon/remove/{id}', 'CouponController@remove')->name('admin.product.coupon.remove');

  /** CK EDITOR */
  //Route::post('ckeditor/upload', 'CkeditorController@upload')->name('admin.ckeditor.upload');
  Route::post('ckeditor/upload', 'CkeditorController@upload')->name('admin.upload');

  /** CMS module */
  Route::get('cms/{slug?}', 'CmsController@index');
  Route::get('add/cms', 'CmsController@add')->name('admin.cms.add');
  Route::post('cms/save', 'CmsController@save')->name('admin.cms.save');
  Route::get('cms/edit/{id?}', 'CmsController@add')->name('admin.cms.edit');
  Route::get('cms/delete/{id}', 'CmsController@delete')->name('admin.cms.deleted');

  /** CMS Category module */
  Route::get('cms-category/{slug?}', 'CmsCategoryController@index');
  Route::get('add/cms-category', 'CmsCategoryController@add')->name('admin.cms_category.add');
  Route::post('cms-category/save', 'CmsCategoryController@save')->name('admin.cms_category.save');
  Route::get('cms-category/edit/{id?}', 'CmsCategoryController@add')->name('admin.cms_category.edit');
  Route::get('cms-category/delete/{id}', 'CmsCategoryController@delete')->name('admin.cms_category.deleted');


  /**Product Filters module */
  Route::get('product-filter/{slug?}', 'ProductFilterController@index')->name('admin.product_filter');
  Route::get('add/product-filter', 'ProductFilterController@add')->name('admin.product_filter.add');
  Route::post('product-filter/save', 'ProductFilterController@save')->name('admin.product_filter.save');
  Route::get('product-filter/edit/{id?}', 'ProductFilterController@add')->name('admin.product_filter.edit');
  Route::get('product-filter/delete/{id}', 'ProductController@delete')->name('admin.product_filter.deleted');


  Route::get('remove/thresixty/{id}', 'ProductController@removeAllThreeSixtyImages')->name('admin.remove');
  Route::post('product/upload', 'ProductController@upload')->name('admin.product.upload');

});
Route::group(['namespace' => 'App\Http\Controllers\fontend'], function () {
  Route::get('/', 'HomeController@index')->name('home');
  Route::post('/quickview', 'HomeController@getProductById')->name('home.quickview');
  /* Customer auth*/
  Route::get("/register", 'AuthController@register')->name('user.create');
  Route::get('/verify', 'AuthController@varify')->name('varify');
  Route::post('/save', 'AuthController@save')->name('registered.user');
  Route::post('/check', 'AuthController@getcheck')->name('user.varified');
  Route::get('/login', 'AuthController@login')->name('user.login');

  Route::post('/registered', 'AuthController@varified')->name('user.registered');
  Route::get('/thank-you', 'AuthController@thankyou')->middleware('customer')->name('user.thankyou');
  Route::get('/logout', 'AuthController@logout')->name('user.logout');
  Route::post('/loggedin', 'AuthController@loggedin')->name('user.loggedin');
  Route::post('/update/profile', 'ProfileController@update_profile')->name('user.profile');
  Route::get('/forgetpassword', 'AuthController@forgetpassword')->name('user.forget');
  Route::post('/send_reset_link', 'AuthController@sendresetlink')->name('user.resetlink');
  Route::get('/password_change/{token}', 'AuthController@change_password')->name('user.changepassword');
  Route::post('/reset_password', 'AuthController@upadatepassword')->name('user.reset');

  /* wishlists */
  Route::get('/wishlist', 'WislistController@index')->middleware('customer')->name('wishlist');
  Route::post('wishlist/add/', 'WislistController@create_wishlist')->name('wishlist.add');
  Route::post('wishlist/remove', 'WislistController@removewislist')->name('wishlist.remove');
  /* Subscribers */
  Route::post('/subscriber', 'HomeController@create_subscriber')->name('user.subscribes');

  /** Carts */
  Route::get('/carts', 'CartController@index')->name('user.cart');
  Route::post('cart/add', 'CartController@add_to_cart')->name('add.cart');
  Route::post('cart/remove', 'CartController@removecart')->name('remove.cart');
  Route::post('cart/upadate', 'CartController@updatecart')->name('update.cart');
  Route::post('cart/user/update', 'CartController@updateuseridintocart')->name('update.user.cart');
  /** coupon code**/
  Route::post('coupon/apply', 'CartController@cuponcode_apply')->name('coupon.apply');
  Route::post('coupon/update', 'CartController@checkexpiration')->name('coupon.auto');
  Route::post('coupon/remove', 'CartController@removecoupon')->name('coupon.remove');

  /** My accounts*/
  Route::get('account/settings/{slug?}', 'ProfileController@myaccount')->name('user.account');
  Route::post('account/update', 'ProfileController@updateprofile')->name('account.update');
  Route::post('account/change-password', 'ProfileController@changepassword')->name('account.changepassword');
  Route::get('country/getstate/{country_id}', 'ProfileController@getCountry');
  Route::post('account/address/save', 'ProfileController@saveaddress')->name('account.address.save');
  /** product details */
  Route::get('product/{id}', 'ProductController@index')->name('product');
  Route::get('shape/detail/{id?}/{slug?}', 'ShapeController@index')->name('shape.details');
   /** Share product **/
   Route::post('product/shared','FilterController@shareproduct')->name('product-shared');
  /**compair **/
  Route::get('compair/', 'CompairController@index')->middleware('customer')->name('compair');
  Route::post('compair/add', 'CompairController@addtocmpair')->name('compair.add');
  Route::post('compair/remove', 'CompairController@remove_compare')->name('compair.remove');
  Route::post('compair/list/update', 'CompairController@devicereplacebyuser')->name('compair.list.update');
  /** Review  */
  Route::post('product/review', 'ReviewController@addreview')->name('product.review');

  /** chekouts */
  Route::get('checkouts/', 'CheckoutController@index')->name('checkout');

  //purchase-order
  Route::post('purchase-order', 'OrderController@save')->name('purchase.save');

  //Diamonds filter
  Route::get('diamonds/search','FilterController@index')->name('diamonds.search');
  Route::get('diamonds/all','FilterController@allPosts')->name('all.product');
  Route::post('diamonds/get/pagelengthwise/diamonds','FilterController@getPagelengthwisedata')->name('lengthwise.data');
  Route::get('product/lengthwis/display','FilterController@getPagelengthwisedata')->name('page.length');
  Route::get('page','FilterController@pageLink')->name('page');
  Route::get('diamonds/order-filter','FilterController@orderfilter')->name('order.filter');
  Route::get('threesixty/products/{threesixty?}','FilterController@getThreesixtyProducts')->name('threesixty.products');

  Route::get('diamonds/price','FilterController@filter')->name('price_filter');

  /** products with api  */
  Route::get('products/list/all','ApiProductController@index');
  Route::get('product/list/ajax','ApiProductController@productlist')->name('product.ajax.list');

  /** Product Menu Detail */
  Route::get('menu-details/{menu_id?}','FilterController@product_menu_details')->name('menu.details');
  Route::get('autocomplete-search', 'ProductController@autocompleteSearch')->name('autocomplete.search');


  /** paypal  */
  Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PaypalController@payWithPaypal',));
  Route::post('paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
  Route::get('paypal', array('as' => 'status','uses' => 'PaypalController@getPaymentStatus',));

  /** Paypal */
  Route::get('paymentsuccess', 'PaymentController@payment_success');
  Route::get('paymenterror', 'PaymentController@payment_error');

  Route::get('contact', 'CMsController@contact');
  Route::get('about-us', 'CMsController@about');
  Route::get('faqs', 'CMsController@faq');

  /** Product Search**/
  Route::get('/product-search/{slug?}','FilterController@productsearch')->name('product-search');
  Route::get('/product-suggestion','FilterController@suggestionProducts')->name('product.suggestion');

});
