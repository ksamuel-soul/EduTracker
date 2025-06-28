<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Update Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar with Register Button -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Teacher Update Password</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Login Form -->
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Teacher Change Password</h2>
        <form id="up" method="POST">

            <div class="mb-3">
                <label for="student_password" class="form-label">Teacher Password</label>
                <input type="password" class="form-control" id="stu_pass" name="student_password" required>
            </div>

            <div class="mb-3">
                <label for="student_password_confirm" class="form-label">Teacher Password Confirm</label>
                <input type="password" class="form-control" id="stu_pass_con" name="student_password_Confirm" required>
            </div>

            <button type="submit" class="btn btn-primary w-100" id="submit" onclick="return upd_pass()">Change Password</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    const token = sessionStorage.getItem('token_tea');
    if(!token)
    {
        alert('Login First');
        window.location.href = "/api/login_tea";
    }
</script>

<script>
function upd_pass()
{
    const id = sessionStorage.getItem('tea_Id');
    const form = document.getElementById('up');
    form.addEventListener('submit', function(e){
        e.preventDefault();
        const data = {
            Password:document.getElementById('stu_pass').value,
            Password_confirmation:document.getElementById('stu_pass_con').value,
        };

        fetch(`http://127.0.0.1:8000/api/upd_tea_pass/${id}`, {
            method:"POST",
            headers:{"Content-type":"application/json"},
            body:JSON.stringify(data)
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                sessionStorage.clear();
                alert(data.Message);
                window.location.href = "/api/login_tea";
            }
            else if(data.Status == 404)
            {
                alert(data.Message);
            }
        })
    });
}
</script>
