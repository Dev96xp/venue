<!DOCTYPE html>
<html lang="en">

{{-- STATUS: TRABAJA MUY BIEN --}}

<head>
    <title>Event Coordinator | Karla</title>
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
            <img style="height:140px;width:140px" src="{{ asset('img/home/avatar_femele5.jpg') }}" alt="Avatar">
            <div>
                <p>Karla, Event Coordinator</p>
                <p>THE PALACE HALL</p>
                <small>Online</small>
                <a href="https://thepalace-hall.com/gallery">Get appointment</a>
            </div>
        </div>
        <!-- End Header -->

        <!-- Chat -->
        <div class="messages">
            <div class="left message">
                <img src="{{ asset('img/home/avatar_femele5.jpg') }}" alt="Avatar">
                <p>Hola!!, como te podemos ayudar?</p>
            </div>
        </div>
        <!-- End Chat -->

        <!-- Footer -->
        <div class="bottom">
            <form>
                <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                <button type="submit"></button>
            </form>
        </div>
        <!-- End Footer -->

    </div>
</body>

<script>


    //Broadcast messages
    $("form").submit(function(event) {
        event.preventDefault();

        //Stop empty messages
        if ($("form #message").val().trim() === '') {
            return;
        }

        //Disable form
        $("form #message").prop('disabled', true);
        $("form button").prop('disabled', true);




        // AJAX REQUEST
        $.ajax({
            url: "/chat",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                "model": "gpt-3.5-turbo", // Modelo de open-AI
                "content": $("form #message").val() // Valor de la entrada por el cliente
            }

            //  gpt-4o-mini
            //  gpt-3.5-turbo

        }).done(function(res) { // Mensaje en la variable (res)


            //Populate sending message
            $(".messages > .message").last().after('<div class="right message">' +
                '<p>' + $("form #message").val() + '</p>' +
                '<img src="{{ asset('img/home/avatar_male3.jpg') }}" alt="Avatar">' +
                '</div>');



            // '<a href="https://thepalace-hall.com/gallery">' + res + '</a>'
            //Populate receiving message, MENSAJES DE LA OPENAI
            $(".messages > .message").last().after('<div class="left message">' +
                '<img src="{{ asset('img/home/avatar_femele5.jpg') }}" alt="Avatar">' +
                '<p>' + res + '</p>' +
                '</div>');


            //Cleanup
            $("form #message").val('');
            $(document).scrollTop($(document).height());

            //Enable form
            $("form #message").prop('disabled', false);
            $("form button").prop('disabled', false);
        });
    });
</script>

</html>
