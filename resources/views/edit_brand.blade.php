<x-guest-layout>
    <div class="p-3">
        <div>
            <h4>ブランド名の変更</h4>
        </div>
        <form action="/exe_edit_brand" method="post">
            @csrf
            @error('brand_name')
                <div class="text-danger">
                {{ $message }}
                </div>
            @enderror
            <input type="text" name='brand_name' class="form-control" id="floatingInput" placeholder="ブランド名" value="{{ \Auth::user()['brand_name'] }}">
            <div class="text-center">
                <button type="submit" class=" btn btn-primary mt-2">変更する</button>
            </div>
        </form>
        <div class='text-center'>
            <a href="{{ route('home') }}" class=" btn btn-secondary mt-2">今はしない</a>
        </div>
    </div>
</x-guest-layout>