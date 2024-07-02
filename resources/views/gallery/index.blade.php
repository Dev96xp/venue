<x-app-layout>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial;
        }

        .header {
            text-align: center;
            padding: 32px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            padding: 0 4px;
        }

        /* Create four equal columns that sits next to each other */
        .column {
            flex: 25%;
            max-width: 25%;
            padding: 0 4px;
        }

        .column img {
            margin-top: 8px;
            vertical-align: middle;
        }

        /* Responsive layout - makes a two column-layout instead of four columns */
        @media (max-width: 800px) {
            .column {
                flex: 50%;
                max-width: 50%;
            }
        }

        /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
        @media (max-width: 600px) {
            .column {
                flex: 100%;
                max-width: 100%;
            }
        }
    </style>

    <!-- Photo Grid -->
    <div class="row">
        <div class="column">
            <img src="/img/gallery/salon1.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon2.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon3.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon4.jpg" class="rounded-xl w-full">
        </div>

        <div class="column">
            <img src="/img/gallery/salon4.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon5.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon6.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon7.jpg" class="rounded-xl w-full">
        </div>

        <div class="column">
            <img src="/img/gallery/salon6.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon7.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon8.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon1.jpg" class="rounded-xl w-full">
        </div>

        <div class="column">
            <img src="/img/gallery/salon4.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon7.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon2.jpg" class="rounded-xl w-full">
            <img src="/img/gallery/salon7.jpg" class="rounded-xl w-full">
        </div>
    </div>

</x-app-layout>
