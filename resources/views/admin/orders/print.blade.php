
@extends('layouts.my')
@section('content')

    {{-- USADO PARA IMPRIMIR ATRAVEZ DE LA IMPRESORA SI funciona --}}

        <br><br>
        <a href="{{ route('admin.order.print',$order) }}" class="btnprn btn">Print Preview</a>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.btnprn').printPage();
        });
    </script>

    <div class="text-center">
        <h1>{{$order->contact}}</h1>
        <h1>{{$order->phone}}</h1>
    </div>
@endsection
