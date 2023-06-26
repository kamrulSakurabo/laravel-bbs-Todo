<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body class="container">
    <h1 class="text-center mb-3">Login Page</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf 
        <div class="row m-auto">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control @error ('email') is-invalid error @enderror" placeholder="Enter your Email">
                @error('message')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control @error ('password') is-invalid error @enderror" placeholder="Enter your password">
                @error('message')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Log in</button>
            <p>Don't have an account yet ?
                <a class="text-blue" href="{{ route('register') }}">Register</a>
            </p>
           
        </div>
    </form>
</body>
</html>