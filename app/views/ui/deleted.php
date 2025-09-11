<!DOCTYPE html>
<html>
<head><title>Deleted Students</title></head>
<body>
<h1>Deleted Students</h1>

<table border="1">
  <tr>
    <th>ID</th><th>First</th><th>Last</th><th>Email</th><th>Action</th>
  </tr>
  <?php foreach ($records as $row): ?>
  <tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['first_name'] ?></td>
    <td><?= $row['last_name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td>
      <a href="/users/restore/<?= $row['id'] ?>">♻ Restore</a>
      <a href="/users/hard-delete/<?= $row['id'] ?>" onclick="return confirm('Delete permanently?')">❌ Hard Delete</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

<p><a href="/users">⬅ Back to Active</a></p>
</body>
</html>
