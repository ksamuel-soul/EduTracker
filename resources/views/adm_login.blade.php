<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold">Admin Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="login-container">
        <h3 class="text-center mb-4">Admin Login</h3>
        <form id="log_form" method="POST">
            <div class="mb-3">
                <label for="adminEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="admEmail" placeholder="Enter admin email" required />
            </div>
            <div class="mb-3">
                <label for="adminPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="admPass" placeholder="Enter password" required />
            </div>
            <div class="d-grid">
                <button type="submit" id="submit" class="btn btn-primary" onclick="return login()">Login</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<script>
    function login() {
        const form = document.getElementById('log_form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const data = {
                Admin_Email: document.getElementById('admEmail').value,
                Admin_Password: document.getElementById('admPass').value,
            };

            fetch(`http://127.0.0.1:8000/api/adm_login`, {
                method: "POST",
                headers: {
                    "Content-type": "application/json"
                },
                body: JSON.stringify(data)
            }).then(res => res.json()).then(data => {
                if (data.Status == 200) {
                    // console.log(data.Message);
                    // console.log(data.Token);
                    sessionStorage.setItem('adm_Token', data.Token);
                    sessionStorage.setItem('adm_name', data.User_Details.Admin_Name);
                    window.location.href = "/api/adm_home";
                }
                else{
                    alert("Login Failed..!!!");
                }
            });
        });
    }
</script>