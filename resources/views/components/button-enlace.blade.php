@props(['color' => 'red'])

{{-- Para que la variable color sea reconocida como variable, todas las clases de css,
tienen que estar dentro de comillas dobles y aqui yo las cambie, haciendo que las variables se pinten de azul --}}

<button {{ $attributes->merge(['type' => 'button', 'class' => "inline-flex items-center justify-center px-4 py-2 bg-$color-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-$color-500 active:bg-$color-700 focus:outline-none focus:ring-2 focus:ring-$color-500 focus:ring-offset-2 transition ease-in-out duration-150"]) }}>
    {{ $slot }}
</button>

