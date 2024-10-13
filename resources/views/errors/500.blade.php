<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .error-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 400px;
        }

        h1 {
            font-size: 72px;
            margin: 0;
            color: #e74c3c;
        }

        p {
            font-size: 18px;
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <h1>500</h1>
        <p>Oops! Something went wrong on our end.</p>
        @if (config('app.debug'))
            <p><small>{{ $exception->getMessage() }}</small></p>
        @endif
        <a href="{{ url('/') }}" class="btn">Go Home</a>
    </div>
</body>

</html>
