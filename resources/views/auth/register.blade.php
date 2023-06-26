<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body class="container">
    <h1 class="mb-5 text-center">Registration Page</h1>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="row m-auto">
        <div class="form-group mb-1">
            <label>Name:</label>
            <input type="text" name="name" class="form-control @error ('name') is-invalid error @enderror" placeholder="Enter your Name">
            @error('message')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group mb-1">
            <label>Email:</label>
            <input type="email" name="email" class="form-control @error ('email') is-invalid error @enderror" placeholder="Enter your Email">
            @error('message')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group mb-1">
            <label>Password:</label>
            <input type="password" name="password" class="form-control @error ('password') is-invalid error @enderror" placeholder="Enter your Password">
            @error('message')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group mb-1">
            <label >Confirm Password:</label>
            <input type="password" name="password_confirmation" class="form-control @error ('password') is-invalid error @enderror" placeholder="ReEnter your Password">
            @error('message')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <p>Already have an account?
            <a class="text-blue" href="{{ route('login') }}">Log in</a>
        </p>

        </div>
       
    </form>
</body>
</html>