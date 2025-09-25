<!DOCTYPE html>
<html>
<head>
    <title> USERS</title>
    <style>
        * { box-sizing: border-box; }
        body { 
            margin: 0; 
            font-family: 'Trebuchet MS', Arial, sans-serif; 
            color: #ffffff; 
            background: linear-gradient(160deg, #0a0a2a, #1b1b3a, #2e2e5a); 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .bg-decor { 
            position: fixed; 
            inset: 0; 
            z-index: -1; 
            pointer-events: none; 
            background:
                radial-gradient(600px 600px at 0% 0%, rgba(65,105,225,.15), transparent 60%),
                radial-gradient(600px 600px at 100% 0%, rgba(30,144,255,.12), transparent 60%),
                radial-gradient(600px 600px at 0% 100%, rgba(0,255,127,.1), transparent 60%),
                radial-gradient(600px 600px at 100% 100%, rgba(255,215,0,.1), transparent 60%);
            animation: floatBg 16s ease-in-out infinite alternate; 
        }

        .container { 
            width: 100%; 
            max-width: 1000px; 
            padding: 0 16px; 
        }

        .card { 
            background: rgba(20,20,40,0.92);
            border: 3px solid #4169e1; 
            border-radius: 20px; 
            box-shadow: 0 0 25px rgba(65,105,225,0.6), 0 0 40px rgba(255,215,0,0.25); 
            overflow: hidden; 
            transform: translateY(0); 
            opacity: 0; 
            animation: cardIn 1s ease-out forwards, floatCard 6s ease-in-out infinite;
        }

        .card-header { 
            padding: 24px; 
            background: linear-gradient(135deg, #1a1a3f 0%, #2b2b60 100%);
            border-bottom: 3px solid #4169e1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .title { 
            margin: 0; 
            font-size: 28px; 
            font-weight: 900; 
            color: #ffd700; 
            text-shadow: 0 0 12px rgba(255,215,0,0.8), 0 0 20px rgba(30,144,255,0.6);
        }

        .btn { 
            padding: 6px 12px; 
            border-radius: 10px; 
            font-weight: 700; 
            cursor: pointer; 
            transition: transform .1s ease, box-shadow .3s ease, background .3s ease;
            margin-left: 8px;
            text-decoration: none; /* remove underline */
        }
        .btn:active { transform: translateY(2px); }

        /* Add User button in yellow */
        .btn-primary { 
            background: linear-gradient(135deg, #ffd700 0%, #ffea00 100%); 
            color: #1a1a1a; 
        }

        .btn-edit { 
            background: linear-gradient(135deg, #ff6347 0%, #ff0000 100%); 
            color: white; 
        }
        .btn-edit:hover { 
            background: linear-gradient(135deg, #cc0000 0%, #8b0000 100%); 
        }

        .btn-delete { 
            background: linear-gradient(135deg, #8b0000 0%, #4b0000 100%); 
            color: white; 
        }
        .btn-delete:hover { 
            background: linear-gradient(135deg, #660000 0%, #330000 100%); 
        }

        .table-wrapper { 
            overflow-x: auto; 
            padding: 20px; 
            background: rgba(255,255,255,0.05); 
        }

        table { 
            border-collapse: collapse; 
            width: 100%; 
            font-size: 16px; 
            color: white;
        }
        th, td { 
            padding: 14px 16px; 
            text-align: left; 
            border-bottom: 1px solid rgba(255,255,255,0.2); 
            transition: background 0.3s ease;
        }
        th { 
            background: linear-gradient(135deg, #1e90ff 0%, #0000cd 100%);
            color: white; 
            font-weight: 700; 
            text-shadow: 1px 1px 0 rgba(0,0,0,0.3);
        }
        tr:hover td { 
            background: rgba(255,255,255,0.12); 
            border-radius: 6px;
        }

        .empty { 
            text-align: center; 
            color: #ffd700; 
            font-style: italic; 
        }

        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 16px 20px 24px;
            background: rgba(255,255,255,0.05);
            border-top: 1px solid rgba(255,255,255,0.15);
            flex-wrap: wrap;
        }
        .page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 10px;
            color: #fff;
            text-decoration: none;
            background: linear-gradient(135deg, #1e90ff 0%, #0000cd 100%);
            box-shadow: 0 0 12px rgba(65,105,225,0.5);
        }
        .page-btn:hover { background: linear-gradient(135deg, #3aa0ff 0%, #1e2cff 100%); }
        .page-btn.disabled { opacity: .4; pointer-events: none; }
        .page-btn.active {
            background: linear-gradient(135deg, #ffd700 0%, #ffea00 100%);
            color: #1a1a1a;
            box-shadow: 0 0 14px rgba(255,215,0,0.7);
            font-weight: 800;
        }
        .page-stats { color: #b7c6ff; margin-left: 12px; font-size: 14px; }

        .per-page {
            margin-left: auto;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #b7c6ff;
        }
        .per-page select {
            height: 32px;
            border-radius: 8px;
            border: 1px solid #4169e1;
            background: #1b1b3a;
            color: #fff;
            padding: 0 8px;
        }

        /* Search bar styles - outside card */
        .search-bar-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }
        .search-form {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(20,20,40,0.9);
            padding: 16px 24px;
            border-radius: 15px;
            border: 2px solid #4169e1;
            box-shadow: 0 0 20px rgba(65,105,225,0.4);
        }
        .search-input {
            height: 36px;
            padding: 0 12px;
            border-radius: 10px;
            border: 2px solid #4169e1;
            background: rgba(20,20,40,0.8);
            color: #fff;
            font-size: 14px;
            min-width: 200px;
            transition: all 0.3s ease;
        }
        .search-input:focus {
            outline: none;
            border-color: #ffd700;
            box-shadow: 0 0 10px rgba(255,215,0,0.3);
        }
        .search-input::placeholder {
            color: #b7c6ff;
        }
        .search-btn {
            height: 36px;
            padding: 0 16px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #1e90ff 0%, #0000cd 100%);
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .search-btn:hover {
            background: linear-gradient(135deg, #3aa0ff 0%, #1e2cff 100%);
            transform: translateY(-1px);
        }
        .clear-search {
            height: 36px;
            padding: 0 12px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #ff6347 0%, #ff0000 100%);
            color: white;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        .clear-search:hover {
            background: linear-gradient(135deg, #cc0000 0%, #8b0000 100%);
            transform: translateY(-1px);
        }

        @keyframes cardIn { to { opacity: 1; } }
        @keyframes floatCard { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
        @keyframes floatBg { 0% { background-position: 0% 0%, 100% 0%, 0% 100%, 100% 100%; } 
                              100% { background-position: 10% 5%, 90% 10%, 5% 90%, 95% 95%; } }
    </style>
</head>
<body>
    <div class="bg-decor"></div>
    <div class="container">
        <!-- Search bar outside the card -->
        <div class="search-bar-container">
            <form method="GET" class="search-form">
                <input type="hidden" name="per_page" value="<?= $per_page ?? 10 ?>">
                <input type="text" name="search" value="<?= htmlspecialchars($search ?? '') ?>" 
                       placeholder="Search by ID, username, or email..." class="search-input">
                <button type="submit" class="search-btn">Search</button>
                <?php if (!empty($search)): ?>
                    <a href="<?= site_url('users/view') ?>?per_page=<?= $per_page ?? 10 ?>" class="clear-search">Clear</a>
                <?php endif; ?>
            </form>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h1 class="title">⚔ USERS ⚔</h1>
                <a href="<?= site_url('users/create') ?>" class="btn btn-primary">Add User</a>
            </div>
            <div class="table-wrapper">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (!empty($users)): ?>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <a href="<?= site_url('users/update/' . $user['id']) ?>" class="btn btn-edit">Edit</a>
                                <a href="<?= site_url('users/delete/' . $user['id']) ?>" class="btn btn-delete">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="empty">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
            <?php if (isset($pagination) && !empty($pagination['last_page'])): ?>
            <?php 
                $current = (int) $pagination['current_page'];
                $last = (int) max(1, $pagination['last_page']);
                $per = isset($per_page) ? (int)$per_page : (int) $pagination['per_page'];
                $total = (int) $pagination['total'];
                $base = site_url('users/view');
                $prev = max(1, $current - 1);
                $next = min($last, $current + 1);
                $start = ($current - 1) * $per + 1;
                $end = min($total, $current * $per);
                $window = 2; // show current +/-2
                $from = max(1, $current - $window);
                $to = min($last, $current + $window);
                $q = '&per_page=' . $per;
                if (!empty($search)) {
                    $q .= '&search=' . urlencode($search);
                }
            ?>
            <div class="pagination">
                <a class="page-btn <?= $current <= 1 ? 'disabled' : '' ?>" href="<?= $base . '?page=' . $prev . $q ?>">« Prev</a>
                <?php if ($from > 1): ?>
                    <a class="page-btn" href="<?= $base . '?page=1' . $q ?>">1</a>
                    <?php if ($from > 2): ?><span class="page-stats">…</span><?php endif; ?>
                <?php endif; ?>

                <?php for ($i = $from; $i <= $to; $i++): ?>
                    <a class="page-btn <?= $i === $current ? 'active' : '' ?>" href="<?= $base . '?page=' . $i . $q ?>"><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($to < $last): ?>
                    <?php if ($to < $last - 1): ?><span class="page-stats">…</span><?php endif; ?>
                    <a class="page-btn" href="<?= $base . '?page=' . $last . $q ?>"><?= $last ?></a>
                <?php endif; ?>

                <a class="page-btn <?= $current >= $last ? 'disabled' : '' ?>" href="<?= $base . '?page=' . $next . $q ?>">Next »</a>
                <span class="page-stats">Showing <?= $total ? $start : 0 ?>–<?= $total ? $end : 0 ?> of <?= $total ?></span>
                <span class="per-page">
                    Rows per page:
                    <select onchange="location.href='<?= $base ?>?page=1&per_page=' + this.value">
                        <?php foreach ([5,10,20,50] as $opt): ?>
                            <option value="<?= $opt ?>" <?= $per == $opt ? 'selected' : '' ?>><?= $opt ?></option>
                        <?php endforeach; ?>
                    </select>
                </span>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
