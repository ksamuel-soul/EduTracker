<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Attendance</title>
    <!-- Bootstrap 5.0 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Attendance System</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="/api/home_tea">Teacher Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mt-5">
        <h3 class="mb-4">Mark Student Attendance</h3>

        <!-- Section Selection -->
        <form>
            <div class="mb-3">
                <label for="sectionSelect" class="form-label">Select Section</label>
                <select class="form-select" id="sectionSelect">
                    <option value="">-- Choose Section --</option>
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
                <label for="branchSelect" class="form-label">Select Branch</label>
                <select class="form-select" id="branchSelect">
                    <option value="">-- Choose Branch --</option>
                    <option value="CSE">Computer Science and Engineering</option>
                    <option value="ECE">Electronics and Communication Engineering</option>
                    <option value="EEE">Electrical and Electronics Engineering</option>
                    <option value="ME">Mechanical Engineering</option>
                    <option value="CE">Civil Engineering</option>
                    <option value="IT">Information Technology</option>
                    <option value="AE">Aerospace Engineering</option>
                    <option value="Bio-Tech">Bio-Technology</option>
                    <option value="Bio-Info">Bio-Informatics</option>
                    <option value="MT">Metallurgical Engineering</option>
                </select>
            </div>

            <!-- You can add student list or attendance checkboxes here later -->
    <center>
            <button type="button" id="submit" onclick="return sub_stu_att()" class="btn btn-primary">Check_Section</button>
    </center>
        </form>
    </div>
    <span id="stu_det">
    </span>

    <!-- Bootstrap 5.0 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<style>
    th{
        text-align: center;
        border:2px solid green;
    }
    td{
        text-align: center;
        border:2px solid red;
    }
    .table{
        padding-top: 35px;
        padding-bottom: 20px;
    }
</style>
<script>
    function sub_stu_att()
    {
        const sec = document.getElementById('sectionSelect').value;
        const branch = document.getElementById('branchSelect').value;
        document.getElementById('stu_det').innerHTML = `
        <div class="table">

        <center>
            <table id="stu_att" style="width:80%; padding-top:15px;">
                <thead style="padding:20px;">
                    <th>Stu_Id</th>
                    <th>Stu_Name</th>
                    <th>Check</th>
                </thead>
                <tbody>

                </tbody>
            </center>
            </table>
            <button type="button" id="submit" onclick="return submit_att()" class="btn btn-primary sub_att">Submit Attendance</button>
        </div>`;
        fetch(`http://127.0.0.1:8000/api/stu_details_sec/${sec}/${branch}`,{
            method: "GET",
            headers: {"Content-type": "application/json"}
        }).then((res) => res.json()).then((data) => {
            if(data.Status == 200)
            {
                // alert(data.Message);
                // console.log(data.User_Details);
                const tdata = document.querySelector("#stu_att tbody");
                tdata.innerHTML = "";
                data.User_Details.forEach((pro) => {
                    const row = `
                                    <tr>
                                    <td>${pro.id}</td>
                                    <td>${pro.Stu_Name}</td>
                                    <td><input type='checkbox' class='att-box' data-name='${pro.Stu_Name}' data-id='${pro.id}'></td>
                                    </tr>`;
                    tdata.innerHTML += row;
                });
            }
            else if(data.Status == 404){
                document.getElementById('stu_det').innerHTML = `<center><h3 style='padding-top:35px;'>${data.Message}</h3></center>`;
            }
        });
    }
</script>


<script>
    function submit_att()
    {
        const chkbox = document.querySelectorAll('.att-box');
        const section = document.getElementById('sectionSelect').value;
        const branch = document.getElementById('branchSelect').value;
        // alert(branch);
        chkbox.forEach(box =>{
            const stu_name = box.getAttribute('data-name');
            const stu_id = box.getAttribute('data-id');
            const status = box.checked?"Present":"Absent";
            // alert(stu_name + "\n" + stu_id + "\n" + status);
            fetch(`http://127.0.0.1:8000/api/sub_stu_att/${stu_id}`, {
                method:"POST",
                headers:{"Content-type":"application/json"},
                body:JSON.stringify({
                    id:stu_id,
                    Stu_Name:stu_name,
                    Stu_Branch:branch,
                    Stu_Sec:section,
                    Status:status
                })
            }).then(res=>res.json()).then(data=>{
                if(data.Status == 200)
                {
                    alert(data.Message);
                    console.log(data.Message);
                    window.location.href = '/api/home_tea';
                }
                else if(data.Status == 404)
                {
                    alert(data.Message);
                    console.log(data.Message);
                    window.location.href = '/api/home_tea';
                }
            });
        });
    }
</script>