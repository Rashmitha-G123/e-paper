<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #D6F5F2, #F1F6FF);
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .container h2 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .icon {
            font-size: 40px;
            color: #008080;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            background: #008080;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #006666;
        }

        .extra-links {
            margin-top: 10px;
            font-size: 14px;
        }

        .extra-links a {
            text-decoration: none;
            color: #008080;
            font-weight: 600;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="icon">🔒</div>
        <h2>Forgot Password?</h2>
        <p>Enter your email address to reset your password.</p>

        @if (session('message'))
    <p style="color: green;">{{ session('message') }}</p>
@endif



    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <label for="email">Enter Your Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</div>
</div>

</body>
</html>
