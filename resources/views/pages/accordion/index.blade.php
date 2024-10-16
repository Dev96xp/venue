<x-app-layout>

    {{-- NOTA: SOLO ES UIN JEMPLO PARA REALIZAR UN ACCORDION --}}
    <style>
        .body{
            margin: 0;
            padding: 0;
            font-family: 'Courier New', Courier, monospace;
            box-sizing: border-box;
        }

        .body {
            background: #e3edf7;
        }

        .accordion {
            margin: 60px auto;
            width: 600px;
        }

        .accordion li {
            list-style: none;
            width: 100%;
            margin: 20px;
            padding: 10px;
            border-radius: 8px;
            background: #e3edf7;
            box-shadow: 6px 6px 10px -1px rgba(0, 0, 0, 0.15),
                -6px -6px 10px -1px rgba(255, 255, 255, 0.7);
        }

        .accordion li label {
            display: flex;
            align-items: center;
            padding: 10px;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
        }

        label::before {
            content: '+';
            margin-right: 10px;
            font-size: 24px;
            font-weight: 600px;
        }

        input[type="radio"] {
            display: none;
        }

        .accordion .content {
            color: #555;
            padding: 0 10px;
            line-height: 26px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s, padding 0.5s;
        }

        .accordion input[type="radio"]:checked + label + .content {
            max-height: 400px;
            padding: 10px 10px 20px;
        }

        .accordion input[type="radio"]:checked + label::before{
            content: '-'

        }

    </style>
    <div>
        <ul class="accordion">
            <li>
                <input type="radio" name="accordion" id="first" checked>
                <label for="first">Products</label>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente a earum minus distinctio, optio
                        quam architecto tempora similique cupiditate mollitia modi voluptatem, inventore molestias
                        maxime in nihil unde quaerat cum.</p>
                </div>
            </li>

            <li>
                <input type="radio" name="accordion" id="second">
                <label for="second">Information</label>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente a earum minus distinctio, optio
                        quam architecto tempora similique cupiditate mollitia modi voluptatem, inventore molestias
                        maxime in nihil unde quaerat cum.</p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="third">
                <label for="third">Question</label>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente a earum minus distinctio, optio
                        quam architecto tempora similique cupiditate mollitia modi voluptatem, inventore molestias
                        maxime in nihil unde quaerat cum.</p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="fourth">
                <label for="fourth">Guides</label>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente a earum minus distinctio, optio
                        quam architecto tempora similique cupiditate mollitia modi voluptatem, inventore molestias
                        maxime in nihil unde quaerat cum.</p>
                </div>
            </li>
        </ul>
    </div>


</x-app-layout>
