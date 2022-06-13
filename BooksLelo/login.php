<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - Bookslelo</title>
    <!-- Google Font - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }

        body {
            font-family: "Poppins", sans-serif;
        }

        .login {
            background: white;
            text-transform: uppercase;
            width: 100%;
            height: 100vh;
        }

        h1 {
            text-align: center;
        }

        button {
            background-color: #000;
            color: #fff;
            padding: 1em;
            font-size: 1rem;
            width: 90%;
            margin-top: 1em;
            border-radius: 0.5em;
            border: 1px solid #000;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-top: 5em;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        li {
            width: 90%;
            text-align: center;
        }

        input {
            margin: 1em;
            height: 3em;
            padding: 1em;
            width: 90%;
            font-size: large;
            border-radius: 0.5em;
            border: 1px solid #000;
        }

        .modal-header {
            display: flex;
        }

        svg.back {
            margin: 0.3em;
            width: 2rem;
            margin-right: 1em;
        }
    </style>
</head>


<body>
    <!-- loginModal -->
    <div class="login">

        <form action="components/logInHandle.php" method="post" class="login-form">
            <div class="modal-header">
                <a href="/bookslelo">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="back">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com div class="form-control"cense - https://fontawesome.com/div class="form-control"cense (Commercial div class="form-control"cense) Copyright 2022 Fonticons, Inc. -->
                        <path d="M447.1 256C447.1 273.7 433.7 288 416 288H109.3l105.4 105.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L109.3 224H416C433.7 224 447.1 238.3 447.1 256z" />
                    </svg>
                </a>
                <h1>Login</h1>
            </div>
            <div class="modalBody">
                <ul>
                    <li>
                        <input type="text" name="username" id="username" placeholder="Enter Your Username" required />
                    </li>
                    <li>
                        <input type="password" name="password" id="password" placeholder="Enter Your Password" required />
                    </li>
                    <li><button type="submit">Log In</button></li>
                </ul>
            </div>
        </form>
    </div>
</body>

</html>