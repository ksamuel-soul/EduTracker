<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Teacher Page</title>

    <!-- Bootstrap 5.0 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

</head>


<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold">Analysis Of Students Marks</a>

            <!-- Toggler for mobile -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarContent"
                aria-controls="navbarContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links + right-aligned button -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="/api/home_tea">Tea_Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page content -->
    <div class="container py-5">
                <div class="col-auto">
                    <label for="exam_mode" class="col-form-label fw-bold">Select Branch</label>
                </div>
                <div class="col-auto">
                    <select class="form-select" id="branch" name="branch" required>
                        <option value="" selected disabled>Select Branch</option>
                        <option value="CSE" href="#">CSE</option>
                        <option value="ECE" href="#">ECE</option>
                        <option value="EEE" href="#">EEE</option>
                        <option value="Bio-Tech" href="#">Bio-Tech</option>
                        <option value="Bio-Info" href="#">Bio-Info</option>
                    </select>
                </div>

                <div class="col-auto">
                    <label for="sec" class="col-form-label fw-bold">Select Section</label>
                </div>
                <div class="col-auto">
                    <select class="form-select" id="sec" name="section" required>
                        <option value="" selected disabled>Select Section</option>
                        <option value="A" href="#">A</option>
                        <option value="B" href="#">B</option>
                        <option value="C" href="#">C</option>
                        <option value="D" href="#">D</option>
                        <option value="E" href="#">E</option>
                    </select>
                </div>
                <center>
                <div class="col-auto" style="padding-top: 25px;">
                    <button type="button" class="btn btn-primary" onclick="view_marks()">Section</button>
                </div></center>
    </div>

    <style>
        .tab{
            width: 100%;
            /* border: 2px solid hotpink; */
            height: auto;
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            padding-bottom: 20px;
        }
        th
        {
            width: 12%;
            text-align: center;
            border: 2px solid black;
        }
            /* display: flex;
            justify-content: center; */
        td{
            text-align: center;
            border: 2px solid #9932CC;
        }
    </style>
    <div class="tab">
        <span id="marks_t1"></span>
        <span id="marks_t2"></span>
        <span id="marks_t3"></span>
        <span id="marks_m1"></span>
        <span id="marks_m2"></span>
    </div>
    <!-- Bootstrap 5.0 JS bundle (includes Popper) -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    ></script>
</body>
</html>

<script>
    const tt = sessionStorage.getItem('token_tea');
    if(!tt)
    {
        alert("Login_First");
        window.location.href = '/api/login_tea';
    }
</script>

