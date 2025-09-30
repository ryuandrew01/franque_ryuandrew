<!DOCTYPE html>
<html>
<head>
  <title>Register - Mystic Theme</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Trebuchet MS', Arial, sans-serif;
      color: #e0e0f8;
      background: linear-gradient(160deg, #0a0a2a, #1b1b3a, #2e2e5a);
      overflow: hidden;
    }
    .bg-decor {
      position: fixed;
      inset: 0;
      z-index: -1;
      background:
        radial-gradient(800px 800px at 20% 20%, rgba(0,0,139,0.35), transparent 70%),
        radial-gradient(800px 800px at 80% 30%, rgba(25,25,112,0.3), transparent 70%),
        radial-gradient(800px 800px at 40% 80%, rgba(72,61,139,0.28), transparent 70%),
        radial-gradient(800px 800px at 70% 90%, rgba(255,140,0,0.25), transparent 70%);
      animation: floatBg 20s ease-in-out infinite alternate;
    }
    .container {
      width: 100%;
      max-width: 900px;
      padding: 0 20px;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card {
      width: 100%;
      background: rgba(20,20,40,0.92);
      border: 3px solid #483d8b;
      border-radius: 20px;
      box-shadow:
        0 0 25px rgba(65,105,225,0.6),
        0 0 60px rgba(255,215,0,0.25);
      overflow: hidden;
      transform: translateY(0);
      opacity: 0;
      animation: cardIn 1s ease-out forwards, floatCard 6s ease-in-out infinite;
      backdrop-filter: blur(8px);
    }
    .card-header {
      padding: 20px 24px;
      border-bottom: 3px solid #483d8b;
      background: linear-gradient(135deg, #1a1a3f 0%, #2b2b60 100%);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .title {
      margin: 0;
      font-size: 26px;
      font-weight: 900;
      color: #ffd700;
      text-shadow:
        0 0 12px rgba(255,215,0,0.8),
        0 0 20px rgba(30,144,255,0.6),
        0 0 25px rgba(255,140,0,0.5);
    }
    .card-body {
      padding: 30px 35px;
      animation: fadeIn .6s ease .15s both;
      background: rgba(255,255,255,0.05);
      border-radius: 12px;
    }
    /* --- Modified form layout --- */
    .form-group {
      margin-bottom: 22px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 15px;
    }
    label {
      margin: 0;
      font-weight: 700;
      color: #87cefa;
      font-size: 16px;
      text-shadow: 0 0 8px rgba(135,206,250,0.5);
      flex: 0 0 150px; /* fixed width para pantay */
      text-align: right;
    }
    input[type="text"], input[type="email"], input[type="password"], select {
      flex: 1;
      padding: 16px 18px;
      border: 2px solid #6666aa;
      border-radius: 12px;
      background: #ffffff;
      color: #000000;
      font-size: 16px;
      transition: border-color .3s ease, box-shadow .3s ease, background .3s ease;
    }
    input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
      outline: none;
      border-color: #1e90ff;
      box-shadow: 0 0 15px rgba(30,144,255,0.6), 0 0 25px rgba(255,215,0,0.4);
    }
    select {
      background: #fff8dc;
      margin-bottom: 0;
    }
    .actions { display: flex; justify-content: center; margin-top: 25px; }
    .btn {
      padding: 14px 22px;
      text-decoration: none;
      border-radius: 14px;
      border: 2px solid transparent;
      font-size: 16px;
      font-weight: 700;
      cursor: pointer;
      transition: transform .1s ease, box-shadow .3s ease, background .3s ease;
    }
    .btn:active { transform: translateY(3px); }
    .btn-primary {
      background: linear-gradient(135deg, #1e90ff 0%, #0000cd 100%);
      color: white;
      border-color: #4169e1;
      box-shadow: 0 4px 16px rgba(30,144,255,0.5), 0 0 20px rgba(30,144,255,0.6);
    }
    .btn-primary:hover {
      background: linear-gradient(135deg, #4169e1 0%, #191970 100%);
      box-shadow: 0 6px 24px rgba(65,105,225,0.7), 0 0 25px rgba(255,215,0,0.5);
    }
    .register-link {
      color: #060606ff;
      font-weight: bold;
      padding: 10px 22px;
      border-radius: 14px;
      background: linear-gradient(135deg, #ffd700 0%, #ffa500 100%);
      border: 2px solid #ffa500;
      box-shadow: 0 0 14px rgba(255,215,0,0.7);
      text-decoration: none;
      display: inline-block;
      transition: transform .15s ease, box-shadow .3s ease;
    }
    .register-link:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 20px rgba(255,215,0,0.9);
      background: linear-gradient(135deg, #ffe066 0%, #ffb347 100%);
    }
    .register-text {
      margin-top: 25px;
      text-align: center;
    }
    @keyframes cardIn { to { opacity: 1; } }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes floatBg {
      0% { background-position: 0% 0%, 100% 0%, 0% 100%, 100% 100%; }
      100% { background-position: 10% 5%, 90% 10%, 5% 90%, 95% 95%; }
    }
    @keyframes floatCard {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-12px); }
    }
  </style>
</head>
<body>
  <div class="bg-decor"></div>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h1 class="title">📝Register</h1>
      </div>
      <div class="card-body">
        <form method="post" action="<?= site_url('auth/register'); ?>">
          <div class="form-group">
            <label for="username">🛡 Username</label>
            <input type="text" name="username" id="username" placeholder="Username" required>
          </div>
          <div class="form-group">
            <label for="email">📜 Email</label>
            <input type="email" name="email" id="email" placeholder="Enter Email" required>
          </div>
          <div class="form-group">
            <label for="password">🔑 Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label for="confirm_password">🔒 Confirm</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
          </div>
          <div class="form-group">
            <label for="role">🎭 Role</label>
            <select name="role" id="role" required>
              <option value="user" selected>👤 User</option>
              <option value="admin">👑 Admin</option>
            </select>
          </div>
          <div class="actions">
            <button type="submit" class="btn btn-primary">💠 Register</button>
          </div>
        </form>
        <p class="register-text">
          Already have an account?
          <br><br>
          <a href="<?= site_url('auth/login'); ?>" class="register-link">Login</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
