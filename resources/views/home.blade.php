<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   
    <!-- Rest of your code... -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body class="container">
    <header>
    @if (Route::has('login'))
        @if(!is_null(Auth::user()->email_verified_at))
            <div class="mt-2 d-flex justify-content-end align-items-center gap-3">
                <h5>User: {{Auth::user()->name}} </h5>
                <a href="{{ url('logout') }}" class="bg-danger btn text-white border-0 p-2 ">Logout</a>
            </div>
        @endif
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @if (is_null(Auth::user()->email_verified_at))
    <div class="alert alert-warning">
        メールアドレスは認証されていません。 受信箱に確認リンクがあるかどうかを確認してください。

        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">確認リンクを再送信する</button>.
        </form>
    </div>
    @endif

    </header>
    <main>
        <h1 class="text-center">This is home page</h1>
        <section class="mt-3 border border-primary-subtle rounded">
            <form action="{{ route('post.store') }}" method="post" >
                @csrf 
                <div class="row m-auto">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid error @enderror"  placeholder="タイトルを書いてください">
                        @error('message')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Message:</label>
                        <textarea name="message" id="message" cols="100" rows="5" class="form-control @error('message') is-invalid error @enderror"  placeholder="メッセージを書いてください"></textarea>
                        @error('message')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2 text-center">送信</button>
                </div>
                
            </form>
           
        </section>
        <section class="h-100 border border-2 mt-3">
            @if(session()->has('success'))
                <div id="success-alert" class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <p class="text-center">BBSリスト</p>
            @foreach($posts as $post)
                <div class="ms-2">  
                    <h3 class="m-0">{{ $post->title }}</h3>
                    <p>{{ $post->message }}</p>
                    
                </div>
            @endforeach
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        setTimeout(function() => {
            $('#success-alert').fadeOut('fast')
        }, 3000);
    </script>
</body>
</html>