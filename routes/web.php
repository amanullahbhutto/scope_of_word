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
use App\Http\Controllers\JobController;
use App\Http\Controllers\ContactController;
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



Route::get('/clear-cache', function () {
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');

    return response()->json(['message' => 'Route, config, and application cache cleared successfully.']);
})->name('clear.cache');





Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// route::get('leader-of-house',[FrontcController::class, 'leader_house'])->name('leader_house');
require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin','middleware' => ['auth', 'verified', 'role:super-admin|admin']], function () {
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
  
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole'])
    ->name('roles.give-permissions');

    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole'])
    ->name('roles.assign-permissions');

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);


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
    
    Route::resource('jobs', JobController::class);
    Route::resource('contacts', ContactController::class);
});

