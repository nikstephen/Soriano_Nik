<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Student</title>
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
      font-size: 1.2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 50px;
    }

    h1 {
      font-size: 2.8rem;
      margin-bottom: 40px;
      color: #00fff5;
      text-shadow: 0 0 10px #00fff5, 0 0 20px #00bcd4;
      text-align: center;
    }

    form {
      background: #1f2a38;
      padding: 40px;
      border-radius: 18px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.6);
      max-width: 500px;
      width: 100%;
      text-align: center;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #00fff5;
      text-align: left;
    }

    input[type="text"], input[type="email"] {
      width: 100%;
      padding: 16px;
      margin-bottom: 24px;
      border-radius: 12px;
      border: none;
      background: #283747;
      color: #fff;
      font-size: 1.1rem;
      box-shadow: inset 0 0 10px rgba(0,0,0,0.5);
      transition: 0.3s;
    }

    input[type="text"]:focus, input[type="email"]:focus {
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

    .back-link {
      display: inline-block;
      width: 100%;
      padding: 18px 0; /* pataas at pababa */
      border-radius: 14px;
      background: linear-gradient(145deg, #393e46, #00bcd4);
      color: #fff;
      font-weight: 700;
      font-size: 1.2rem;
      text-decoration: none;
      text-align: center;
      transition: 0.3s;
    }

    .back-link:hover {
      transform: translateY(-3px) scale(1.05);
      box-shadow: 0 10px 20px rgba(0,0,0,0.6);
    }
  </style>
</head>
<body>

  <h1>Create Student</h1>

  <form method="post" action="/users/create">
    <label>First Name:</label>
    <input type="text" name="first_name" required>

    <label>Last Name:</label>
    <input type="text" name="last_name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <button type="submit">Save</button>
    <a href="/users" class="back-link">⬅ Back</a>
  </form>

</body>
</html>
