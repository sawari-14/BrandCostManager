<x-guest-layout>
    <div class="p-3">
        <div>
            <h4>あなたはこのBrand Cost Managerの管理者ですか？</h4>
        </div>
        <div class="text-secondary">
            <p>このシステムの管理者はユーザー管理や、商品、費用などの登録内容の管理をおこなうことができます。
        </div>
        <form action="/role_manage" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ \Auth::user()['id'] }}">
            <div class="text-center">
                <button type="submit" class=" btn btn-primary mt-2">管理者です</button>
            </div>
        </form>
        <div class='text-center'>
            <a href="{{ route('chose_brand') }}" class=" btn btn-secondary mt-2">一般ユーザーです</a>
        </div>
    </div>
</x-guest-layout>
