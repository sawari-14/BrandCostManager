<x-guest-layout>
    <div class="p-3">
        <div>
            <h4>ブランドを登録しますか？</h4>
        </div>
        <div class="text-secondary">
            <p>ブランドを登録すると、商品登録が可能になり、商品ごとの費用管理や
                分析がおこなえるようになります。
            </p>
            <p>ブランドの登録は後からでもおこなうことができます。</p>
        </div>
        <form action="/store_brand" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ \Auth::user()['id'] }}">
            @error('brand_name')
                <div class="text-danger">
                {{ $message }}
                </div>
            @enderror
            <input type="text" name='brand_name' class="form-control" id="floatingInput" placeholder="ブランド名">
            <div class="text-center">
                <button type="submit" class=" btn btn-primary mt-2">登録する</button>
            </div>
        </form>
        <div class='text-center'>
            <a href="{{ route('cost_manage') }}" class=" btn btn-secondary mt-2">今はしない</a>
        </div>
    </div>
</x-guest-layout>
