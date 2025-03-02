<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item ">
                    
                </li>
            </ul>
            </div>
            <nav>
                <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning ms-auto">Logout</button>
                </form>
             </nav>

            </div>
        </nav>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 offset-3">
                <div class="card">
                <h5 class="card-header">User Details</h5>
                    <div class="card-body">
                        <h6 class="card-title">Your user details are displayed here..</h6> 
                        @if($user)
                        <p class="card-text"><strong>ID:</strong> {{ $user->id }}</p>
                        <p class="card-text"><strong>Name:</strong> {{ $user->fullname }}</p>
                        <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                        @else
                            <p>User not found.</p>
                        @endif
                        <a href="{{ url('edit/' . $user->id) }}" class="btn btn-primary">Edit data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>