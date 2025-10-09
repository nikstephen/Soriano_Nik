<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
  color: #f5f5f5;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 50px;
}

h2 {
  font-size: 3rem;
  margin-bottom: 30px;
  color: #00fff5;
  text-shadow: 0 0 12px #00fff5, 0 0 25px #00bcd4;
  text-align: center;
}

form {
  background: #1f2a38;
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.6);
  width: 100%;
  max-width: 500px;
  text-align: center;
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: #00fff5;
  text-align: left;
}

input[type="text"],
input[type="email"],
input[type="password"],
select,
input[type="file"] {
  width: 100%;
  padding: 14px 16px;
  margin-bottom: 24px;
  border-radius: 12px;
  border: none;
  background: #283747;
  color: #fff;
  font-size: 1.1rem;
  box-shadow: inset 0 0 10px rgba(0,0,0,0.5);
  transition: 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
select:focus,
input[type="file"]:focus {
  outline: none;
  background: #1f2a38;
  box-shadow: inset 0 0 12px #00fff5;
}

select {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg fill='white' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 14px center;
  background-size: 24px;
  cursor: pointer;
}

input[type="file"]::file-selector-button {
  background: linear-gradient(145deg, #00bcd4, #00fff5);
  border: none;
  padding: 10px 16px;
  border-radius: 10px;
  color: #121212;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
}

input[type="file"]::file-selector-button:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

.profile-preview {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 20px;
  border: 4px solid #00fff5;
  box-shadow: 0 4px 12px rgba(0,0,0,0.5);
  display: none; /* initially hidden, optional JS can preview uploaded pic */
}

button[type="submit"] {
  width: 100%;
  padding: 18px;
  border-radius: 14px;
  border: none;
  background: linear-gradient(145deg, #4caf50, #81c784);
  color: #fff;
  font-weight: 700;
  font-size: 1.2rem;
  cursor: pointer;
  box-shadow: 0 6px 14px rgba(0,0,0,0.5);
  transition: 0.3s;
  margin-bottom: 20px;
}

button[type="submit"]:hover {
  transform: translateY(-3px) scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,0.6);
}

.login-link {
  color: #00fff5;
  text-decoration: none;
  font-weight: 600;
  transition: 0.3s;
}

.login-link:hover {
  color: #81c784;
}
</style>
</head>
<body>
 <?php $this->call->view('partials/flash', ['success' => $success, 'error' => $error]); ?>
<br>
<h2>Register</h2>
    
<form method="POST" action="/register" enctype="multipart/form-data">
  
  
  <label>Email:</label>
  <input type="email" name="email">

  <label>Username:</label>
  <input type="text" name="username">

  <label>Password:</label>
  <input type="password" name="password" >

  <label>Role:</label>
  <select name="role">
      <option value="student">Student</option>
      <option value="admin">Admin</option>
  </select>
  <label> Upload Image</label>
  <input type="file" name="profile_picture" accept="image/*">
  <img src="#" alt="Profile Preview" class="profile-preview">

  <button type="submit">Register</button>
  <p>Already have an account? <a href="/login" class="login-link">Login here</a></p>
</form>

</body>
</html>