<script>
    function view_marks()
    {
        const branch = document.getElementById('branch').value;
        const section = document.getElementById('sec').value;
        document.getElementById('marks_t1').innerHTML =
        `<div class="tab" id='t1'>
            <hr><center><h2>Marks of T1 Section:${section} & Branch:${branch} </h2></center>
            <table id="view_mark_t1">
                <thead>
                    <th>S_No.</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th><span id="bio"> </span></th>
                    <th>Physics</th>
                    <th>Chemistry</th>
                    <th>GPA</th>
                    <th>Grade</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <center>
            <div class="col-auto" style="padding-top: 25px;">
                <button type="button" class="btn btn-primary" onclick="return down_t1()">Download Pdf T1</button>
            </div>
        </center>
        `;

        document.getElementById('marks_t2').innerHTML =
        `<div class="tab" id='t2'>
            <hr><center><h2>Marks of T2 Section:${section} & Branch:${branch} </h2></center>
            <table id="view_mark_t2">
                <thead>
                    <th>S_No.</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th><span id="bio1"> </span></th>
                    <th>Physics</th>
                    <th>Chemistry</th>
                    <th>GPA</th>
                    <th>Grade</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <center>
            <div class="col-auto" style="padding-top: 25px;">
                <button type="button" class="btn btn-primary" onclick="down_t2()">Download Pdf T2</button>
            </div>
        </center>
        `;

        document.getElementById('marks_t3').innerHTML =
        `<div class="tab" id='t3'>
            <hr><center><h2>Marks of T3 Section:${section} & Branch:${branch} </h2></center>
            <table id="view_mark_t3">
                <thead>
                    <th>S_No.</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th><span id="bio2"> </span></th>
                    <th>Physics</th>
                    <th>Chemistry</th>
                    <th>GPA</th>
                    <th>Grade</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <center>
            <div class="col-auto" style="padding-top: 25px;">
                <button type="button" class="btn btn-primary" onclick="down_t3()">Download Pdf T3</button>
            </div>
        </center>
        `;

        document.getElementById('marks_m1').innerHTML =
        `<div class="tab" id='m1'>
            <hr><center><h2>Marks of M1 Section:${section} & Branch:${branch} </h2></center>
            <table id="view_mark_m1">
                <thead>
                    <th>S_No.</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th><span id="bio3"> </span></th>
                    <th>Physics</th>
                    <th>Chemistry</th>
                    <th>GPA</th>
                    <th>Grade</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <center>
            <div class="col-auto" style="padding-top: 25px;">
                <button type="button" class="btn btn-primary" onclick="down_m1()">Download Pdf M1</button>
            </div>
        </center>
        `;

        document.getElementById('marks_m2').innerHTML =
        `<div class="tab" id='m2'>
            <hr><center><h2>Marks of M2 Section:${section} & Branch:${branch} </h2></center>
            <table id="view_mark_m2">
                <thead>
                    <th>S_No.</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th><span id="bio4"> </span></th>
                    <th>Physics</th>
                    <th>Chemistry</th>
                    <th>GPA</th>
                    <th>Grade</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <center>
            <div class="col-auto" style="padding-top: 25px;">
                <button type="button" class="btn btn-primary" onclick="down_m2()">Download Pdf M2</button>
            </div>
        </center>
        
        `;

        if(branch == "Bio-Tech" || branch == "Bio-Info")
        {
            document.getElementById('bio').innerText = 'Biology';  
            document.getElementById('bio1').innerText = 'Biology';   
            document.getElementById('bio2').innerText = 'Biology';
            document.getElementById('bio3').innerText = 'Biology';
            document.getElementById('bio4').innerText = 'Biology';
        }
        else
        {
            document.getElementById('bio').innerText = 'Maths';
            document.getElementById('bio1').innerText = 'Maths';
            document.getElementById('bio2').innerText = 'Maths';
            document.getElementById('bio3').innerText = 'Maths';
            document.getElementById('bio4').innerText = 'Maths';
        }

        fetch(`http://127.0.0.1:8000/api/t1marks/${section}/${branch}`,{
            method:"GET",
            headers:{"Content-type":"application/json"}
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                const tdata = document.querySelector("#view_mark_t1 tbody");
                tdata.innerHTML = "";
                let sno = 1;
                data.User_Details.forEach(pro=> {
                    const s1 = parseInt(pro.Maths);
                    const s2 = parseInt(pro.Physics);
                    const s3 = parseInt(pro.Chemistry);
                    const gpa = (((s1 + s2 + s3)/100)*3)*10;
                    const x = [];
                    const ggg = (gpa<5) ? x.push('F') : x.push('P');
                    const row = `
                                <tr>
                                    <td>${sno}</td>
                                    <td>${pro.id}</td>
                                    <td>${pro.Stu_Name}</td>
                                    <td id="s1">${s1}</td>
                                    <td id="s2">${s2}</td>
                                    <td id="s3">${s3}</td>
                                    <td id="gpa">${gpa}</td>
                                    <td id="gpa">${x[0]}</td>
                                </tr>`;
                                sno += 1;
                        tdata.innerHTML += row;
                });
            }
            else 
            {
                alert(data.Message);
                const tdata = document.querySelector("#view_mark_t1 tbody");
                tdata.innerHTML = "";
                const row = `
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td id="s1">-</td>
                                <td id="s2">-</td>
                                <td id="s3">-</td>
                                <td id="gpa">-</td>
                            </tr>`;
            }
        });


        fetch(`http://127.0.0.1:8000/api/t2marks/${section}/${branch}`,{
            method:"GET",
            headers:{"Content-type":"application/json"}
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                const tdata = document.querySelector("#view_mark_t2 tbody");
                tdata.innerHTML = "";
                let sno = 1;
                data.User_Details.forEach(pro=> {
                    const s1 = parseInt(pro.Maths);
                    const s2 = parseInt(pro.Physics);
                    const s3 = parseInt(pro.Chemistry);
                    const gpa = (((s1 + s2 + s3)/100)*3)*10;
                    const x = [];
                    const ggg = (gpa<5) ? x.push('F') : x.push('P');
                    const row = `
                                <tr>
                                    <td>${sno}</td>
                                    <td>${pro.id}</td>
                                    <td>${pro.Stu_Name}</td>
                                    <td id="s1">${s1}</td>
                                    <td id="s2">${s2}</td>
                                    <td id="s3">${s3}</td>
                                    <td id="gpa">${gpa}</td>
                                    <td id="gpa">${x[0]}</td>
                                </tr>`;
                                sno += 1;
                        tdata.innerHTML += row;
                });
            }
        });

        fetch(`http://127.0.0.1:8000/api/t3marks/${section}/${branch}`,{
            method:"GET",
            headers:{"Content-type":"application/json"}
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                const tdata = document.querySelector("#view_mark_t3 tbody");
                tdata.innerHTML = "";
                let sno = 1;
                data.User_Details.forEach(pro=> {
                    const s1 = parseInt(pro.Maths);
                    const s2 = parseInt(pro.Physics);
                    const s3 = parseInt(pro.Chemistry);
                    const gpa = (((s1 + s2 + s3)/100)*3)*10;
                    const x = [];       
                    const ggg = (gpa<5) ? x.push('F') : x.push('P');        
                    const row = `
                                <tr>
                                    <td>${sno}</td>
                                    <td>${pro.id}</td>
                                    <td>${pro.Stu_Name}</td>
                                    <td id="s1">${s1}</td>
                                    <td id="s2">${s2}</td>
                                    <td id="s3">${s3}</td>
                                    <td id="gpa">${gpa}</td>
                                    <td id="gpa">${x[0]}</td>       
                                </tr>`;
                            sno += 1;
                        tdata.innerHTML += row;
                });
            }
        });

        fetch(`http://127.0.0.1:8000/api/m1marks/${section}/${branch}`,{
            method:"GET",
            headers:{"Content-type":"application/json"}
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                const tdata = document.querySelector("#view_mark_m1 tbody");
                tdata.innerHTML = "";
                let sno = 1;
                data.User_Details.forEach(pro=> {
                    const s1 = parseInt(pro.Maths);
                    const s2 = parseInt(pro.Physics);
                    const s3 = parseInt(pro.Chemistry);
                    const gpa = (((s1 + s2 + s3)/100)*3)*10;
                    const x = [];
                    const ggg = (gpa<5) ? x.push('F') : x.push('P');
                    const row = `
                                <tr>
                                    <td>${sno}</td>
                                    <td>${pro.id}</td>
                                    <td>${pro.Stu_Name}</td>
                                    <td id="s1">${s1}</td>
                                    <td id="s2">${s2}</td>
                                    <td id="s3">${s3}</td>
                                    <td id="gpa">${gpa}</td>
                                    <td id="gpa">${x[0]}</td>
                                </tr>`;
                            sno+=1;
                        tdata.innerHTML += row;
                });
            }
        });

        fetch(`http://127.0.0.1:8000/api/m2marks/${section}/${branch}`,{
            method:"GET",
            headers:{"Content-type":"application/json"}
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                const tdata = document.querySelector("#view_mark_m2 tbody");
                tdata.innerHTML = "";
                data.User_Details.forEach(pro=> {
                    const s1 = parseInt(pro.Maths);
                    const s2 = parseInt(pro.Physics);
                    const s3 = parseInt(pro.Chemistry);
                    const gpa = (((s1 + s2 + s3)/100)*3)*10;
                    const x = [];
                    let sno = 1;
                    const ggg = (gpa<5) ? x.push('F') : x.push('P');
                    const row = `
                                <tr>
                                    <td>${sno}</td>
                                    <td>${pro.id}</td>
                                    <td>${pro.Stu_Name}</td>
                                    <td id="s1">${s1}</td>
                                    <td id="s2">${s2}</td>
                                    <td id="s3">${s3}</td>
                                    <td id="gpa">${gpa}</td>
                                    <td id="gpa">${x[0]}</td>
                                </tr>`;
                                sno += 1;
                        tdata.innerHTML += row;
                });
            }
        });
    }
