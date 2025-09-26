<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
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
  margin-bottom: 40px;
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
input[type="password"] {
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
input[type="password"]:focus {
  outline: none;
  background: #1f2a38;
  box-shadow: inset 0 0 12px #00fff5;
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

.register-link {
  color: #00fff5;
  text-decoration: none;
  font-weight: 600;
  transition: 0.3s;
}

.register-link:hover {
  color: #81c784;
}
</style>
</head>
<body>
   <?php $this->call->view('partials/flash', ['success' => $success, 'error' => $error]); ?>
<br>
<form method="POST" action="/login">
    <h2>Login</h2>

  <label>Username or Email:</label>
  <input type="text" name="username_or_email">

  <label>Password:</label>
  <input type="password" name="password" >

  <button type="submit">Login</button>
  <p>Don't have an account? <a href="/register" class="register-link">Register here</a></p>
</form>

</body>
</html>
