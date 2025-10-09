<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Profile</title>
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
  padding: 50px;
  display: flex;
  justify-content: center;
}

.container {
  max-width: 1000px;
  width: 100%;
}

/* Profile Header */
.profile-header {
  display: flex;
  align-items: center;
  margin-bottom: 30px;
  background: #1f2a38;
  padding: 20px;
  border-radius: 20px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.6);
}

.profile-avatar {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  border: 4px solid #00fff5;
  margin-right: 25px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.5);
}

.profile-info h2 {
  font-size: 2rem;
  color: #00fff5;
  text-shadow: 0 0 12px #00fff5, 0 0 25px #00bcd4;
  margin-bottom: 10px;
}

.profile-info p {
  font-size: 1.1rem;
  margin-bottom: 5px;
}

.logout-link {
  display: inline-block;
  margin-top: 15px;
  padding: 10px 20px;
  border-radius: 12px;
  background: linear-gradient(145deg, #e63946, #ff6f61);
  color: #fff;
  font-weight: 600;
  text-decoration: none;
  transition: 0.3s;
}

.logout-link:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 6px 14px rgba(0,0,0,0.5);
}

/* Grades Table */
.grades-card {
  background: #1f2a38;
  border-radius: 20px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.6);
  padding: 25px;
  margin-top: 30px;
}

.grades-card h3 {
  margin-bottom: 20px;
  color: #00fff5;
  font-size: 1.8rem;
  text-align: center;
  text-shadow: 0 0 10px #00fff5;
}

table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0,0,0,0.5);
}

table thead {
  background: linear-gradient(145deg, #00bcd4, #00fff5);
}

table th, table td {
  padding: 14px 20px;
  text-align: left;
}

table th {
  color: #121212;
  font-weight: 700;
  text-shadow: none;
}

table tbody tr:nth-child(even) {
  background: #283747;
}

table tbody tr:nth-child(odd) {
  background: #2c3e50;
}

table tbody tr:hover {
  background: #00bcd4;
  color: #121212;
  cursor: pointer;
  transition: 0.3s;
}

.grade-input {
  width: 60px;
  padding: 6px 8px;
  border-radius: 8px;
  border: none;
  background: #34495e;
  color: #fff;
  text-align: center;
  font-weight: 600;
}

.grade-input:focus {
  outline: none;
  background: #1f2a38;
  box-shadow: 0 0 10px #00fff5 inset;
}
</style>
</head>
<body>
    
<div class="container">
    <!-- Profile Header -->
     <center><?php $this->call->view('partials/flash', ['success' => $success, 'error' => $error]); ?></center> 
    <div class="profile-header">
        <img src="/LavaLustko/app/public/uploads/profile_pictures/<?= htmlspecialchars($user['profile_picture'] ?? 'default-avatar.png') ?>" 
            alt="Profile Picture" class="profile-avatar">
        <div class="profile-info">
            <h2><?= htmlspecialchars($user['username'] ?? 'Student') ?></h2>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? '-') ?></p>
            <p><strong>Role:</strong> <?= htmlspecialchars($user['role'] ?? '-') ?></p>
            <a href="/logout" class="logout-link">Logout</a>
        </div>
    </div>

    <!-- Grades Table -->
    <div class="grades-card">
        <h3>My Subjects & Grades</h3>
        <form method="POST" action="/save-grades">
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Default subjects & grades if $grades is empty
                $default_subjects = [
                    ['subject' => 'Web Development', 'grade' => '95'],
                    ['subject' => 'Database Management Systems', 'grade' => '92'],
                    ['subject' => 'Networking', 'grade' => '90'],
                    ['subject' => 'Software Engineering', 'grade' => '94'],
                    ['subject' => 'Cybersecurity', 'grade' => '93'],
                    ['subject' => 'Mobile App Development', 'grade' => '91'],
                    ['subject' => 'Cloud Computing', 'grade' => '89'],
                    ['subject' => 'IT Project Management', 'grade' => '92'],
                    ['subject' => 'Computer Architecture', 'grade' => '90'],
                    ['subject' => 'Data Analytics', 'grade' => '94'],
                ];

                $grades_to_display = (isset($grades) && count($grades) > 0) ? $grades : $default_subjects;

                foreach($grades_to_display as $grade): ?>
                    <tr>
                        <td><?= htmlspecialchars($grade['subject'] ?? '-') ?></td>
                        <td><input type="text" name="grades[<?= strtolower(str_replace(' ', '_', $grade['subject'])) ?>]" 
                                   value="<?= htmlspecialchars($grade['grade'] ?? '-') ?>" class="grade-input"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </form>
    </div>
</div>

</body>
</html>
