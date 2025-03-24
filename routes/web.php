<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\New_ProductController;
use App\Jobs\SendTestMailJob;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Events\UserLoggedIn;
use Illuminate\Support\Facades\Auth;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Http\Controllers\ExcelController;


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

Route::get('/greeting/{locale}', function ($locale) {
    $lang = App::getLocale();
    $lang = App::currentLocale();
    return 

    dd($lang);
    // if (! in_array($locale, ['en', 'es', 'fr'])) {
    //     abort(400);
    // }
 
    App::setLocale($locale);
 
    //
});


Route::get('/testEvent', function () {
    $data = [
        'name' => 'John Doe',
        'message' => 'This is a test email using Mailtrap!'
    ];
    
    $user = App\Models\User::find(1);
    // dd($user);
    event(new UserLoggedIn($user));
        
    return response()->json(['message' => 'User logged in']);
    
    
});

Route::get('/send-test-email', function () {
    $data = [
        'name' => 'John Doe',
        'message' => 'This is a test email using Mailtrap!'
    ];

    Mail::to('test@example.com')->send(new TestMail($data));

    return "Test email has been sent!";
});

Route::get('/', function (Request $request) {
    // dd($request);

    return view('auth.login');
});

 
Route::get('/service', function (Service $service) {
    dd(get_class($service));
});

Route::get('/collection', function (Request $request) {
    // dd($request);
    $collection = collect([2, 5, 1, 2, 5, 696, 8, 85, 475, 696, 44, 66, 2, 636, 363, 696, 1, 1]);
    // $collection = Illuminate\Support\Collection::make ([2,5,18,85,475,696,44,66,2,636,363]);
    // $collection = new Illuminate\Support\Collection ([2,5,18,85,475,696,44,66,2,636,363]);
    // $collect = $collection->chunk(3);
    // dd($collect);

    // $collection->dd();
    // $collection->dump();
//    return $collection->duplicates();
//    return $collection->mode();
//    return $collection->last();
    $user = App\Models\User::all();
    dd($user);
    echo " Test ";
});

Route::get('/createQueueJob', function () {    
    dispatch(new SendTestMailJob)->delay(now()->addSeconds(50));
    return " mail send before";
});

Route::get('/createQueue', function () {    
    // dispatch(function(){
    //     echo " mail send  later  ";

    // })->delay(now()->addSeconds(50));
    // return " mail send before";
    dispatch(new SendTestMailJob)->delay(now()->addSeconds(5));
    return " mail send before";
});
Route::get('/sendMail', function () {
    $data = ['name' => 'New Code'];
    Mail::send([], [], function ($msg) {
        $msg->to('mohamed.ahmed@code4code.com', 'Advanced Laravel Code')
            ->subject('New Subject')
            ->setBody('The Test Coder56456', 'text/plain'); // Set the body and type
    });

    return "Mail Sent";
});
//     })
// });

Route::get('/contracts', function (Factory $cache) {
    // $cache->put('key', 'The Test Coder');
    dd($cache->get('key'));

});

//new routes 

// Route::get('/add-product', [New_ProductController::class, 'create'])->name('products.create');
Route::post('/insert-product', [New_ProductController::class, 'store'])->name('products.store');

// Route::get('/add-product', [New_ProductController::class, 'create'])->name('products.create');
//product
Route::get('/add-product', function () {
    return view('products.create');
})->middleware(['auth'])->name('add.product');

// Route::post('/insert-product',[ProductController::class,'store'])->middleware(['auth']);

Route::get('/all-product', [ProductController::class, 'allProduct'])->middleware(['auth'])->name('all.product');

Route::get('/available-products', [ProductController::class, 'availableProducts'])->middleware(['auth'])->name('available.products');

Route::get('/purchase-products/{id}', [ProductController::class, 'purchaseData'])->middleware(['auth']);

Route::post('/insert-purchase-products', [ProductController::class, 'storePurchase'])->middleware(['auth']);


//invoice
Route::get('/add-invoice/{id}', [InvoiceController::class, 'formData'])->middleware(['auth']);

Route::get('/new-invoice', [InvoiceController::class, 'newformData'])->middleware(['auth'])->name('new.invoice');

Route::post('/insert-invoice', [InvoiceController::class, 'store'])->middleware(['auth']);

Route::get('/invoice-details', function () {
    return view('Admin.invoice_details');
})->middleware(['auth'])->name('invoice.details');

Route::get('/all-invoice', [InvoiceController::class, 'allInvoices'])->middleware(['auth'])->name('all.invoices');

Route::get('/sold-products', [InvoiceController::class, 'soldProducts'])->middleware(['auth'])->name('sold.products');
// Route::get('/delete', [InvoiceController::class,'delete']);


//order
Route::get('/add-order/{name}', [ProductController::class, 'formData'])->middleware(['auth'])->name('add.order');

Route::post('/insert-order', [OrderController::class, 'store'])->middleware(['auth']);

Route::get('/all-orders', [OrderController::class, 'ordersData'])->middleware(['auth'])->name('all.orders');

Route::get('/pending-orders', [OrderController::class, 'pendingOrders'])->middleware(['auth'])->name('pending.orders');

Route::get('/delivered-orders', [OrderController::class, 'deliveredOrders'])->middleware(['auth'])->name('delivered.orders');

Route::get('/new-order', [OrderController::class, 'newformData'])->middleware(['auth'])->name('new.order');

Route::post('/insert-new-order', [OrderController::class, 'newStore'])->middleware(['auth']);


//customer
Route::get('/add-customer', function () {
    return view('Admin.add_customer');
})->middleware(['auth'])->name('add.customer');

Route::post('/insert-customer', [CustomerController::class, 'store'])->middleware(['auth']);

Route::get('/all-customers', [CustomerController::class, 'customersData'])->middleware(['auth'])->name('all.customers');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/export-users', function () {
    return Excel::download(new UsersExport, 'users.xlsx');
});

Route::post('/import-users', function (Request $request) {
    Excel::import(new UsersImport, $request->file('file'));
    return back()->with('success', 'Users imported successfully!');
});

// 24/03/2025
Route::get('/export-orders', function () {
    return Excel::download(new OrdersExport, 'orders.xlsx');
});

Route::get('/excel', function(){
    // dd('excel');
    return view('excel');
});
Route::get('/exportUsers', [ExcelController::class, 'export'])
    ->name('export.users');
Route::post('/importUsers', [ExcelController::class, 'import']);
require __DIR__ . '/auth.php';