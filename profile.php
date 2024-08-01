<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile Form</title>
  <style>
    body {
    font-family: 'Arial', 'Helvetica', sans-serif;
    background-color:  paleturquoise;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    color: #343a40;     
}

.form-container {
    margin: 0 20px;
}

form {
    background-color: pink;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 30px;
    width: 100%;
    max-width: 800px;
    box-sizing: border-box;
    margin-top: 20px;
    display: flex;
    gap: 20px;
    transition: all 0.3s ease-in-out;
}

.column-left,
.column-right {
    flex: 1;
}

label {
    display: block;
    margin-bottom: 8px;
    color: purple;
    font-weight: 600;
}

input,
select {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    box-sizing: border-box;
    border: 1px solid #ced4da;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s ease-in-out;
}

input:focus,
select:focus {
    border-color: #80bdff;
    outline: none;
}

button {
    background-color: purple;
    color: #fff;
    padding: 14px 25px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease-in-out;
}

button:hover {
    background-color: #0056b3;
}

img {
    max-width: 100%;
    height: auto;
    margin-bottom: 20px;
    border-radius: 5px;
}

@media (max-width: 768px) {
    form {
        flex-direction: column;
        padding: 20px;
    }

    .column-left,
    .column-right {
        padding: 50px;
    }
}

  </style>
</head>
<body>
  <div class="form-container">
    <form action="process_form.php" method="POST" enctype="multipart/form-data" id="profileForm">
      <div class="column-left">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="university">University:</label>
        <select name="university" id="university" required>
          <option value="" disabled selected>Select your university</option>
          <option value="University of Colombo">University of Colombo</option>
          <option value="Eastern University">Eastern University</option>
          <option value="University of Jaffna">University of Jaffna</option>
          <option value="University of Kelaniya">University of Kelaniya</option>
          <option value="University of Moratuwa">University of Moratuwa</option>
          <option value="Open University, Nawala">Open University, Nawala</option>
          <option value="University of Peradeniya">University of Peradeniya</option>
          <option value="Rajarata University">Rajarata University</option>
          <option value="University of Ruhuna">University of Ruhuna</option>
          <option value="Sabaragamuwa University">Sabaragamuwa University</option>
          <option value="South Eastern University">South Eastern University</option>
          <option value="University of Sri Jayewardenepura">University of Sri Jayewardenepura</option>
          <option value="Uva Wellassa University">Uva Wellassa University</option>
          <option value="University of the Visual and Performing Arts">University of the Visual and Performing Arts</option>
          <option value="Wayamba University">Wayamba University</option>
          <option value="Gampaha Wickramarachchi University">Gampaha Wickramarachchi University</option>
          <option value="University of Vavuniya">University of Vavuniya</option>
        </select>

        <label for="faculty">Faculty:</label>
        <input type="text" name="faculty" id="faculty" placeholder="Enter faculty name" required>
        
        <label for="age">Age:</label>
        <input type="number" name="age" id="age" required>

        <label for="mobileNumber">Mobile Number:</label>
        <input type="tel" name="mobileNumber" id="mobileNumber" placeholder="Enter mobile number" required minlength="10" maxlength="10" pattern="\d{10}" oninput="this.value=this.value.slice(0,10)">
       
        <label for="gpa">GPA:</label>
        <input type="number" name="gpa" id="gpa" placeholder="Enter your GPA" required min="0" max="4" step="0.01" pattern="^\d+(\.\d{1,2})?$">

        <label>Extracurricular Activity</label>
        <textarea id="activities" name="activities" rows="4" cols="50" placeholder="type extracurricular activities"></textarea>
 
        <label>Home Number</label>
        <input type="text" name="homeNumber" placeholder="Enter Home No" required>
        
        <label>Street Address</label>
        <input type="text" name="streetAddress" placeholder="Enter Street Address" required>
                        
        <label>City</label>
        <input type="text" name="city" placeholder="Enter City" required>

        <label>District Name</label>
        <input type="text" name="districtName" placeholder="Enter District Name" required>
                  
        <button type="submit">Submit</button>
      </div>

      

  <script>
    function displayProfilePic() {
      const input = document.getElementById('photo');
      const img = document.getElementById('profilePic');
      
      if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
          img.src = e.target.result;
          img.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>
</html>
