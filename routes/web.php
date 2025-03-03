<?php
use Illuminate\Http\Request;  //Str
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FrontcController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\HomeController;  ///ProductController
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManagementTeamController;
use App\Http\Controllers\MediaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/form', function () {

    return view('seic.form');
})->name('form');



// route::get('/seics', function () {

//     $cityNames = ['KARACHI','KARACHI EAST','KARACHI SOUTH','HYDERABAD CITY','HYDERABAD','SUKKUR','MALIR','KARACHI CENTRAL','QASIMABAD','LATIFABAD','KARACHI WEST','QUBO SAEED KHAN',
//     'LARKANA','THUL','JACOBABAD','WARAH','SHIKARPUR','MATIARI','SHAHDAD KOT','GARHI KHAIRO','SOBHO DERO','JAMSHORO','UMER KOT','BADIN'];

//     $cityData = DB::table('company_info')
//     ->select('city', DB::raw('COUNT(*) as count'))
//     ->whereIn('city', $cityNames) // Assuming $cityNames is the array from earlier
//     ->groupBy('city')
//     ->get();

//     // Retrieve paginated results
//     $data = DB::table('company_info')->paginate(20);
//     DB::table('company_info')
//     ->where('city', 'like', '%Karachi%')
//     ->update(['province' => 'SINDH']);

//     return view('seic.company',compact('data','cityData'));
// })->name('seics');


Route::get('/it-industry-software-data',[HomeController::class,'company'])->name('sindh.industry');

Route::get('/software-it-industry',[HomeController::class,'company'])->name('sindh.industry');

Route::get('/seics-data',[HomeController::class,'getData'])->name('seics.data');


Route::get('/clear-cache', function () {
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');

    return response()->json(['message' => 'Route, config, and application cache cleared successfully.']);
})->name('clear.cache');

Route::get('/upload-json', function () {
    return view('fileupload');
});

// Route::get('/upload-json', [FrontcController::class, 'getjsonfile'])->name('upload.json');

Route::post('import', [FrontcController::class, 'import'])->name('import.company');
Route::post('/upload-json', [FrontcController::class, 'uploadJson'])->name('upload.json');


route::get('/',[FrontcController::class, 'index'])->name('home');
Route::get('/school-get-data', [FrontcController::class, 'getData'])->name('get.data.school');
Route::get('district/school',[FrontcController::class, 'district_school'])->name('district.school');
Route::get('district/{distname}', [FrontcController::class, 'show'])->name('district.show');
Route::get('school-deails/{id}', [FrontcController::class, 'school_details'])->name('school.show');
Route::get('request-form/Adopte-school',[FrontcController::class, 'addoped'])->name('school.adopte');
Route::get('/get-districts', [FrontcController::class, 'getDistricts'])->name('get.districts');
Route::get('/get-tehsils', [FrontcController::class, 'getTehsils'])->name('get.tehsils');
Route::post('/addopted/submit', [OtpController::class, 'store'])->name('addopted.submit');

Route::get('/success', [FrontcController::class, 'success'])->name('monitoring.success');



Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('api.sendOtp');
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('api.verifyOtp');



// Route::get('/', function () {
//     return view('frontend.home');
// });

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
// Route::get('/monitoring/pending', [MonitoringController::class, 'pending'])->name('monitoring.pending');
// Route::get('/monitoring/accepted', [MonitoringController::class, 'accepted'])->name('monitoring.accepted');
// Route::get('/monitoring/rejected', [MonitoringController::class, 'rejected'])->name('monitoring.rejected');

// Route::get('/monitoring/show', [MonitoringController::class, 'rejected'])->name('monitrering.show');

// Route::get('/pending-user-show/{id}', [MonitoringController::class, 'show'])->name('pending.show');
// Route::post('/pending-user-add/{id}', [MonitoringController::class, 'add_user'])->name('pending.add_user');


route::get('leader-of-house',[FrontcController::class, 'leader_house'])->name('leader_house');
require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin','middleware' => ['auth', 'verified', 'role:super-admin|admin']], function () {
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::resource('regions', App\Http\Controllers\RegionController::class);
    Route::resource('districts', App\Http\Controllers\DistrictController::class);
    Route::resource('schools',  App\Http\Controllers\SchoolController::class);

    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    // Route::get('/product/create', [ProductController::class, 'create'])->name('product.create'); //brand.edit
    // // Route::post('/product/store',[ProductController::class,'store'])->name('product.store');

    Route::get('/getSlug', function(Request $request) {
        $slug = '';
    
        if ($request->has('title')) {
            $slug = Str::slug($request->title);
        }
    
        return response()->json([
            'status' => true,
            'slug' => $slug
        ]);
    })->name('getSlug');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index'); // List all categories
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create'); // Show create form
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store'); // Store category
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show'); // Show single category
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit'); // Show edit form
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update'); // Update category
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); // Delete category

    // ManaagementTeamControlelr
    Route::resource('management-teams', ManagementTeamController::class);

    Route::resource('media', MediaController::class);
});

