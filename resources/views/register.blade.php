<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signin.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light p-3" style="background-color: #d3d3d3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Brand Cost Manager</a>
    </div>
    </nav>


    <main class="form-signin">
        
        <form>
            @csrf
            
            <h1 class="h3 mb-3 fw-normal text-center">新規登録</h1>
            <div class="form-floating">
                <input type="name" class="form-control" id="floatingInput" placeholder="UserName">
                <label for="floatingInput">ユーザー名</label>
            </div>
            <div class="form-floating mt-2">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">メールアドレス</label>
            </div>
            <div class="form-floating mt-2">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">パスワード</label>
            </div>

            <div class="checkbox mb-2 mt-2">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    <p class="h5">ブランドを登録する</p>
                </label>

            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">登録</button>

        </form>
    </main>
    
</body>
</html>