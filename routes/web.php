<?php
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

//ログイン周り
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//ブランド選択画面の表示
Route::get('/chose_brand', [HomeController::class, 'showChoseBrand'])->name('chose_brand');
//ブランド編集画面の表示
Route::get('/edit_brand', [HomeController::class, 'showEditBrand'])->name('edit_brand');
//ホーム画面の表示
Route::get('/home', [HomeController::class, 'showHome'])->name('home');
//商品管理画面の表示
Route::get('/item_manage', [HomeController::class, 'showItemManage'])->name('item_manage');
//費用管理画面の表示
Route::get('/cost_manage', [HomeController::class, 'showCostManage'])->name('cost_manage');
//商品登録画面の表示
Route::get('/store_item', [HomeController::class, 'showStoreItem'])->name('store_item');
//商品詳細画面の表示
Route::get('/edit_item/{item_id}', [HomeController::class, 'showItemDetail'])->name('item_detail');
//費用詳細画面の表示
Route::get('/cost_detail', [HomeController::class, 'showCostDetail'])->name('cost_detail');
//費用編集画面の表示
Route::get('/edit_cost/{id}', [HomeController::class, 'showEditCost'])->name('edit_cost');
//費用登録画面の表示
Route::get('/store_cost/{content}', [HomeController::class, 'showStoreCost'])->name('store_cost');


//並び替え（新しい順）
Route::get('/sort_new', [HomeController::class, 'sortNew'])->name('sort_new');
//並び替え（販売価格降順）
Route::get('/sort_price_desc', [HomeController::class, 'sortPriceDesc'])->name('sort_price_desc');
//並び替え（販売価格昇順）
Route::get('/sort_price_asc', [HomeController::class, 'sortPriceAsc'])->name('sort_price_asc');
//検索
Route::post('/search_item', [HomeController::class, 'searchItem'])->name('search_item');

//ブランド名の登録
Route::post('/store_brand', [HomeController::class, 'exeStoreBrand'])->name('exe_store_brand');
//ブランド名の変更
Route::post('/exe_edit_brand', [HomeController::class, 'exeEditBrand'])->name('exe_edit_brand');
//費用の登録
Route::post('/exe_store_cost', [HomeController::class, 'exeStoreCost'])->name('exe_store_cost');
//商品の登録
Route::post('/exe_store_item', [HomeController::class, 'exeStoreItem'])->name('exe_store_item');
//商品の編集
Route::post('/exe_edit_item', [HomeController::class, 'exeEditItem'])->name('exe_edit_item');
//商品の削除
Route::get('/exe_delete/{id}', [HomeController::class, 'exeDelete'])->name('exe_delete');
//費用の編集
Route::post('/exe_edit_cost', [HomeController::class, 'exeEditCost'])->name('exe_edit_cost');
//費用の削除
Route::get('/delete_cost/{id}', [HomeController::class, 'exeDeleteCost'])->name('exe_delete_cost');
//費用項目の追加
Route::get('/add_content', [HomeController::class, 'exeAddContent'])->name('exe_add_content');
//pdf出力
Route::get('/output_pdf', [HomeController::class, 'exeOutputPdf'])->name('output_pdf');

//去年の費用
Route::get('/last_year_cost', [HomeController::class, 'lastYearCost'])->name('last_year_cost');
//全ての費用
Route::get('/all_cost', [HomeController::class, 'AllCost'])->name('all_cost');


//権限選択
Route::get('/judge_role', [HomeController::class, 'showJudgeRole'])->name('judge_role');
//管理者
Route::post('/role_manage', [HomeController::class, 'roleManage'])->name('roll_manage');
//管理者ホーム画面
Route::get('/manage_home', [HomeController::class, 'showManageHome'])->name('manage_home');
//管理者ユーザー管理画面
Route::get('/manage_users', [HomeController::class, 'showManageUsers'])->name('manage_users');
//管理者商品管理画面
Route::get('/manage_items', [HomeController::class, 'showManageItems'])->name('manage_items');
//管理者費用管理画面
Route::get('/manage_costs', [HomeController::class, 'showManageCosts'])->name('manage_costs');
//管理者ユーザー削除
Route::get('/manage_delete_user/{id}', [HomeController::class, 'exeManageDeleteUser'])->name('manage_delete_user');
//管理者商品削除
Route::get('/manage_delete_item/{id}', [HomeController::class, 'exeManageDeleteItem'])->name('manage_delete_item');
//管理者費用削除
Route::get('/manage_delete_cost/{id}', [HomeController::class, 'exeManageDeleteCost'])->name('manage_delete_cost');
//管理者費用削除
Route::get('/manage_item_detail/{id}', [HomeController::class, 'showManageItemDetail'])->name('manage_item_detail');