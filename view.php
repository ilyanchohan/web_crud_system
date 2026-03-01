<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Directory — All Entries</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;700&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; }
body {
  font-family: 'Figtree', system-ui, sans-serif;
  background: linear-gradient(145deg, #f0f4f8 0%, #e2e8f0 100%);
  min-height: 100vh;
  margin: 0;
  padding: 2rem 1rem;
  color: #1e293b;
}
.container { max-width: 900px; margin: 0 auto; }
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
  margin-bottom: 1.5rem;
}
h1 { font-size: 1.5rem; font-weight: 700; margin: 0; color: #0f172a; }
.card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(30, 41, 59, 0.08);
  border: 1px solid #e2e8f0;
  overflow: hidden;
}
.table-wrap { overflow-x: auto; }
table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.9rem;
}
th, td { padding: 0.85rem 1rem; text-align: left; }
th {
  background: #334155;
  color: #fff;
  font-weight: 600;
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}
tr:nth-child(even) { background: #f8fafc; }
tr:hover { background: #f1f5f9; }
td { border-bottom: 1px solid #e2e8f0; }
.actions { white-space: nowrap; }
.actions a {
  display: inline-block;
  padding: 0.4rem 0.75rem;
  font-size: 0.8rem;
  font-weight: 600;
  text-decoration: none;
  border-radius: 6px;
  margin-right: 0.4rem;
  transition: background 0.2s;
}
.actions .btn-edit {
  background: #334155;
  color: #fff;
}
.actions .btn-edit:hover { background: #475569; }
.actions .btn-delete {
  background: #fef2f2;
  color: #b91c1c;
  border: 1px solid #fecaca;
}
.actions .btn-delete:hover { background: #fee2e2; }
.btn-add {
  display: inline-block;
  padding: 0.6rem 1.2rem;
  background: #334155;
  color: #fff;
  font-family: inherit;
  font-size: 0.9rem;
  font-weight: 600;
  text-decoration: none;
  border-radius: 8px;
  transition: background 0.2s;
}
.btn-add:hover { background: #475569; }
.empty { text-align: center; padding: 2rem; color: #64748b; }
.toast {
  position: fixed;
  bottom: 1.5rem;
  left: 50%;
  transform: translateX(-50%);
  padding: 0.75rem 1.25rem;
  background: #0f172a;
  color: #fff;
  border-radius: 8px;
  font-size: 0.9rem;
  font-weight: 500;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  z-index: 100;
  animation: fadeUp 0.3s ease;
}
@keyframes fadeUp { from { opacity: 0; transform: translateX(-50%) translateY(10px); } to { opacity: 1; transform: translateX(-50%) translateY(0); } }
</style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>Directory</h1>
    <a href="INDEX.php" class="btn-add">Add New Entry</a>
  </div>
  <div class="card">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Age</th>
            <th>City</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
<?php
if(isset($_GET['msg'])){
    $m = $_GET['msg'];
    if($m == 'deleted') echo "<script>setTimeout(function(){ var t=document.createElement('div'); t.className='toast'; t.textContent='Entry removed.'; document.body.appendChild(t); setTimeout(function(){ t.remove(); }, 2500); }, 100);</script>";
    if($m == 'updated') echo "<script>setTimeout(function(){ var t=document.createElement('div'); t.className='toast'; t.textContent='Entry updated.'; document.body.appendChild(t); setTimeout(function(){ t.remove(); }, 2500); }, 100);</script>";
    if($m == 'added') echo "<script>setTimeout(function(){ var t=document.createElement('div'); t.className='toast'; t.textContent='New entry saved.'; document.body.appendChild(t); setTimeout(function(){ t.remove(); }, 2500); }, 100);</script>";
}
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>". (int)$row['id'] ."</td>";
        echo "<td>". htmlspecialchars($row['name']) ."</td>";
        echo "<td>". htmlspecialchars($row['email']) ."</td>";
        echo "<td>". htmlspecialchars($row['phone']) ."</td>";
        echo "<td>". (int)$row['age'] ."</td>";
        echo "<td>". htmlspecialchars($row['city']) ."</td>";
        echo "<td class='actions'><a class='btn-edit' href='EDIT.php?id=".(int)$row['id']."'>Edit</a> <a class='btn-delete' href='DELETE.php?id=".(int)$row['id']."' onclick=\"return confirm('Remove this entry?');\">Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' class='empty'>No entries yet. Add one to get started.</td></tr>";
}
?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>