<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせありがとうございました</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .thanks-container {
            width: 100%;
            max-width: 1200px;
            text-align: center;
            position: relative;
            padding: 60px 20px;
        }

        .thanks-bg {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Inika', serif;
            font-size: 180px;
            color: rgba(139, 121, 105, 0.05);
            white-space: nowrap;
            z-index: 0;
            pointer-events: none;
            width: 100%;
            text-align: center;
            user-select: none;
        }

        h2 {
            position: relative;
            font-size: 24px;
            color: #8B7969;
            margin-bottom: 40px;
            z-index: 1;
            font-weight: normal;
        }

        .home-btn {
            position: relative;
            display: inline-block;
            padding: 10px 40px;
            background: #8B7969;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            z-index: 1;
            transition: opacity 0.3s;
        }

        .home-btn:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .thanks-bg {
                font-size: 120px;
            }
        }
    </style>
</head>

<body>
    <div class="thanks-container">
        <div class="thanks-bg">Thank You</div>
        <h2>お問い合わせありがとうございました</h2>
        <a href="{{ url('/') }}" class="home-btn">HOME</a>
    </div>
</body>

</html>