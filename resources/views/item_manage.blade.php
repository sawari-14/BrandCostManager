<x-app-layout>
    <div class="container w-100 justify-content-left mt-2">
        <a href="{{ route('store_item') }}" style="text-decoration:none;">
            <button type="button" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="display:inline;">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
            商品を登録する
            </button>
        </a>
        <select class="form-select ms-3" id="sort-item" style="width:200px; display:inline;" onChange="location.href=value;">
            <option selected style="color:#696969;"></option> 
            <option value="{{ route('item_manage') }}">登録順</option>         
            <option value="/sort_new">新しい順</option>
            <option value="/sort_price_desc">販売価格の高い順</option>
            <option value="/sort_price_asc">販売価格の安い順</option>
            
        </select>
        <button type="button" class="btn btn-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down-up sort-button" viewBox="0 0 16 16" style="display:inline;">
                <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
        </button>
        <form action="/search_item" method="post" style="display:inline;">
            @csrf
            <div style="display:inline; width:200px;">
                <input class="form-control" name="item_name" list="datalistOptions" id="exampleDataList" style="display:inline; width:200px;">
                <datalist id="datalistOptions">
                @foreach($items_name as $item_name)
                    <option value="{{ $item_name['name'] }}">
                @endforeach             
                </datalist> 
            </div>
            <button type="submit" class="btn btn-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="display:inline;">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </form>
    </div>
    <div class="container mt-2">
        <p class="h6" style="color:#696969;">< 表示 : {{ $result }} ></p>
    </div>

    <div class="container mt-2 border-top">

        <div class="row mt-2">
            @foreach($items as $item)
            <div class="col mb-2">
                <div class="card" style="width: 18rem;">
                    <img src="{{ '/storage/' . $item['image'] }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['name'] }}</h5>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">販売価格</th>
                                    <td>{{ $item['price'] }}円</td>
                                </tr>
                                <tr>
                                    <th scope="row">利益率</th>
                                    @foreach($costs as $cost)
                                        @if($item['id'] === $cost->item_id)
                                    <td>{{ floor(($item['price']-$cost->unit_cost)/$item['price']*100) }}%</td>
                                        @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="row">総仕入価格</th>
                                    @foreach($costs as $cost)
                                        @if($item['id'] === $cost->item_id)
                                    <td>￥{{ $cost->sum_cost }}</td>
                                        @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="row">仕入単価</th>
                                    @foreach($costs as $cost)
                                        @if($item['id'] === $cost->item_id)
                                    <td>￥{{ $cost->unit_cost }}</td>
                                        @endif
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <form action="/edit_item/{{ $item['id'] }}" method="get">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                            <button type="submit" class="btn btn-primary">編集</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>