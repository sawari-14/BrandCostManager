<x-app-layout>
    <div class="container">
        <main>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center d-flex justify-content-center mt-3">
                <div class="col">
                    <div class="card mb-4 rounded-3">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">今年の総経費</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">￥{{ $sum }}</h1>
                            <a href="{{ route('cost_detail') }}" type="button" class="w-50 btn btn-primary">詳細</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="container rounded border py-3" style="max-width: 600px; background-color:white;">
        <div class="mt-2 mb-3 text-center">
            <h4 class="fw-normal mt-2 mb-3  text-center" style="color:;696969">費用の登録</h4>
        </div>
        <div class="row my-2 px-2">

            <div class="col mb-3" style="min-width:180px; max-width:194px;">
                <form action="/store_cost/仕入れ" method="get">
                @csrf
                    <input type="hidden" name="content" value="仕入れ">
                    <button type="submit" class="w-75 btn btn-lg btn-outline-success">仕入れ</a>
                </form>
            </div>
            <div class="col mb-3" style="min-width:180px; max-width:194px;">
                <form action="/store_cost/配送費" method="get">
                @csrf
                    <input type="hidden" name="content" value="配送費">
                    <button type="submit" class="w-75 btn btn-lg btn-outline-success">配送費</a>
                </form>
            </div>
            <div class="col mb-3" style="min-width:180px; max-width:194px;">
                <form action="/store_cost/雑費" method="get">
                @csrf
                    <input type="hidden" name="content" value="雑費">
                    <button type="submit" class="w-75 btn btn-lg btn-outline-success">雑費</a>
                </form>
            </div>
            @foreach($contents as $content)
            <div class="col mb-3" style="min-width:180px; max-width:194px;">
                <form action="/store_cost/{{ $content['content'] }}" method="get">
                @csrf
                    <input type="hidden" name="content" value="{{ $content['content'] }}">
                    <button type="submit" class="w-75 btn btn-lg btn-outline-success">{{ $content['content'] }}</a>
                </form>
            </div>
            @endforeach
        </div>
        <form action="/add_content" type="get">
            @csrf
            <input type="hidden" name="user_id" value="{{ \Auth::user()['id'] }}">
            <div class="text-end pe-3">
                <input type="text" name="content" class="form-control" id="exampleName" style="width:150px; display:inline;">
                <button type="submit" class="btn btn-sm btn-success">追加</button>
            </div>
        </form>
    </div>
    @if(is_null(\Auth::user()['brand_name']))
    <div class="text-center mt-3">
        <a href="{{ route('chose_brand') }}" class="btn btn-outline-primary">ブランドを登録する</a>
    </div>
    @endif
</x-app-layout>