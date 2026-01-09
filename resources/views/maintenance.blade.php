<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sedang Maintenance</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            background: white;
            padding: 3rem 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(130, 0, 0, 0.15);
            text-align: center;
            max-width: 600px;
            width: 100%;
            animation: slideUp 0.6s ease-out;
            border: 3px solid #820000;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .icon-wrapper {
            background: #820000;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 5px 20px rgba(130, 0, 0, 0.3);
        }
        
        .icon {
            font-size: 3rem;
            animation: rotate 3s linear infinite;
        }
        
        @keyframes rotate {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-15deg); }
            75% { transform: rotate(15deg); }
        }
        
        h1 {
            color: #820000;
            margin-bottom: 1.5rem;
            font-size: 2.2rem;
            font-weight: 700;
        }
        
        .status-badge {
            display: inline-block;
            background: #FFD700;
            color: #820000;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 10px rgba(255, 215, 0, 0.4);
        }
        
        p {
            color: #555;
            line-height: 1.8;
            margin-bottom: 1rem;
            font-size: 1.05rem;
        }
        
        p strong {
            color: #820000;
        }
        
        .info-box {
            background: #fff9e6;
            border-left: 4px solid #FFD700;
            padding: 1rem;
            margin: 1.5rem 0;
            border-radius: 5px;
            text-align: left;
        }
        
        .info-box p {
            margin: 0;
            color: #666;
            font-size: 0.95rem;
        }
        
        .footer {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f0f0f0;
            color: #999;
            font-size: 0.9rem;
        }
        
        .progress-bar {
            width: 100%;
            height: 4px;
            background: #f0f0f0;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 2rem;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #820000, #FFD700);
            animation: progress 2s ease-in-out infinite;
        }
        
        @keyframes progress {
            0% { width: 0%; }
            50% { width: 70%; }
            100% { width: 0%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon-wrapper">
            <div class="icon">🔧</div>
        </div>
        
        <h1>Website Sedang Maintenance</h1>
        
        <span class="status-badge">⚠️ DALAM PERBAIKAN</span>
        
        <p>Mohon maaf atas ketidaknyamanannya.</p>
        <p>Kami sedang melakukan pemeliharaan dan peningkatan sistem untuk memberikan pengalaman yang lebih baik bagi Anda.</p>
        
        <div class="info-box">
            <p><strong>💡 Info:</strong> Website akan segera kembali normal. Terima kasih atas kesabaran Anda!</p>
        </div>
        
        <p><strong>Tim kami sedang bekerja keras untuk Anda.</strong></p>
        
        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>
        
        <div class="footer">
            Terima kasih atas pengertian dan kesabaran Anda! 🙏
        </div>
    </div>
</body>
</html>