<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <div class="main-container">
        <div class="login-container">
            <form action="process/loginCheck.php" method="POST">
                <div class="text-center">
                    <h1>Imtiaz Login</h1>
                    <p>Hey, Enter your details to sign in to your account</p>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
                    <label for="floatingInput">Email</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">Sign in</button>
                <div class="text-center mt-3">
                    Don't have an account? <a href="MainRegister.html">Register Now</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>