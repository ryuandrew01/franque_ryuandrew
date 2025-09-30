<?php $session = lava_instance()->session; ?>
<!DOCTYPE html>
<html>
<head>
	<title>User Dashboard - Mystic Theme</title>
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
		.username {
			color: #ff3333; /* elegant red */
			font-weight: 900;
			font-style: italic;
			letter-spacing: 1px;
		}
		.role-text {
			font-size: 18px;
			color: #c0c0ff; /* softer elegant bluish-white */
			font-weight: 700;
			font-style: italic;
			border-left: 4px solid #4169e1;
			padding-left: 10px;
			display: inline-block;
			margin: 12px 0 0;
		}
		.card-body {
			padding: 30px 35px;
			animation: fadeIn .6s ease .15s both;
			text-align: center;
			background: rgba(255,255,255,0.05);
			border-radius: 12px;
		}
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
		.logout-btn {
			background: linear-gradient(135deg,#ffd700 0%,#ffa500 100%);
			color: #1a1a1a;
			border: 2px solid #ffa500;
			box-shadow: 0 0 14px rgba(255,215,0,0.7);
			font-weight: bold;
			padding: 10px 18px;
			font-size: 14px;
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
				<h1 class="title">
					👤 Welcome, <span class="username"><?= $session->userdata('username') ?></span>!
				</h1>
				<a href="<?= site_url('auth/logout') ?>" class="btn logout-btn">Logout</a>
			</div>
			<div class="card-body">
				<p class="role-text">Role: <?= $session->userdata('role') ?></p>
				<div style="margin-top:32px;text-align:left;">
					<h2 style="color:#ffd700;font-size:22px;margin-bottom:12px;">Co-Users</h2>
					<div style="background:rgba(255,255,255,0.08);border-radius:12px;padding:18px 24px;max-height:220px;overflow-y:auto;box-shadow:0 0 10px rgba(65,105,225,0.2);">
						<?php
						require_once __DIR__ . '/../../models/UserModel.php';
						$userModel = new UserModel();
						$users = $userModel->get_all_users();
						foreach($users as $user) {
							if($user['username'] !== $session->userdata('username')) {
								echo '<div style="color:#e0e0f8;font-size:17px;padding:6px 0;border-bottom:1px solid #483d8b;">👤 ' . htmlspecialchars($user['username']) . '</div>';
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
