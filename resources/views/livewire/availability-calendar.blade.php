<div class="max-w-7xl mx-auto">

    {{-- Solo par apruebas
    @foreach ($events as $event)
        <div>{{ $event->scheduled_at }} {{ $event->name }}</div>
    @endforeach --}}

    {{-- Para la pagina welcome.blade.php (Pagina principal) --}}
    <!-- component -->
    <div class="bg-gray-100 flex items-center justify-center my-6">

        <div class="lg:w-7/12 md:w-9/12 sm:w-10/12 mx-auto p-4">
            <div>
                <h1 class="text-lg mb-2"> Please review the calendar for availability</h1>
            </div>
            <div class="flex gap-4 mb-2 ml-2">
                <div class="flex gap-2">
                    <div class="w-10 text-center py-2 border border-zinc-500 cursor-pointer">.</div>
                    <div class="mt-2">Available</div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 text-center py-2 border border-zinc-500 cursor-pointer bg-blue-500">.</div>
                    <div class="mt-2">SOLD</div>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="flex items-center justify-between px-6 py-3 bg-gray-700">
                    <button id="prevMonth" class="text-white">Previous</button>
                    <h2 id="currentMonth" class="text-white"></h2>
                    <button id="nextMonth" class="text-white">Next</button>
                </div>

                <div class="grid grid-cols-7 gap-2 p-4" id="calendar">
                    <!-- Calendar Days Go Here -->
                </div>

                <!-- Modal -->
                <div id="myModal" class="modal hidden fixed inset-0 flex items-center justify-center z-50">
                    <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

                    <div
                        class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                        <div class="modal-content py-4 text-left px-6">
                            <div class="flex justify-between items-center pb-3">
                                <p class="text-2xl font-bold">Selected Date</p>
                                <button id="closeModal"
                                    class="modal-close px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring">✕</button>
                            </div>
                            <div id="modalDate" class="text-xl font-semibold"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- SOLO PARA PRUEBAS
    <div>
        <h1 id="demo" value="12">Solo para pruebas</h1>
    </div> --}}

    {{-- SOLO PARA PRUEBAS
    <div>
        <div>
            <x-button class="bg-pink-400 hover:bg-pink-300 text-white font-bold py-2 px-4 rounded"
                wire:click="provando">Testing...</x-button>
        </div>
    </div> --}}

</div>


{{-- $wire.on('envio-eventos', (event) => {
                    let data = event.eventos;
                    console.log(data);
                }); --}}


{{-- // Is working with parametes
                Livewire.on('envio-eventos', eventos => {
                    console.log('Todos los eventos');
                    //alert('Id del evento:', eventos);
                }); --}}


{{-- // Is working with parametes, es un buen ejemplo, esta a la escucha
                document.addEventListener('livewire:init', function() {
                    Livewire.on('envio-eventos', events => {
                        //valor = eventId;
                        alert('Numero del evento: ' + events);
                        //calendar.render();
                        //$("#calendar").fullCalendar('render');
                    });
                }); --}}


<script>
    // Function to generate the calendar for a specific month and year
    function generateCalendar(year, month, allEvents) {
        // Obtiene las fechas de todos los eventos
        let daysOfEvents = allEvents;

        // Solo para pruebas
        // alert('Numero del evento Parte 2: ' + allEvents);

        const calendarElement = document.getElementById('calendar');
        const currentMonthElement = document.getElementById('currentMonth');

        // Create a date object for the first day of the specified month
        const firstDayOfMonth = new Date(year, month, 1);
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Clear the calendar
        calendarElement.innerHTML = '';

        // Set the current month text
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
            'September',
            'October', 'November', 'December'
        ];
        currentMonthElement.innerText = `${monthNames[month]} ${year}`;

        // Calculate the day of the week for the first day of the month (0 - Sunday, 1 - Monday, ..., 6 - Saturday)
        const firstDayOfWeek = firstDayOfMonth.getDay();

        // Create headers for the days of the week
        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        daysOfWeek.forEach(day => {
            const dayElement = document.createElement('div');
            dayElement.className = 'text-center font-semibold';
            dayElement.innerText = day;
            calendarElement.appendChild(dayElement);
        });

        // Create empty boxes for days before the first day of the month
        for (let i = 0; i < firstDayOfWeek; i++) {
            const emptyDayElement = document.createElement('div');
            calendarElement.appendChild(emptyDayElement);
        }


        // Create boxes for each day of the month
        for (let day = 1; day <= daysInMonth; day++) {

            const dayElement = document.createElement('div');
            dayElement.className = 'text-center py-2 border cursor-pointer';
            dayElement.innerText = day;


            // Yo agregue esto   #####################################
            //let daysOfEvents = ["2024-07-01", "2024-07-06", "2024-07-09", "2024-08-13", "2024-10-25", "2024-12-31"];
            let length = daysOfEvents.length;

            for (let nEventos = 0; nEventos < length; nEventos++) {
                let currentDate = new Date(daysOfEvents[nEventos]);

                //########################################################

                // Check if this date is the current date, ORIGINAL
                //const currentDate = new Date();
                if (year === currentDate.getFullYear() && month === currentDate.getUTCMonth() && day ===
                    currentDate.getUTCDate()
                    ) { // IMPORTANTE SE USO: getUTCDate() en lugar de getDate Y getUTCMonth en lugar de getMonth,
                    // para obter apropiadamente el dia y mes de la fecha guardada en la base de datos
                    // de lo contrario fallaba por un dia y un mes la fecha
                    dayElement.classList.add('bg-blue-500', 'text-white'); // Add classes for the indicator
                }

                calendarElement.appendChild(dayElement);

            }
        }
    }

    //############### Initialize the calendar with the current month and year ############

    const currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();
    var allEvents;

    // Is working with parametes, esta a la escucha,
    // los datos provienen del componete de livewire
    document.addEventListener('livewire:init', function() {
        Livewire.on('envio-eventos', eventos => {

            //let fecha = new Date()
            //console.log(fecha.getDate());

            allEvents = eventos[0];

            //alert('Numero del evento Parte 1: ' + fecha.getDate());
            //document.getElementById("demo").innerHTML = allEvents;
            generateCalendar(currentYear, currentMonth, allEvents);
        });
    });

    // Event listeners for previous and next month buttons
    document.getElementById('prevMonth').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentYear, currentMonth, allEvents);
    });


    document.getElementById('nextMonth').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentYear, currentMonth, allEvents);
    });

    // Function to show the modal with the selected date
    function showModal(selectedDate) {
        const modal = document.getElementById('myModal');
        const modalDateElement = document.getElementById('modalDate');
        modalDateElement.innerText = selectedDate;
        modal.classList.remove('hidden');
    }

    // Function to hide the modal
    function hideModal() {
        const modal = document.getElementById('myModal');
        modal.classList.add('hidden');
    }

    // Event listener for date click events
    const dayElements = document.querySelectorAll('.cursor-pointer');
    dayElements.forEach(dayElement => {
        dayElement.addEventListener('click', () => {
            const day = parseInt(dayElement.innerText);
            const selectedDate = new Date(currentYear, currentMonth, day);
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const formattedDate = selectedDate.toLocaleDateString(undefined, options);
            showModal(formattedDate);
        });
    });

    // Event listener for closing the modal
    document.getElementById('closeModal').addEventListener('click', () => {
        hideModal();
    });
</script>

</div>
