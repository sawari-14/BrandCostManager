<x-app-layout>
    <style>
        .link-item:hover{
            opacity: 0.5;
        }
    </style>
    <div class="m-2">
        <a href="{{ route('manage_items') }}" style="width:25px; height:25px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle-fill text-secondary link-item" viewBox="0 0 16 16" style="display:inline;">
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg>
        </a>
    </div>
    <div class="container mt-2">
        <p class="h6" style="color:#696969;">< 管理者としてログインしています ></p>
    </div>
    <div class="container">
        <div class="container border rounded py-3 px-4" style="max-width: 350px;">

                <div class="mb-3 text-center">
                <img src="{{ '/storage/' . $item['image'] }}" class="card-img-top" alt="...">
                </div>
                <div class="mb-3">
                    <h5 class="h5" style="color:#696969;">商品名</h5>
                    <h4 class="h4">{{ $item['name'] }}</h4>
                </div>
                <div class="mb-3">
                    <h5 class="h5" style="color:#696969;">金額</h5>
                   <h4 class="h4">￥{{ $item['price'] }}</h4>
                </div>
        </div>
    </div>

</x-app-layout>