<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Marks Upload</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Marks Upload</a>
            <div class="ms-auto">
                <a href="/api/home_tea" class="btn btn-light text-primary">Teacher_Home</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-3">Upload Marks</h2>

        <form>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-auto">
                    <label for="section" class="col-form-label fw-bold">Section</label>
                </div>

                <div class="col-auto">
                    <select id="section" name="section" class="form-select" required>
                        <option value="" selected disabled>Select Section</option>
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

                <div class="col-auto">
                    <label for="Branch" class="col-form-label fw-bold">Branch</label>
                </div>

                <div class="col-auto">
                    <select class="form-select" id="Branch" name="Branch" required>
                        <option value="" selected disabled>Select Branch</option>
                        <option value="CSE">CSE</option>
                        <option value="Bio-Tech">Bio-Tech</option>
                        <option value="EEE">EEE</option>
                        <option value="ECE">ECE</option>
                        <option value="Bio-Info">Bio-Info</option>
                        <option value="Civil">Civil</option>
                        <option value="Mech">Mech</option>
                    </select>
                </div>


                <div class="col-auto">
                    <label for="exam_mode" class="col-form-label fw-bold">Exam Mode</label>
                </div>
                <div class="col-auto">
                    <select class="form-select" id="exam_mode" name="ex_mode" required>
                        <option value="" selected disabled>Select Exam</option>
                        <option value="t1">T1</option>
                        <option value="t2">T2</option>
                        <option value="t3">T3</option>
                        <option value="m1">M1</option>
                        <option value="m2">M2</option>
                    </select>
                </div>

                <div class="col-auto">
                    <button type="button" class="btn btn-primary" onclick="ent_mar()">Section</button>
                </div>
            </div>

            <span id="ent_marks">

            </span>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

<style>
    th{
        text-align: center;
    }
</style>

</html>

<script>
  const utoken = sessionStorage.getItem('token_tea');
  if(!utoken)
  {
    alert('First Login');
    window.location.href = "/api/login_tea";
  }
</script>

<script>
    function ent_mar() {
        const sec = document.getElementById('section').value;
        const bar = document.getElementById('Branch').value;
        const em = document.getElementById('exam_mode').value;
        if (sec === "" || bar === "" || em === "") {
            alert('Enter the details for searching..!!!');
            return;
        }
        fetch(`http://127.0.0.1:8000/api/stu_details_sec/${sec}/${bar}`, {
                method: "GET",
                headers: {
                    "Content-type": "application/json"
                }
            }).then(res => res.json())
            .then(data => {
                if (data.Status === 200) {
                    document.getElementById('ent_marks').innerHTML = `
                    <form id="marks_form" method="POST">
                            <table class="table table-bordered align-middle" id="marks_table">
                                 <thead class="table-secondary">
                                     <tr>
                                         <th scope="col">Id</th>
                                         <th scope="col">Name</th>
                                         <th scope="col"><span id="s1"> </span></th>
                                         <th scope="col">Physics</th>
                                         <th scope="col">Chemistry</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     
                                 </tbody>
                               </table>
                              <div class="d-flex justify-content-end">
                                  <button type="button" id="saveMarksBtn" class="btn btn-success">Save Marks</button>
                              </div>
                    </form>`;
                    if(bar == "Bio-Tech" || bar == "Bio-Info")
                    {
                        document.getElementById('s1').innerText = "Biology";
                    }
                    else
                    {
                        document.getElementById('s1').innerText = "Maths";
                    }
                    const tdata = document.querySelector('#marks_table tbody');
                    tdata.innerHTML = "";
                    data.User_Details.forEach((pro) => {
                        const row = `
                                     <tr data-student-id="${pro.id}" data-student-name="${pro.Stu_Name}">
                                         <td style='text-align:center;'>${pro.id}</td>
                                         <td style='text-align:center;'>${pro.Stu_Name}</td>     
                                         <td><input type="number" class="form-control maths-input" name="maths" placeholder="" min="0" max="10"></td>
                                         <td><input type="number" class="form-control physics-input" name="physics" placeholder="" min="0" max="10"></td>
                                         <td><input type="number" class="form-control chemistry-input" name="chemistry" placeholder="" min="0" max="10"></td>
                                     </tr>`;
                                     
                        tdata.innerHTML += row;
                    });

                    document.getElementById('saveMarksBtn').addEventListener('click', sub_marks);

                } else if (data.Status === 404) {
                    document.getElementById('ent_marks').innerHTML = `<h1 class="text-danger">${data.Message}</h1>`;
                } else if (data.Status === 204) {
                    alert(data.Message);
                }
            })
    }

    function sub_marks() {
        const seco = document.getElementById('section').value;
        const baro = document.getElementById('Branch').value;
        const em = document.getElementById('exam_mode').value;

        if (seco === "" || baro === "" || em === "") {
            alert('Please select Section, Branch, and Exam Mode before saving marks.');
            return;
        }

        const tableBody = document.querySelector('#marks_table tbody');
        const rows = tableBody.querySelectorAll('tr');
        let allInputsValid = true;

        const marksToUpload = [];
        rows.forEach((row) => {
            const studentId = row.dataset.studentId;
            const studentName = row.dataset.studentName;
            const maths = row.querySelector('.maths-input').value;
            const physics = row.querySelector('.physics-input').value;
            const chemistry = row.querySelector('.chemistry-input').value;

            if (maths === "" || physics === "" || chemistry === "") {
                alert(`Please enter valid numerical marks for all subjects for student ID: ${studentId}`);
                allInputsValid = false;
                return;
            }

            marksToUpload.push({
                id: studentId,
                Stu_Name: studentName,
                Stu_Branch: baro,
                Stu_Sec: seco,
                Exam_Mode: em,
                Maths: parseInt(maths),
                Physics: parseInt(physics),
                Chemistry: parseInt(chemistry)
            });
        });
        marksToUpload.forEach((studentMarks) => 
        {
            fetch(`http://127.0.0.1:8000/api/stu_marks_upl_${em}/${studentMarks.id}`, {
                    method: "POST",
                    headers: {
                        "Content-type": "application/json"
                    },
                    body: JSON.stringify(studentMarks)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.Status == 200) {
                        console.log(`Marks uploaded successfully for student ${studentMarks.id}: ${data.Message}`);
                        alert(data.Message);
                        window.location.href = "/api/home_tea";
                    } 
                    else if(data.Status == 409)
                    {
                        alert(data.Message);
                        window.location.href = "/api/home_tea";
                    }
                    else {
                        console.log(`Failed to upload marks for student ${studentMarks.id}: ${data.Message}`);
                        window.location.href = "/api/home_tea";
                    }
                })
        });
    }
</script>