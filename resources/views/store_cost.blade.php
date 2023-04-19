<x-app-layout>
    <style>
        .link-item:hover{
            opacity: 0.5;
        }
    </style>
    <div class="m-2">
        <a href="{{ route('cost_manage') }}" style="width:25px; height:25px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle-fill text-secondary link-item" viewBox="0 0 16 16" style="display:inline;">
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg>
        </a>
    </div>
    <div class="container">
        <div class="container mt-1 border rounded py-3 px-4" style="max-width: 330px;">
            <div class="text-center">
                <h4 style="color:696969;">{{ $content_name }}</h4>
            </div>
            <form action="/exe_store_cost" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ \Auth::user()['id'] }}">
                <input type="hidden" name="content" value="{{ $content_name }}">
                <div class="mb-2">
                    <label for="exampleInputDate" class="form-label">日付</label>
                    @error('date')
                    <div class="text-danger">
                    {{ $message }}
                    </div>
                    @enderror
                    <input type="date" name="date" class="form-control" id="exampleInputDate">
                </div>
                <div class="mb-2">
                    <label for="exampleInputPrice" class="form-label">金額(円)</label>
                    @error('price')
                    <div class="text-danger">
                    {{ $message }}
                    </div>
                    @enderror
                    <input type="price" name="price" class="form-control" id="exampleInputPrice">
                </div>
                @if($content_name === '仕入れ')
                <div class="mb-2">
                    <label for="exampleInputPrice" class="form-label">個数(個)</label>
                    @error('count')
                    <div class="text-danger">
                    {{ $message }}
                    </div>
                    @enderror
                    <input type="count" name="count" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="exampleInputPrice" class="form-label">商品名</label>
                    @error('item_id')
                    <div class="text-danger">
                    {{ $message }}
                    </div>
                    @enderror
                    <select class="form-select" name="item_id">
                        <option selected style="color:#696969;">商品を選択してください</option>
                        @foreach($items as $item)
                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
