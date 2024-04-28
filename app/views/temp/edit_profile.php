<?php 
# Edit my php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JobEntry - Job Portal Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!--Libraries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9255a9b9ab.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    .btn {
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    transition: .5s;
    border: 2px solid #E3E3E3;
    background-color: white !important;
    color: black !important;
    text-align: left ;
    margin-bottom: 10px;
    }
    .btn:hover{
        background-color: #1A59B7 !important;
        color:white !important;
    }
    .text-primary{
      color: black !important;
      font-family: 'Poppins';
      font-weight: bold;
      font-size: 24;
    }
    h5 {
      font-size: 16;
      font-family: 'Poppins' !important;
    }
  </style>
  
    </head>

<body>
   



          
        
          <div id="main">
            <div class="flex-container">
          
                <div class="row">
                  <div class="col-lg-2">
                    <div class="btn-group-vertical">
                    <button type="button" class="btn btn-secondary" href="edit.html"><i class="bi fs-5 bi-pencil-square me-2"></i>Edit Your Profile</button>
                    <button type="button" class="btn btn-secondary" href="selfseeprf.html"><i class="bi fs-5 bi-file-earmark-person me-2"></i>Your Profile</button>
                    <button type="button" class="btn btn-secondary" href="applied company.html"><i class="fa-solid fs-5 fa-suitcase me-2"></i>My Applied Job</button>
                    <button type="button" class="btn btn-secondary" href="job-search.html"><i class="bi fs-5 bi-files me-2"></i>My CV</button>
                    
                  </div>
                  </div>
                <div class="col-lg-10">
                  <div class="flex-container">
                  
                <div class="card">
                  <div class="row m-3">
                  <div class="col-sm-13">
                      <h6 class="mb-2 ml-2" style="font-family:Poppins !important;">Upload avatar</h6>
                      </div>
                  <form action="/action_page.php" style="font-family:Poppins !important;">
                      <input type="file" id="myFile" name="filename">
                      <input type="submit">
                    </form>
                  </div>
                <div class="row m-3">
                <div class="col-sm-13">
                <h6 class="mb-2" style="font-family:Poppins !important;">Full Name</h6>
                </div>
                <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                <input type="text" class="form-control" value="Name">
                </div>
                </div>
                <div class="row m-3">
                <div class="col-sm-13">
                <h6 class="mb-2" style="font-family:Poppins !important;">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                <input type="text" class="form-control" value="@example.com">
                </div>
                </div>
                <div class="row m-3">
                <div class="col-sm-13">
                <h6 class="mb-2" style="font-family:Poppins !important;">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                <input type="text" class="form-control" value="(239) 816-9029">
                </div>
                </div>
                <div class="row m-3">
                <div class="col-sm-13">
                <h6 class="mb-2" style="font-family:Poppins !important;">Mobile</h6>
                </div>
                <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                <input type="text" class="form-control" value="(320) 380-4539">
                </div>
                </div>
                <div class="row m-3">
                <div class="col-sm-13">
                <h6 class="mb-2" style="font-family:Poppins !important;">Address</h6>
                </div>
                <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                <input type="text" class="form-control" value="VN">
                </div>
                </div>
                <div class="row m-3">
                  <div class="col-sm-13">
                  <h6 class="mb-2" style="font-family:Poppins !important;">Field</h6>
                  </div>
                  <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                  <input type="text" class="form-control" value="Computer Vision">
                  </div>
                  </div>
                  <div class="row m-3">
                    <div class="col-sm-13">
                    <h6 class="mb-2" style="font-family:Poppins !important;">Desired Location</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                    <input type="text" class="form-control" value="HCMUT">
                    </div>
                </div>
                <div class="row m-3">
                    <div class="col-sm-13">
                    <h6 class="mb-2" style="font-family:Poppins !important;">Expected Salary</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                    <input type="text" class="form-control" value="HCMUT">
                    </div>
                </div>
                  <div class="row m-3">
                    <div class="col-sm-13">
                    <h6 class="mb-2" style="font-family:Poppins !important;">Experience</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                    <input type="text" class="form-control" value="3 Years">
                    </div>
                </div>
                  <div class="row m-3">
                      <div class="col-sm-13">
                      <h6 class="mb-2" style="font-family:Poppins !important;">Skills</h6>
                      </div>
                      <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                      <input type="text" id="itemInput" class="form-control" placeholder="Write your Skills">
                      <br>
                      <button onclick="addItem('list1')">Add to Skills</button>
                      <ul class="m-2" id="list1"></ul>
                      </div>
                  </div>
                  <div class="row m-3">
                    <div class="col-sm-13">
                    <h6 class="mb-2" style="font-family:Poppins !important;">Career Goals</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                      <input type="text" class="form-control" value="Solution Architecture">
                      </div>
                </div>
                  <div class="row m-3">
                      <div class="col-sm-13">
                      <h6 class="mb-2" style="font-family:Poppins !important;">Education</h6>
                      </div>
                      <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                        <input type="text" class="form-control" value="PhD in Cambridge">
                        </div>
                  </div>
                  <div class="row m-3">
                    <div class="col-sm-13">
                    <h6 class="mb-2" style="font-family:Poppins !important;">Main Language</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" style="font-family:Poppins !important;">
                        <input type="text" class="form-control" value="8.0 IELTS">
                        </div>
                </div>
                  
                <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary" style="font-family:Poppins !important; align-items: center !important;" >
                <input type="button" class="btn btn-primary px-4" style="align-items: center !important;" value="Save Changes">
                </div>
                </div>
                
                </div> </div>
                <div class="row">
                <div class="col-sm-12">
                <div class="card">

                </div>
                </div>
                </div>
                </div>
                
              </div>
                
                
              </div>
          </div>
        

    </div>

    <script >
        // Function to add item to the list
// Function to add item to the list
function addItem(listId) {
  console.log("Adding item to list: " + listId); // Debugging log
  var input = document.getElementById('itemInput');
  var item = input.value.trim();

  if (item !== '') {
    var itemList = document.getElementById(listId);
    var li = document.createElement('li');
    li.textContent = item;

    var deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Delete';
    deleteBtn.onclick = function() {
      itemList.removeChild(li);
    };

    li.appendChild(document.createTextNode(' '));
    li.appendChild(deleteBtn);

    itemList.appendChild(li);
    input.value = '';
  } else {
    alert('Please enter a valid item.');
  }
}




    </script>
</body>

</html>