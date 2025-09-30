<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		* { box-sizing: border-box; }
		body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", sans-serif; background:#f8fafc; color:#334155; }
		.topbar { position: sticky; top:0; z-index:10; background:#111827; color:#fff; display:flex; align-items:center; justify-content:space-between; padding:12px 16px; }
		.brand { font-weight:700; letter-spacing:.3px; }
		.right { display:flex; align-items:center; gap:10px; }
		.role { background:#1f2937; color:#e5e7eb; padding:8px 12px; border-radius:9999px; font-size:.9rem; letter-spacing:.8px; margin-right:10px; }
		.logout { display:inline-block; padding:8px 12px; background:#ffffff; color:#111827; text-decoration:none; border:1px solid #cbd5e1; border-radius:6px; font-weight:600; }
		.logout:hover { background:#f8fafc; }
		.container { max-width:1100px; margin:20px auto; background:#fff; border:1px solid #e2e8f0; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,.06); overflow:hidden; }
		.header { background:#3B82F6; color:#fff; padding:20px; }
		.header h1 { margin:0; font-size:1.6rem; }
		.main { padding:20px; }
	</style>
</head>
<body>
	<div class="topbar">
		<div class="brand">Admin Dashboard</div>
		<div class="right">
			<div class="role">
				<?php
					$session = lava_instance()->session;
					$role = $session ? $session->userdata('role') : '';
					echo strtoupper($role ?: 'GUEST');
				?>
			</div>
			<a class="logout" href="<?php echo site_url('auth/logout'); ?>">Logout</a>
		</div>
	</div>

	<div class="container">
		<div class="header">
			<h1>Welcome<?php
				$user = $session ? $session->userdata('username') : '';
				echo $user ? ', ' . htmlspecialchars($user) : '';
			?>!</h1>
		</div>
		<div class="main">
			<p>You are logged in as <strong><?php echo htmlspecialchars($role ?: 'guest'); ?></strong>.</p>
			<p>Admin tools go here.</p>
		</div>
	</div>
</body>
</html>


