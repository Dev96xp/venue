<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chat GPT Laravel | Code with Ross</title>
    <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- End JavaScript -->

    <!-- CSS -->
    <link rel="stylesheet" href="/chatgpt.css">
    <!-- End CSS -->

</head>

<body>
    <div class="chat">

        <!-- Header -->
        <div class="top">
            <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
            <div>
                <p>Ross Edlin 3 - OPENAI</p>
                <small>Online</small>
            </div>
        </div>
        <!-- End Header -->

        <!-- Chat -->
        <div class="messages">
            <div class="left message">
                <img src="{{ asset('img/home/avatar.jpg') }}" alt="Avatar">
                <p>Start chatting with Chat GPT AI below!!</p>
            </div>
        </div>
        <!-- End Chat -->

        <!-- Footer -->
        <div class="bottom">
            <form action="{{ route('make_request') }}" method="post">

                @csrf

                <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                <button type="submit"></button>
            </form>
        </div>
        <!-- End Footer -->

    </div>
</body>


</html>
