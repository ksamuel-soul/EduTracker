<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Update Teacher Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 25px;
            color: #0d6efd;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand">Update Teacher</span>
            <button type="button" class="btn btn-light" onclick="window.location.href = '/api/adm_home'">Admin Home</button>
        </div>
    </nav>

    <!-- Form Container -->
    <div class="container form-container">
        <h3 class="form-title">Update Teacher Details</h3>

        <form id="search" method="POST">
            <div class="mb-3">
                <label for="stuReg" class="form-label">Teacher Registartion Number</label>
                <input type="text" class="form-control" id="stuReg" placeholder="Enter Teacher RegNo." required>
            </div>
            <div class="d-grid">
                <button type="button" class="btn btn-primary" onclick="return search()">Search Details</button>
            </div>
        </form>

        <span id="search_form"> </span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    const admToken = sessionStorage.getItem('adm_Token');
    if(!admToken)
    {
        alert("Login First");
        window.location.href = "/api/adm_login";
    }
    function search()
    {
        const stuReg = document.getElementById('stuReg').value;
        fetch(`http://127.0.0.1:8000/api/tea_details/${stuReg}`, {
            method:"GET",
            headers:{"Content-type":"application/json"},
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 404)
            {
                alert(data.Message);
            }
            else if(data.Status == 200)
            {
                fetch(`http://127.0.0.1:8000/api/tea_details/${stuReg}`, {
                    method:"GET",
                    headers:{"Content-type":"application/json"}
                }).then(res=>res.json()).then(data=>{
                    // document.getElementById('stuBranch').value = data.User_Details.Stu_Branch;
                    document.getElementById('search_form').innerHTML = `
                        <form id="update_form" style="padding-top: 25px;">
                        <div class="mb-3">
                            <label for="stuName" class="form-label">Teacher Name</label>
                            <input type="text" class="form-control" id="stuName" placeholder="Enter Teacher name" value="${data.User_Details.Tea_Name}" required>
                        </div>

                        <div class="mb-3">
                            <label for="stuBranch" class="form-label">Branch</label>
                            <select class="form-select" id="stuBranch" required>
                                <option value="">Select Branch</option>
                                <option value="CSE">CSE</option>
                                <option value="ECE">ECE</option>
                                <option value="EEE">EEE</option>
                                <option value="MECH">MECH</option>
                                <option value="CIVIL">CIVIL</option>
                                <option value="IT">IT</option>
                                <option value="AIML">AIML</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="stuSection" class="form-label">Section</label>
                            <select class="form-select" id="stuSection" required>
                                <option value="">Select Section</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">I</option>
                                <option value="J">J</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="stuEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="stuEmail" placeholder="Enter Teacher email" value="${data.User_Details.Tea_Email}" required>
                        </div>

                        <div class="mb-3">
                            <label for="stuPhone" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" id="stuPhone" placeholder="Enter Phone No." value="${data.User_Details.Tea_Phone}" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" id="submit" onclick="return update(${stuReg})">Update Details</button>
                        </div>
                    </form>`;
                });
            }

        });
    }
</script>

<script>
    function update(stuReg)
    {
        const form = document.getElementById('update_form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const data = {
                Tea_Name: document.getElementById('stuName').value,
                Branch: document.getElementById('stuBranch').value,
                Tea_Email: document.getElementById('stuEmail').value,
                Tea_Phone: document.getElementById('stuPhone').value
            };
            // const stuReg = document.getElementById('stuReg').value;
            fetch(`http://127.0.0.1:8000/api/tea_update/${stuReg}`, {
                method: "POST",
                headers: {
                    "Content-type": "application/json"
                },
                body: JSON.stringify(data)
            }).then(res => res.json()).then(data => {
                if(data.Status == 200)
                {
                    alert(data.Message);
                    window.location.href = '/api/tea_update'
                }
                else if(data.Status == 404)
                {
                    alert(data.Message);
                }
            });
        });
    }
</script>