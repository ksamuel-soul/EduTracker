<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar with Register Button -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Student Login</a>
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
        <h2 class="mb-4 text-center">Student Login</h2>
        <form id="login-form" method="POST">
            <div class="mb-3">
                <label for="student_email" class="form-label">Student Email</label>
                <input type="email" class="form-control" id="stu_email" name="student_email" required>
            </div>

            <div class="mb-3">
                <label for="student_password" class="form-label">Student Password</label>
                <input type="password" class="form-control" id="stu_pass" name="student_password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100" id="submit" onclick="return login()">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<script>
    function login() {
        const form = document.getElementById('login-form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const data = {
                Stu_Email: document.getElementById('stu_email').value,
                Stu_Password: document.getElementById('stu_pass').value
            };
            fetch(`http://127.0.0.1:8000/api/login_stu`, {
                method: "POST",
                headers: {
                    "Content-type": "application/json"
                },
                body: JSON.stringify(data)
            }).then(res => res.json()).then(data => {
                if (data.Status == 200) {
                    // alert(data.Message);
                    // console.log(data.Token);
                    sessionStorage.setItem('token', data.Token);
                    sessionStorage.setItem('uname', data.post.Stu_Name);
                    sessionStorage.setItem('Id', data.post.id);
                    sessionStorage.setItem('section', data.post.Stu_Sec);
                    sessionStorage.setItem('branch', data.post.Stu_Branch);
                    window.location.href = "/api/home_stu";
                }
                else if(data.Status == 404)
                {
                  alert(data.Message);
                  window.location.href = "/api/login_stu";
                }
            });
        });
    }
</script>
