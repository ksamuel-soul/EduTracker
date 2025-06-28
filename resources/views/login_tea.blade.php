<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar with Register Button -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Teacher Login</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right aligned Home button -->
        <div class="d-flex ms-auto">
            <a href="/" class="btn btn-light" id="btncall">Home</a>
        </div>
    </div>
</nav>

    <!-- Login Form -->
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Teacher Login</h2>
        <form id="login_form" method="POST">
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100" id="submit" onclick="return login()">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    function login() {
        const form = document.getElementById('login_form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const data = {
                Tea_Email: document.getElementById('email').value,
                Password: document.getElementById('pass').value
            };

            fetch(`http://127.0.0.1:8000/api/login_tea`, {
                method: "POST",
                headers: {
                    "Content-type": "application/json"
                },
                body: JSON.stringify(data),
            }).then(res => res.json()).then(data => {
                if (data.Status == 200) {
                    // alert(data.Message);
                    sessionStorage.setItem('token_tea', data.Token);
                    sessionStorage.setItem('tea_name', data.details.Tea_Name);
                    sessionStorage.setItem('tea_Id', data.details.id);
                    window.location.href = "/api/home_tea";
                }
                else if(data.Status == 404)
                {
                  alert(data.Message);
                  window.location.href = "/api/login_tea";
                }
            });
        });
    }
</script>
