<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\CostRequest;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\EditItemRequest;
use App\Models\User;
use App\Models\Cost;
use App\Models\Item;
use App\Models\Content;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{ 
    /**
     * ログイン画面の表示
     * 
     * @return view
     */
    public function showLogin(){
        return view('login');
    }

    /**
     * 新規登録画面の表示
     * 
     * @return view
     */
    public function showRegister(){
        return view('register');
    }

     /**
     * ブランド選択画面の表示
     * 
     * @return view
     */
    public function showChoseBrand(){
        return view('chose_brand');
    }

     /**
     * ブランド編集画面の表示
     * 
     * @return view
     */
    public function showEditBrand(){
        return view('edit_brand');
    }

    /**
     * ユーザー情報画面の表示
     * 
     * @return view
     */
    public function showUserInfo(){
        return view('user_info');
    }


    /**
     * ホーム画面の表示
     * 
     * @return view
     */
    public function showHome(){
        if(\Auth::user()['role'] === 1){
            return redirect(route('manage_home'));
        }
        if(is_null(\Auth::user()['brand_name'])){
            return redirect(route('cost_manage'));
        }
        $sum = Cost::where('user_id',\Auth::user()['id'])->sum('price');
        $user = \Auth::user();
        return view('home',compact('user','sum'));
    }

    /**
     * 商品管理画面の表示
     * 
     * @return view
     */
    public function showItemManage(){
        if(is_null(\Auth::user()['brand_name'])){
            return view('cost_manage');
        }
        $costs = DB::table('costs')
        ->select(DB::raw('sum(price) as sum_cost, sum(price)/sum(count) as unit_cost, item_id'))
        ->where('user_id', \Auth::user()['id'])
        ->whereNotNull('item_id')
        ->groupBy('item_id')
        ->get();
        $items = Item::where('user_id',\Auth::user()['id'])->get();
        $items_name = Item::where('user_id',\Auth::user()['id'])->get();
        $result = '登録順';
        return view('item_manage',compact('items','costs','items_name','result'));
    }

    /**
     * 商品管理画面の表示(検索)
     * 
     * @return view
     */
    public function searchItem(Request $request){
        if(is_null(\Auth::user()['brand_name'])){
            return view('cost_manage');
        }
        $costs = DB::table('costs')
        ->select(DB::raw('sum(price) as sum_cost, sum(price)/sum(count) as unit_cost, item_id'))
        ->where('user_id', \Auth::user()['id'])
        ->whereNotNull('item_id')
        ->groupBy('item_id')
        ->get();
        $items = Item::where('user_id',\Auth::user()['id'])->where('name',$request->item_name)->get();
        $items_name = Item::where('user_id',\Auth::user()['id'])->get();
        $result = $request->item_name;
        return view('item_manage',compact('items','costs','items_name','result'));
    }

    /**
     * 商品管理画面(新しい順)の表示
     * 
     * @return view
     */
    public function sortNew(){
        if(is_null(\Auth::user()['brand_name'])){
            return view('cost_manage');
        }
        $costs = DB::table('costs')
        ->select(DB::raw('sum(price) as sum_cost, sum(price)/sum(count) as unit_cost, item_id'))
        ->where('user_id', \Auth::user()['id'])
        ->whereNotNull('item_id')
        ->groupBy('item_id')
        ->get();
        $items = Item::where('user_id',\Auth::user()['id'])->orderBy('id', 'desc')->get();
        $items_name = Item::where('user_id',\Auth::user()['id'])->get();
        $result = '新しい順';
        return view('item_manage',compact('items','costs','items_name','result'));
    }

    /**
     * 商品管理画面(販売価格降順)の表示
     * 
     * @return view
     */
    public function sortPriceDesc(){
        if(is_null(\Auth::user()['brand_name'])){
            return view('cost_manage');
        }
        $costs = DB::table('costs')
        ->select(DB::raw('sum(price) as sum_cost, sum(price)/sum(count) as unit_cost, item_id'))
        ->where('user_id', \Auth::user()['id'])
        ->whereNotNull('item_id')
        ->groupBy('item_id')
        ->get();
        $items = Item::where('user_id',\Auth::user()['id'])->orderBy('price', 'desc')->get();
        $items_name = Item::where('user_id',\Auth::user()['id'])->get();
        $result = '販売価格高い順';
        return view('item_manage',compact('items','costs','items_name','result'));
    }

    /**
     * 商品管理画面(販売価格昇順)の表示
     * 
     * @return view
     */
    public function sortPriceAsc(){
        if(is_null(\Auth::user()['brand_name'])){
            return view('cost_manage');
        }
        $costs = DB::table('costs')
        ->select(DB::raw('sum(price) as sum_cost, sum(price)/sum(count) as unit_cost, item_id'))
        ->where('user_id', \Auth::user()['id'])
        ->whereNotNull('item_id')
        ->groupBy('item_id')
        ->get();
        $items = Item::where('user_id',\Auth::user()['id'])->orderBy('price', 'asc')->get();
        $items_name = Item::where('user_id',\Auth::user()['id'])->get();
        $result = '販売価格低い順';
        return view('item_manage',compact('items','costs','items_name','result'));
    }

    /**
     * 商品登録画面の表示
     * 
     * @return view
     */
    public function showStoreItem(){
        if(is_null(\Auth::user()['brand_name'])){
            return view('cost_manage');
        }
        return view('store_item');
    }

    /**
     * 商品詳細画面の表示
     * @param int $item_id
     * @return view
     */
    public function showItemDetail($item_id){
        $item = Item::find($item_id);
        return view('item_detail',compact('item'));
    }

    /**
     * 費用管理画面の表示
     * 
     * @return view
     */
    public function showCostManage(){
        if(\Auth::user()['role'] === 1){
            return redirect(route('manage_home'));
        }
        $sum = Cost::where('user_id',\Auth::user()['id'])->sum('price');
        $contents = Content::where('user_id',\Auth::user()['id'])->get();
        return view('cost_manage',compact('sum','contents'));
    }

    /**
     * 費用登録画面の表示
     * @param string $content
     * @return view
     */
    public function showStoreCost($content){
        $items = item::where('user_id',\Auth::user()['id'])->get();
        $content_name = $content;
        return view('store_cost',compact('content_name','items'));
    }

    /**
     * 費用詳細画面の表示
     * 
     * @return view
     */
    public function showCostDetail(){
        $year = '今年';
        $contents = Cost::whereYear('date',date('Y'))->where('user_id',\Auth::user()['id'])->distinct()->pluck('content');
        $buyingCosts = Cost::join('items', 'item_id', '=', 'items.id')->whereYear('date',date('Y'))->where('costs.user_id',\Auth::user()['id'])->orderBy('costs.date', 'desc')->get();
        $costs = Cost::whereYear('date',date('Y'))->where('user_id',\Auth::user()['id'])->orderBy('date', 'desc')->get();
        return view('cost_detail',compact('contents','costs','year','buyingCosts'));
    }

    /**
     * 費用詳細画面(去年)の表示
     * 
     * @return view
     */
    public function lastYearCost(){
        $year = '去年';
        $contents = Cost::whereYear('date',date('Y',strtotime('-1 year')))->where('user_id',\Auth::user()['id'])->distinct()->pluck('content');
        $buyingCosts = Cost::join('items', 'item_id', '=', 'items.id')->whereYear('date',date('Y',strtotime('-1 year')))->where('costs.user_id',\Auth::user()['id'])->orderBy('costs.date', 'desc')->get();
        $costs = Cost::whereYear('date',date('Y',strtotime('-1 year')))->where('user_id',\Auth::user()['id'])->orderBy('date', 'desc')->get();
        return view('cost_detail',compact('contents','costs','year','buyingCosts'));
    }

    /**
     * 費用詳細画面(全て)の表示
     * 
     * @return view
     */
    public function AllCost(){
        $year = '全て';
        $contents = Cost::where('user_id',\Auth::user()['id'])->distinct()->pluck('content');
        $buyingCosts = Cost::join('items', 'item_id', '=', 'items.id')->where('costs.user_id',\Auth::user()['id'])->orderBy('costs.date', 'desc')->get();
        $costs = Cost::where('user_id',\Auth::user()['id'])->orderBy('date', 'desc')->get();
        return view('cost_detail',compact('contents','costs','year','buyingCosts'));
    }

    /**
     * 費用編集画面の表示
     * 
     * @return view
     */
    public function showEditCost($id){
        $items = item::where('user_id',\Auth::user()['id'])->get();
        $data = Cost::where('id',$id)->first();
        $item_name = Item::where('id',$data['item_id'])->first();
        return view('edit_cost',compact('data','items','item_name'));
    }

    /**
     * ブランド名の登録
     * 
     * @return view
     */
    public function exeStoreBrand(UserRequest $request){
        $inputs = $request->all();
        \DB::beginTransaction();
        try{
            User::where('id', $inputs['user_id'])->update(['brand_name' => $inputs['brand_name']]);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }        
        return redirect(route('home'));
    }

    /**
     * ブランド名の変更
     * 
     * @return view
     */
    public function exeEditBrand(UserRequest $request){
        \DB::beginTransaction();
        try{
            User::where('id', \Auth::user()['id'])->update(['brand_name' => $request['brand_name']]);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }        
        return redirect(route('home'));
    }

    /**
     * 費用の登録
     * 
     * @return view
     */
    public function exeStoreCost(CostRequest $request){
        if($request['content'] === '仕入れ'){
             $request->validate([
                'count' => ['required', 'numeric'],
                'item_id' => ['required'],
            ]);
        }
        $inputs = $request->all();

            Cost::create($inputs);
     
        return redirect(route('cost_detail'));
    }

    /**
     * 商品の登録
     * 
     * @return view
     */
    public function exeStoreItem(ItemRequest $request){
        
        $data = $request->all();
        //画像処理
        $image = $request->file('image');
        if($request->hasFile('image')){
            $path = \Storage::put('/public',$image);
            $path = explode('/',$path);
        }else{
            $path = null;
        }
        //データベース登録
        \DB::beginTransaction();
        try{
            Item::insert(['name'=>$data['item_name'], 'user_id'=>$data['user_id'], 'price'=>$data['price'], 'image'=>$path[1]]);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }  
        return redirect(route('item_manage'));
    }

    /**
     * 商品の編集
     * 
     * @return view
     */
    public function exeEditItem(EditItemRequest $request){      
        $data = $request->all();
        //画像処理
        $image = $request->file('image');
        if($request->hasFile('image')){
            $path = \Storage::put('/public',$image);
            $path = explode('/',$path);
            try{
                Item::where('id',$data['id'])->update(['image'=>$path[1]]);
            }catch(\Throwable $e){
                abort(500);
            } 
        }
        //データベース登録
        \DB::beginTransaction();
        try{
            Item::where('id',$data['id'])->update(['name'=>$data['item_name'],'price'=>$data['price']]);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }  
        return redirect(route('item_manage'));
    }

    /**
     * 商品の削除
     * @param int $id
     * @return view
     */
    public function exeDelete($id){
        \DB::beginTransaction();
        try{
            Item::where('id',$id)->delete();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        } 
        return redirect(route('item_manage'));
    }

    /**
     * 費用の編集
     * 
     * @return view
     */
    public function exeEditCost(CostRequest $request){  
        $data = $request->all();
        if($request['content'] === '仕入れ'){
            $request->validate([
               'count' => ['required', 'numeric'],
               'item_id' => ['required'],
           ]);
           \DB::beginTransaction();
           try{
               Cost::where('id',$data['id'])->update(['count'=>$data['count'],'item_id'=>$data['item_id']]);
               \DB::commit();
           }catch(\Throwable $e){
               \DB::rollback();
               abort(500);
           } 
        }    
        \DB::beginTransaction();
        try{
            Cost::where('id',$data['id'])->update(['date'=>$data['date'],'price'=>$data['price']]);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }  
        return redirect(route('cost_detail'));
    }

    /**
     * 費用の削除
     * @param int $id
     * @return view
     */
    public function exeDeleteCost($id){
        \DB::beginTransaction();
        try{
            Cost::where('id',$id)->delete();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        } 
        return redirect(route('cost_detail'));
    }

    /**
     * 費用項目の追加
     * 
     * @return view
     */
    public function exeAddContent(Request $request){
        $request->validate([
            'content' => ['required'],
        ]);
        $input = $request->all();
        \DB::beginTransaction();
        try{
            Content::insert(['user_id'=>$input['user_id'], 'content'=>$input['content']]);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        } 
        $contents = Content::where('user_id',\Auth::user()['id'])->get();
        return redirect(route('cost_manage',compact('contents')));
    }

    /**
     * pdf出力
     * 
     * @return view
     */
    public function exeOutputPdf(){
        $costs = DB::table('costs')
        ->select(DB::raw('sum(price) as sum_cost, content'))
        ->where('user_id', \Auth::user()['id'])
        ->groupBy('content')
        ->get();
        $sum = Cost::where('user_id', \Auth::user()['id'])->sum('price');
        $pdf = \PDF::loadView('output_pdf',compact('costs','sum'))->setPaper('b5','landscape');
        return $pdf->stream('costs.pdf');
        return redirect(route('cost_detail'));
    }

    /**
     * 権限選択画面の表示
     * 
     * @return view
     */
    public function showJudgeRole(){
        return view('judge_role');
    }
    
    /**
     * 管理者権限の付与
     * 
     * @return view
     */
    public function roleManage(Request $request){
        \DB::beginTransaction();
        try{
            User::where('id',$request->user_id)->update(['role'=> 1 ]);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        } 
        return redirect(route('manage_home'));
    }

    /**
     * 管理者ホームの表示
     * 
     * @return view
     */
    public function showManageHome(){
        if(!\Auth::user()['role'] === 1){
            return redirect(route('home'));
        }
        return view('manage_home');
    }

    /**
     * 管理者ユーザー管理画面の表示
     * 
     * @return view
     */
    public function showManageUsers(){
        if(!\Auth::user()['role'] === 1){
            return redirect(route('home'));
        }
        $users = User::all();
        return view('manage_users',compact('users'));
    }

    /**
     * 管理者商品管理画面の表示
     * 
     * @return view
     */
    public function showManageItems(){
        if(!\Auth::user()['role'] === 1){
            return redirect(route('home'));
        }
        $items = Item::all();
        return view('manage_items',compact('items'));
    }

    /**
     * 管理者費用管理画面の表示
     * 
     * @return view
     */
    public function showManageCosts(){
        if(!\Auth::user()['role'] === 1){
            return redirect(route('home'));
        }
        $costs = Cost::all();
        return view('manage_costs',compact('costs'));
    }

    /**
     * 管理者ユーザーの削除
     * @param int $id
     * @return view
     */
    public function exeManageDeleteUser($id){
        \DB::beginTransaction();
        try{
            User::where('id',$id)->delete();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        } 
        return redirect(route('manage_users'));
    }

    /**
     * 管理者商品の削除
     * @param int $id
     * @return view
     */
    public function exeManageDeleteItem($id){
        \DB::beginTransaction();
        try{
            Item::where('id',$id)->delete();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        } 
        return redirect(route('manage_items'));
    }

    /**
     * 管理者商品の削除
     * @param int $id
     * @return view
     */
    public function exeManageDeleteCost($id){
        \DB::beginTransaction();
        try{
            Cost::where('id',$id)->delete();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        } 
        return redirect(route('manage_costs'));
    }

    /**
     * 管理者商品詳細画面の表示
     * @param int $id
     * @return view
     */
    public function showManageItemDetail($id){
        $item = Item::where('id',$id)->first();
        return view('manage_item_detail',compact('item'));
    }
}
