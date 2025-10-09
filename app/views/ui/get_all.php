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
      font-size: 1.2rem;
    }

    h2 {
      font-size: 2.5rem;
      color: #00fff5;
      text-shadow: 0 0 12px #00fff5, 0 0 25px #00bcd4;
      margin-bottom: 30px;
    }

    /* Navbar */
    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }

    .nav-left h2 {
      font-size: 3.5rem;
    }

    .nav-center {
      display: flex;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .tab, .create-btn, .logout-btn {
      padding: 10px 20px;
      border-radius: 10px;
      font-weight: 600;
      text-decoration: none;
      font-size: 1rem;
      transition: 0.3s;
      display: inline-block;
    }

    .tab {
      background: linear-gradient(145deg, #393e46, #00bcd4);
      color: #fff;
    }

    .tab.active {
      background: linear-gradient(145deg, #00bcd4, #00fff5);
      color: #121212;
    }

    .tab:hover {
      transform: translateY(-2px) scale(1.05);
      box-shadow: 0 6px 12px rgba(0,0,0,0.3);
    }

    .create-btn {
      background: linear-gradient(145deg, #4caf50, #81c784);
      color: #fff;
    }

    .create-btn:hover {
      transform: translateY(-2px) scale(1.05);
      box-shadow: 0 6px 12px rgba(0,0,0,0.3);
    }

    .logout-btn {
      background: linear-gradient(145deg, #e63946, #ff6f61);
      color: #fff;
      margin-left: 10px;
    }

    .logout-btn:hover {
      transform: translateY(-2px) scale(1.05);
      box-shadow: 0 6px 12px rgba(0,0,0,0.3);
    }

    /* Search form */
      .search-form {
    display: flex;
    gap: 10px;
    margin-top: 15px;
    justify-content: flex-end; /* This aligns the search form to the right */
    max-width: 100%;
      }


    .search-form input[type="text"] {
    flex: 1;
    max-width: 500px; /* adjust width as needed */
    padding: 10px 14px;
    border-radius: 8px;
    border: none;
    background: #1f2a38;
    color: #fff;
    font-size: 1rem;
}



    .search-form button {
      padding: 10px 18px;
      border-radius: 8px;
      border: none;
      background: linear-gradient(145deg, #00bcd4, #00fff5);
      color: #121212;
      font-weight: 600;
      cursor: pointer;
    }

    .search-form button:hover {
      transform: translateY(-1px) scale(1.03);
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 6px 16px rgba(0,0,0,0.4);
      font-size: 1.1rem;
      background-color: #1f2a38;
    }

    thead {
      background: linear-gradient(135deg, #00bcd4, #00fff5);
      color: #121212;
      font-weight: 700;
    }

    th, td {
      padding: 14px 18px;
      text-align: center;
      border-bottom: 1px solid rgba(255,255,255,0.1);
      vertical-align: middle;
    }

    tr:hover td {
      background: rgba(255,255,255,0.07);
    }

    td img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 2px 6px rgba(0,0,0,0.4);
      transition: transform 0.3s;
    }

    td img:hover {
      transform: scale(1.1);
    }

    /* Action Buttons */
    .action-btn {
      display: inline-block;
      padding: 8px 14px;
      margin: 2px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 600;
      transition: 0.3s;
    }

    .edit-btn { background: linear-gradient(145deg, #00bcd4, #00fff5); color: #121212; }
    .delete-btn { background: linear-gradient(145deg, #e63946, #ff6f61); color: #fff; }
    .restore-btn { background: linear-gradient(145deg, #4caf50, #81c784); color: #121212; }
    .hard-delete-btn { background: linear-gradient(145deg, #ff6f00, #ffa000); color: #121212; }

    .action-btn:hover {
      transform: translateY(-1px) scale(1.05);
      box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    }

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
    
    .modal {
  display: none; /* hide by default */
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.5);
  justify-content: center;
  align-items: center;
}
.modal-content {
  background: #1f2a38;
  padding: 30px 40px;
  border-radius: 15px;
  text-align: center;
  color: #fff;
  box-shadow: 0 12px 30px rgba(0,0,0,0.6);
  animation: fadeIn 0.3s ease;
}
.modal-content button {
  margin: 5px;
  padding: 10px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
}
#confirmLogout { background: #d9534f; color: #fff; }
#cancelLogout { background: #5bc0de; color: #fff; }

#confirmDelete { background: #d9534f; color: #fff; } /* red */
#cancelDelete { background: #5bc0de; color: #fff; }  /* blue */


    /* Keep your pagination as-is */
  </style>
</head>
<body>
    
  <!-- Navbar -->
  <div class="navbar">
    <div class="nav-left">
      <h2>Active Students</h2>
    </div>
   
<?php $this->call->view('partials/flash', ['success' => $success, 'error' => $error]); ?>

    <div class="nav-center">
      <a href="/users/get-all" class="tab <?= !$show_deleted ? 'active' : '' ?>">All Records</a>
      <a href="/users/get-all?show=deleted" class="tab <?= $show_deleted ? 'active' : '' ?>">Archives</a>
      <a href="/users/create" class="create-btn">➕ Create</a>
      <a href="/logout" class="logout-btn">🔒 Log Out</a>
    </div>
  </div>
  <div id="logoutModal" class="modal">
  <div class="modal-content">
    <p>Are you sure you want to log out?</p>
    <button id="confirmLogout">Yes</button>
    <button id="cancelLogout">No</button>
  </div>
</div>

  <!-- Search Form -->
  <form class="search-form" method="get" action="/users/get-all">
    <?php if ($show_deleted): ?>
      <input type="hidden" name="show" value="deleted">
    <?php endif; ?>
    <input type="text" name="search" value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Search...">
    <button type="submit">Search</button>
  </form>
  <br>

  <!-- Students Table -->
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Profile</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($records as $r): ?>
      <tr>
        <td><?= $r['id'] ?></td>
        <td>
          <?php if (!empty($r['profile_picture'])): ?>
            <img src="/soriano_nik/Soriano_Nik/app/public/uploads/profile_pictures/<?= htmlspecialchars($r['profile_picture']) ?>" alt="Profile">
          <?php else: ?>
            N/A
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($r['username']) ?></td>
        <td><?= htmlspecialchars($r['email']) ?></td>
        <td><?= htmlspecialchars(ucfirst($r['role'])) ?></td>
        <td>
          <?php if ($show_deleted): ?>
            <a href="/users/restore/<?= $r['id'] ?>" class="action-btn restore-btn">♻ Restore</a>
            <a href="#" class="action-btn hard-delete-btn" data-url="/users/hard_delete/<?= $r['id'] ?>">⚠ Delete</a>
          <?php else: ?>
            <a href="/users/update/<?= $r['id'] ?>" class="action-btn edit-btn">✏ Edit</a>
            <a href="#" class="action-btn delete-btn" data-url="/users/delete/<?= $r['id'] ?>">🗑 Archive</a>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="pagination">
    <?= $pagination_links ?>
  </div>

  <div id="deleteModal" class="modal">
  <div class="modal-content">
    <p id="deleteMessage">Are you sure you want to delete this record?</p>
    <button id="confirmDelete">Yes</button>
    <button id="cancelDelete">No</button>
  </div>
</div>

</body>

<script>
const logoutBtn = document.querySelector('.logout-btn');
const modal = document.getElementById('logoutModal');
const confirmBtn = document.getElementById('confirmLogout');
const cancelBtn = document.getElementById('cancelLogout');

logoutBtn.addEventListener('click', function(e) {
  e.preventDefault(); // prevent default link
  modal.style.display = 'flex'; // show modal
});

cancelBtn.addEventListener('click', function() {
  modal.style.display = 'none'; // hide modal
});

confirmBtn.addEventListener('click', function() {
  window.location.href = '/logout'; // proceed to logout
});


const deleteBtns = document.querySelectorAll('.delete-btn, .hard-delete-btn');
const deleteModal = document.getElementById('deleteModal');
const confirmDeleteBtn = document.getElementById('confirmDelete');
const cancelDeleteBtn = document.getElementById('cancelDelete');

let deleteUrl = '';

deleteBtns.forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault(); // prevent default navigation
    deleteUrl = this.dataset.url; // get the URL
    // Change message for hard delete
    const message = this.classList.contains('hard-delete-btn') 
      ? 'This will permanently delete the record. Are you sure?' 
      : 'Are you sure you want to archive this student?';
    document.getElementById('deleteMessage').textContent = message;
    deleteModal.style.display = 'flex';
  });
});

cancelDeleteBtn.addEventListener('click', function() {
  deleteModal.style.display = 'none';
});

confirmDeleteBtn.addEventListener('click', function() {
  window.location.href = deleteUrl; // proceed to delete
});

</script>
</html>
