<!DOCTYPE html>

<head>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
    @include('include.head_link')
</head>

<body>
    @include('include.header')

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="active"> S'authentifier</h2>


            <!-- Icon -->
            <div class="fadeIn first">
                <img src="assets/img/SEA.jpeg" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form method="post" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input class="au-input au-input--full" placeholder="email" type="email" id="login" name="login">
                </div>

                <div class="form-group">
                    <input class="au-input au-input--full" placeholder="password" type="password" id="password" name="password">
                </div>

                <input type="submit" class="fadeIn fourth" value="Se connecter">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
                <span> Contactz admin</span>
            </div>

        </div>
    </div>

    @include('include.footer')

    @include('include.foot_link')
</body>

</html>
