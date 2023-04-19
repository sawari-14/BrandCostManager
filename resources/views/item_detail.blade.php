<x-app-layout>
    <style>
        .link-item:hover{
            opacity: 0.5;
        }
    </style>
    <div class="m-2">
        <a href="{{ route('item_manage') }}" style="width:25px; height:25px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle-fill text-secondary link-item" viewBox="0 0 16 16" style="display:inline;">
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg>
        </a>
    </div>
    <div class="container">
        <div class="container border rounded py-3 px-4" style="max-width: 350px;">
            <form action="/exe_edit_item" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $item['id'] }}"> 
                <div class="mb-2 text-center">
                <img src="{{ '/storage/' . $item['image'] }}" class="card-img-top" alt="...">
                </div>
                <div class="mb-2">
                    <label for="formFile" class="form-label">商品画像</label>
                    @error('image')
                    <div class="text-danger">
                    {{ $message }}
                    </div>
                    @enderror
                    <input type="file" class="form-control" name="image" id="formFile" value="{{ $item['image'] }}">
                </div>
                <div class="mb-2">
                    <label for="exampleInputEmail1" class="form-label">商品名</label>
                    @error('item_name')
                    <div class="text-danger">
                    {{ $message }}
                    </div>
                    @enderror
                    <input type="name" class="form-control" id="exampleInputName" name="item_name" value="{{ $item['name'] }}">
                </div>
                <div class="mb-2">
                    <label for="exampleInputPrice" class="form-label">販売価格(円)</label>
                    @error('price')
                    <div class="text-danger">
                    {{ $message }}
                    </div>
                    @enderror
                    <input type="price" class="form-control" id="exampleInputPrice" name="price" value="{{ $item['price'] }}">
                </div>
                <div class="text-center">
                    <button type="submit" class="mx-1 btn btn-primary">保存</button>
                </div>
            </form>
            <form action="/exe_delete/{{ $item['id'] }}" method="get" class="mt-1 text-center" onSubmit="return checkDelete()">
                @csrf
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <button type="submit" class="exe_delete mx-1 btn btn-outline-danger">削除</button>
            </form>
        </div>
    </div>
    <script>
        function checkDelete(){
            if(window.confirm('商品を削除しますか？')){
                return true;
            }else{
                return false;
            }
        }
    </script>

</x-app-layout>

