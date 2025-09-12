<!DOCTYPE html>
<html>
<head>
    <title>Delete User - Mystic Theme</title>
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

        /* Mystic background aura */
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
            max-width: 600px; 
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
            padding: 24px;
            border-bottom: 3px solid #483d8b;
            background: linear-gradient(135deg, #1a1a3f 0%, #2b2b60 100%);
            text-align: center;
        }

        .title {
            margin: 0;
            font-size: 28px;
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
            text-align: center;
            background: rgba(255,255,255,0.05);
            border-radius: 12px;
        }

        p { 
            color: #ffffff; 
            font-size: 18px; 
            line-height: 1.6; 
        }
        strong { color: #ff6347; font-weight: 700; }

        .actions { display: flex; justify-content: center; gap: 14px; margin-top: 25px; }

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

        .btn-confirm {
            background: linear-gradient(135deg, #ff4500 0%, #b22222 100%);
            color: white;
            border-color: #b22222;
            box-shadow: 0 0 12px rgba(255,69,0,0.6), 0 0 25px rgba(178,34,34,0.4);
        }
        .btn-confirm:hover {
            background: linear-gradient(135deg, #b22222 0%, #800000 100%);
            box-shadow: 0 0 20px rgba(255,69,0,0.8), 0 0 30px rgba(178,34,34,0.5);
        }

        .btn-cancel {
            background: linear-gradient(135deg, #2e2e5a 0%, #1a1a3f 100%);
            color: #ffd700;
            border-color: #ffa500;
            box-shadow: 0 4px 16px rgba(255,215,0,0.35), 0 0 20px rgba(255,215,0,0.4);
        }
        .btn-cancel:hover {
            background: linear-gradient(135deg, #3a3a6a 0%, #202050 100%);
            border-color: #ffd700;
            box-shadow: 0 6px 24px rgba(255,215,0,0.6);
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
                <h1 class="title">⚔ Delete User ⚔</h1>
            </div>
            <div class="card-body">
                <p>Are you sure you want to delete <strong><?= $user['username'] ?></strong> (<strong><?= $user['email'] ?></strong>)?</p>
                <form action="<?= site_url('users/delete/' . $user['id']) ?>" method="POST">
                    <div class="actions">
                        <button type="submit" class="btn btn-confirm">Yes, Delete</button>
                        <a href="<?= site_url('users/view') ?>" class="btn btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
