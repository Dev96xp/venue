<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
    body {
        height: 100vh;
        width: 100vw;
        background-color: black;
        margin: 0rem;
        overflow: hidden;
    }

    #image-track {
        display: flex;
        gap: 4vmin;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(0%, -50%);
        user-select: none;
        /* -- Prevent image highlighting -- */
    }

    #image-menu {   /* lo agregue*/
        display: flex;
        gap: 4vmin;
        position: absolute;
        left: 2%;
        top: 4%;
        transform: translate(0%, -50%);
        user-select: none;

        /* -- Prevent image highlighting -- */
    }

    #image-track>.image {
        width: 40vmin;
        height: 56vmin;
        object-fit: cover;
        object-position: 100% center;
    }

    /* -- YouTube Link Styles -- */

    body.menu-toggled>.meta-link>span {
        color: rgb(30, 30, 30);
    }

    #source-link {
        bottom: 60px;
    }

    #source-link>i {
        color: rgb(94, 106, 210);
    }

    #yt-link>i {
        color: rgb(239, 83, 80);
    }

    .meta-link {
        align-items: center;
        backdrop-filter: blur(3px);
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        bottom: 10px;
        box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        display: inline-flex;
        gap: 5px;
        left: 10px;
        padding: 10px 20px;
        position: fixed;
        text-decoration: none;
        transition: background-color 400ms, border-color 400ms;
        z-index: 10000;
    }

    .meta-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .meta-link>i,
    .meta-link>span {
        height: 20px;
        line-height: 20px;
    }

    .meta-link>span {
        color: white;
        font-family: "Rubik", sans-serif;
        font-weight: 500;
    }
</style>


<body>

    {{-- <div id="image-menu">
        <a href="#home" class="px-4 py-2 float-left hover:bg-gray-300 no-underline">HOME</a>
        <a href="#about" class="px-4 py-2 float-left hover:bg-gray-300"><i class="fa fa-user"></i> ABOUT</a>
        <a href="#portfolio" class="px-4 py-2 float-left hover:bg-gray-300"><i class="fa fa-th"></i> PORTFOLIO</a>
        <a href="#shop" class="px-4 py-2 float-left hover:bg-gray-300"><i class="fa fa-shopping-bag"></i> SHOP</a>
        <a href="#contact" class="px-4 py-2 float-left hover:bg-gray-300"><i class="fa fa-envelope"></i> CONTACT</a>

        <a href="#" class="px-4 py-2 float-right hover:bg-red-500">
            <i class="fa fa-search"></i>
        </a>
    </div> --}}

    <div id="image-track" data-mouse-down-at="0" data-prev-percentage="0">
        <img class="image" src="{{ asset('img/home/woman1.jpg') }}" alt="" draggable="false">
        <img class="image" src="{{ asset('img/home/woman2.jpg') }}" alt="" draggable="false">
        <img class="image" src="{{ asset('img/home/woman3.jpg') }}" alt="" draggable="false">
        <img class="image" src="{{ asset('img/home/woman4.jpg') }}" alt="" draggable="false">
        <img class="image" src="{{ asset('img/home/woman5.jpg') }}" alt="" draggable="false">
        <img class="image" src="{{ asset('img/home/woman6.jpg') }}" alt="" draggable="false">
        <img class="image" src="{{ asset('img/home/woman7.jpg') }}" alt="" draggable="false">
        <img class="image" src="{{ asset('img/home/woman8.jpg') }}" alt="" draggable="false">
        <img class="image" src="{{ asset('img/home/woman1.jpg') }}" alt="" draggable="false">
        <img class="image" src="{{ asset('img/home/woman2.jpg') }}" alt="" draggable="false">
    </div>

</body>

</html>
<script>
    const track = document.getElementById("image-track");

    const handleOnDown = e => track.dataset.mouseDownAt = e.clientX;

    const handleOnUp = () => {
        track.dataset.mouseDownAt = "0";
        track.dataset.prevPercentage = track.dataset.percentage;
    }

    const handleOnMove = e => {
        if (track.dataset.mouseDownAt === "0") return;

        const mouseDelta = parseFloat(track.dataset.mouseDownAt) - e.clientX,
            maxDelta = window.innerWidth / 2;

        const percentage = (mouseDelta / maxDelta) * -100,
            nextPercentageUnconstrained = parseFloat(track.dataset.prevPercentage) + percentage,
            nextPercentage = Math.max(Math.min(nextPercentageUnconstrained, 0), -100);

        track.dataset.percentage = nextPercentage;

        track.animate({
            transform: `translate(${nextPercentage}%, -50%)`
        }, {
            duration: 1200,
            fill: "forwards"
        });

        for (const image of track.getElementsByClassName("image")) {
            image.animate({
                objectPosition: `${100 + nextPercentage}% center`
            }, {
                duration: 1200,
                fill: "forwards"
            });
        }
    }

    /* -- Had to add extra lines for touch events -- */

    window.onmousedown = e => handleOnDown(e);

    window.ontouchstart = e => handleOnDown(e.touches[0]);

    window.onmouseup = e => handleOnUp(e);

    window.ontouchend = e => handleOnUp(e.touches[0]);

    window.onmousemove = e => handleOnMove(e);

    window.ontouchmove = e => handleOnMove(e.touches[0]);
</script>
