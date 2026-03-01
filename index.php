<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $city = $_POST['city'];

    $stmt = $conn->prepare("INSERT INTO users (name,email,phone,age,city) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $name, $email, $phone, $age, $city);
    if ($stmt->execute()) {
        header("Location: VIEW.php?msg=added");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add New Entry — Directory</title>
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
.wrap {
  max-width: 420px;
  margin: 0 auto;
  background: #fff;
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(30, 41, 59, 0.08);
  border: 1px solid #e2e8f0;
}
h1 {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0 0 1.5rem;
  color: #0f172a;
}
.form-group {
  margin-bottom: 1.1rem;
}
.form-group label {
  display: block;
  font-size: 0.85rem;
  font-weight: 600;
  color: #475569;
  margin-bottom: 0.35rem;
}
.form-group input {
  width: 100%;
  padding: 0.6rem 0.85rem;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  font-family: inherit;
  font-size: 0.95rem;
  transition: border-color 0.2s;
}
.form-group input:focus {
  outline: none;
  border-color: #64748b;
  box-shadow: 0 0 0 3px rgba(100, 116, 139, 0.15);
}
.btn {
  display: inline-block;
  padding: 0.65rem 1.25rem;
  font-family: inherit;
  font-size: 0.9rem;
  font-weight: 600;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  text-decoration: none;
  transition: background 0.2s, transform 0.05s;
}
.btn-primary {
  background: #334155;
  color: #fff;
  margin-top: 0.5rem;
  width: 100%;
}
.btn-primary:hover { background: #475569; }
.btn-secondary {
  background: transparent;
  color: #475569;
  border: 1px solid #cbd5e1;
  margin-top: 1rem;
  text-align: center;
}
.btn-secondary:hover { background: #f1f5f9; }
.footer-links { text-align: center; margin-top: 1.25rem; }
</style>
</head>
<body>
<div class="wrap">
  <h1>Add New Entry</h1>
  <form action="" method="post">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" required placeholder="Full name">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required placeholder="you@example.com">
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" id="phone" name="phone" required placeholder="Phone number">
    </div>
    <div class="form-group">
      <label for="age">Age</label>
      <input type="number" id="age" name="age" required placeholder="Age" min="1" max="120">
    </div>
    <div class="form-group">
      <label for="city">City</label>
      <input type="text" id="city" name="city" required placeholder="City">
    </div>
    <button type="submit" class="btn btn-primary">Save Entry</button>
  </form>
  <p class="footer-links"><a href="VIEW.php" class="btn btn-secondary">View All Entries</a></p>
</div>
</body>
</html>