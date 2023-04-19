<x-app-layout>
    <style>
        .link-item:hover{
            opacity: 0.5;
        }
    </style>
    <div class="m-2">
        <a href="/manage_home" style="width:25px; height:25px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle-fill text-secondary link-item" viewBox="0 0 16 16" style="display:inline;">
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg>
        </a>
    </div>
    <div class="container mt-2">
        <p class="h6" style="color:#696969;">< 管理者としてログインしています ></p>
    </div>
    <div class="container my-3">
        <h4>ユーザー一覧</h4>
        <p class="h6" style="color:#696969;">権限は1.管理者、2.一般ユーザーです</p>
        <div class="row rounded border text-center bg-light" style="background-color: d3d3d3;">
            <div class="col border-end pt-2" style="background-color: #f5f5f5;">
                <h5>ID</h5>
            </div>
            <div class="col border-end pt-2" style="background-color: #f5f5f5;">
                <h5>ユーザー名</h5>
            </div>
            <div class="col border-end pt-2" style="background-color: #f5f5f5;">
                <h5>メールアドレス</h5>
            </div>
            <div class="col border-end pt-2" style="background-color: #f5f5f5;">
                <h5>権限</h5>
            </div>
            <div class="col border-end pt-2" style="background-color: #f5f5f5;">
                <h5>ブランド名</h5>
            </div>
            <div class="col pt-2" style="max-width:100px; background-color: #f5f5f5;">
                <h5>削除</h5>
            </div>
        </div>
            @foreach($users as $user)
           
        <div class="row rounded border text-center" style="background-color: white;">
            <div class="col border-end pt-2">
                <h5>{{ $user['id'] }}</h5>
            </div>
            <div class="col border-end pt-2">
                <h5>{{ $user['name'] }}</h5>
            </div>
            <div class="col border-end pt-2">
                <h5>{{ $user['email'] }}</h5>
            </div>                
            <div class="col border-end pt-2">
                <h5>{{ $user['role'] }}</h5>
            </div>
            <div class="col border-end pt-2">
                <h5>{{ $user['brand_name'] }}</h5>
            </div>
            <form action="/manage_delete_user/{{ $user['id'] }}" method="get" class="col" style="max-width:100px;" onSubmit="return checkDelete()">
            @csrf
                <input type="hidden" name="id" value="{{ $user['id'] }}">
                <button type="submit" class="btn btn-outline-danger">削除</button>
            </form>
        </div>
            @endforeach
    </div>
    <script>
        function checkDelete(){
            if(window.confirm('ユーザーを削除しますか？')){
                return true;
            }else{
                return false;
            }
        }
    </script>
</x-app-layout>