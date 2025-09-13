<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Students List</title>
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
      padding: 50px;
      min-height: 100vh;
      font-size: 1.3rem;
    }

    h2 {
      font-size: 3rem;
      margin-bottom: 35px;
      color: #00fff5;
      text-shadow: 0 0 12px #00fff5, 0 0 25px #00bcd4;
    }

    /* Navbar */
    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }

    /* Left heading */
    .navbar h2 {
      font-size: 2rem;
      color: #00fff5;
      text-shadow: 0 0 8px #00fff5, 0 0 15px #00bcd4;
    }

    /* Center tabs + create button */
    .nav-center {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
      flex: 1;
    }

    .tab, .create-btn {
      padding: 16px 32px;
      border-radius: 14px;
      font-weight: 700;
      font-size: 1.2rem;
      text-decoration: none;
      transition: 0.3s;
    }

    .tab {
      background: linear-gradient(145deg, #393e46, #00bcd4);
      color: #fff;
    }

    .tab:hover {
      transform: translateY(-3px) scale(1.05);
      box-shadow: 0 6px 12px rgba(0,0,0,0.4);
    }

    .tab.active {
      background: linear-gradient(145deg, #00bcd4, #00fff5);
      color: #121212;
    }

    .create-btn {
      background: linear-gradient(145deg, #4caf50, #81c784);
      color: #fff;
    }

    .create-btn:hover {
      transform: translateY(-3px) scale(1.05);
      box-shadow: 0 6px 12px rgba(0,0,0,0.4);
    }

    /* Right side Search form */
    .search-form {
      display: flex;
      gap: 16px;
      max-width: 550px;
    }

    .search-form input[type="text"] {
      flex: 1;
      padding: 16px 24px;
      border-radius: 12px;
      border: none;
      background: #1f2a38;
      color: #fff;
      font-size: 1.2rem;
      min-width: 200px;
    }

    .search-form button {
      padding: 16px 36px;
      border-radius: 12px;
      border: none;
      background: linear-gradient(145deg, #00bcd4, #00fff5);
      color: #121212;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    .search-form button:hover {
      transform: translateY(-2px) scale(1.05);
      box-shadow: 0 6px 12px rgba(0,0,0,0.4);
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 10px 22px rgba(0,0,0,0.6);
      font-size: 1.3rem;
    }

    thead {
      background: linear-gradient(135deg, #00bcd4, #00fff5);
      color: #121212;
      font-weight: 700;
      font-size: 1.3rem;
    }

    th, td {
      padding: 24px;
      text-align: left;
      border-bottom: 1px solid #333;
      transition: 0.3s;
    }

    tr:hover td {
      background: rgba(255,255,255,0.08);
      transform: scale(1.02);
    }

    /* Action Buttons */
    .action-btn {
      display: inline-block;
      padding: 18px 26px;
      margin: 6px;
      border-radius: 14px;
      text-decoration: none;
      font-size: 1.2rem;
      font-weight: 700;
      transition: 0.3s;
      box-shadow: 0 5px 12px rgba(0,0,0,0.5);
    }

    .edit-btn { background: linear-gradient(145deg, #00bcd4, #00fff5); color: #121212; }
    .edit-btn:hover { transform: translateY(-3px) scale(1.08); box-shadow: 0 8px 16px rgba(0,0,0,0.6); }

    .delete-btn { background: linear-gradient(145deg, #e63946, #ff6f61); color: #fff; }
    .delete-btn:hover { transform: translateY(-3px) scale(1.08); box-shadow: 0 8px 16px rgba(0,0,0,0.6); }

    .restore-btn { background: linear-gradient(145deg, #4caf50, #81c784); color: #121212; }
    .restore-btn:hover { transform: translateY(-3px) scale(1.08); box-shadow: 0 8px 16px rgba(0,0,0,0.6); }

    .hard-delete-btn { background: linear-gradient(145deg, #ff6f00, #ffa000); color: #121212; }
    .hard-delete-btn:hover { transform: translateY(-3px) scale(1.08); box-shadow: 0 8px 16px rgba(0,0,0,0.6); }

    /* Pagination */
   .pagination {
       margin-top: 40px;
       display: flex;
       gap: 16px;
       flex-wrap: wrap;
       justify-content: center; /* <- idinagdag para i-center */
  }


    .pagination-list {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;

    }
    .pagination-item {
        margin: 0;
    }
    
    
    .pagination a {
      padding: 16px 22px;
      border-radius: 12px;
      background: linear-gradient(145deg, #393e46, #00bcd4);
      color: #fff;
      text-decoration: none;
      transition: 0.3s;
      font-size: 1.2rem;
      box-shadow: 0 5px 12px rgba(0,0,0,0.5);
      align-items: center;
    }

    .pagination a:hover {
      transform: translateY(-3px) scale(1.08);
      background: linear-gradient(145deg, #00bcd4, #00fff5);
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <h2>Active Students</h2>

    <div class="nav-center">
      <a href="/users/get-all" class="tab <?= !$show_deleted ? 'active' : '' ?>">All Records</a>
      <a href="/users/get-all?show=deleted" class="tab <?= $show_deleted ? 'active' : '' ?>">Archives</a>
      <a href="/users/create" class="create-btn">➕ Create</a>
    </div>

    <!-- Search form sa right -->
    <form class="search-form" method="get" action="/users/get-all">
      <?php if ($show_deleted): ?>
        <input type="hidden" name="show" value="deleted">
      <?php endif; ?>
      <input type="text" name="search" value="<?= $search ?? '' ?>" placeholder="Search...">
      <button type="submit">Search</button>
    </form>
  </div>

  <table>
    <thead>
      <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($records as $r): ?>
      <tr>
        <td><?= $r['id'] ?></td>
        <td><?= $r['first_name'] ?></td>
        <td><?= $r['last_name'] ?></td>
        <td><?= $r['email'] ?></td>
        <td>
          <?php if ($show_deleted): ?>
            <a href="/users/restore/<?= $r['id'] ?>" class="action-btn restore-btn">♻ Restore</a>
            <a href="/users/hard_delete/<?= $r['id'] ?>" class="action-btn hard-delete-btn" onclick="return confirm('Hard delete permanently?')">⚠ Permanently Delete</a>
          <?php else: ?>
            <a href="/users/update/<?= $r['id'] ?>" class="action-btn edit-btn">✏ Edit</a>
            <a href="/users/delete/<?= $r['id'] ?>" class="action-btn delete-btn" onclick="return confirm('Archive this student?')">🗑 Archive</a>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="pagination">
    <?= $pagination_links ?>
  </div>

</body>
</html>