</script>

<script>
    function down_t1()
    {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        const branch = document.getElementById('branch').value;
        const section = document.getElementById('sec').value;
        doc.autoTable({
            html: '#view_mark_t1',
        });
        doc.save(`T1_Marks_of_${branch}_${section}.pdf`);
    }

    function down_t2()
    {
       const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        const branch = document.getElementById('branch').value;
        const section = document.getElementById('sec').value;
        doc.autoTable({
            html: '#view_mark_t2',
        });
        doc.save(`T2_Marks_of_${branch}_${section}.pdf`);
    }

    function down_t3()
    {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        const branch = document.getElementById('branch').value;
        const section = document.getElementById('sec').value;
        doc.autoTable({
            html: '#view_mark_t3',
        });
        doc.save(`T3_Marks_of_${branch}_${section}.pdf`);
    }

    function down_m1()
    {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        const branch = document.getElementById('branch').value;
        const section = document.getElementById('sec').value;
        doc.autoTable({
            html: '#view_mark_m1',
        });
        doc.save(`M1_Marks_of_${branch}_${section}.pdf`);
    }

    function down_m2()
    {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        const branch = document.getElementById('branch').value;
        const section = document.getElementById('sec').value;
        doc.autoTable({
            html: '#view_mark_m2',
        });
        doc.save(`M2_Marks_of_${branch}_${section}.pdf`);
    }
</script>