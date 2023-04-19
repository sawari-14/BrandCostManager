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
    @if($year==='今年')
    <div class="container" style="max-width:800px;">
        <a href="{{ route('cost_detail') }}" class="btn btn-secondary me-2">今年の経費</a>
        <a href="{{ route('last_year_cost') }}" class="btn btn-outline-secondary me-2">去年の経費</a>
        <a href="{{ route('all_cost') }}" class="btn btn-outline-secondary">全て表示</a>
    </div>
    @endif
    @if($year==='去年')
    <div class="container" style="max-width:800px;">
        <a href="{{ route('cost_detail') }}" class="btn btn-outline-secondary me-2">今年の経費</a>
        <a href="{{ route('last_year_cost') }}" class="btn btn-secondary me-2">去年の経費</a>
        <a href="{{ route('all_cost') }}" class="btn btn-outline-secondary">全て表示</a>
    </div>
    @endif
    @if($year==='全て')
    <div class="container" style="max-width:800px;">
        <a href="{{ route('cost_detail') }}" class="btn btn-outline-secondary me-2">今年の経費</a>
        <a href="{{ route('last_year_cost') }}" class="btn btn-outline-secondary me-2">去年の経費</a>
        <a href="{{ route('all_cost') }}" class="btn btn-secondary">全て表示</a>
    </div>
    @endif
    @foreach($contents as $content)
    <div class="container my-3" style="max-width:800px;">
        <h4>{{ $content }}</h4>
        <div class="row rounded border text-center bg-light" style="background-color: d3d3d3;">
            <div class="col border-end pt-2" style="background-color: #f5f5f5;">
                <h5>日付</h5>
            </div>
            <div class="col border-end pt-2" style="background-color: #f5f5f5;">
                <h5>金額</h5>
            </div>
            @if($content === '仕入れ')
            <div class="col border-end pt-2" style="background-color: #f5f5f5;">
                <h5>商品名</h5>
            </div>
            <div class="col border-end pt-2" style="background-color: #f5f5f5;">
                <h5>個数</h5>
            </div>
            @endif
            <div class="col border-end pt-2" style="max-width:100px; background-color: #f5f5f5;">
                <h5>編集</h5>
            </div>
            <div class="col pt-2" style="max-width:100px; background-color: #f5f5f5;">
                <h5>削除</h5>
            </div>
        </div>
            @foreach($costs as $cost)
                @if($cost['content'] === $content)
        <div class="row rounded border text-center" style="background-color: white;">
            <div class="col border-end pt-2">
                <h5>{{ $cost['date'] }}</h5>
            </div>
            <div class="col border-end pt-2">
                <h5>{{ $cost['price'] }}</h5>
            </div>
            @if($content === '仕入れ')
            <div class="col border-end pt-2">
                @foreach($buyingCosts as $buyingCost)
                    @if($cost['item_id'] === $buyingCost['item_id'])
                <h5>{{ $buyingCost['name'] }}</h5>
                        @break
                    @endif
                @endforeach
            </div>
                
            <div class="col border-end pt-2">
                <h5>{{ $cost['count'] }}</h5>
            </div>
            @endif            
            <form action="/edit_cost/{{ $cost['id'] }}" method="get" class="col border-end" style="max-width:100px;">
                @csrf
                <input type="hidden" name="id" value="{{ $cost['id'] }}">
                <button type="submit" class="btn btn-outline-success">編集</button>
            </form>
            <form action="/delete_cost/{{ $cost['id'] }}" method="get" class="col" style="max-width:100px;" onSubmit="return checkDelete()">
            @csrf
                <input type="hidden" name="id" value="{{ $cost['id'] }}">
                <button type="submit" class="btn btn-outline-danger">削除</button>
            </form>
        </div>
                @endif
            @endforeach
    </div>

    @endforeach
    <div class="container text-end my-5" style="max-width:800px;">
        <a href="/output_pdf" class="btn btn-secondary">今年の経費内訳をPDF出力する</a>
    </div>
    <script>
        function checkDelete(){
            if(window.confirm('費用を削除しますか？')){
                return true;
            }else{
                return false;
            }
        }
    </script>
</x-app-layout>
