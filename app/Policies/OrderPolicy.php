<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/* Policy - Uso: Crea un metodo de autorizacion para orotejer ciertas rutas, asociado a un modelo
            por convencion el nombre de la policy empienza con el nombre del modelo, seguido por
            la palabra policy.
            Para evitar que que otras personas que no son los dueños de una orden,
            esta las modifique o las altere
*/

class OrderPolicy
{
    use HandlesAuthorization;
    // DEFINIENDO UNA POLICY
    // La policy necesita un parametro,
    // a) Parametro: (user) para saber que usuario esta autentificado
    // b) segundo parametro: la orden que queremos saber si el, es el autor ?
    // c) Esta policy tiene que devolver un valor que es: falso o verdadero

    // d) Si se retorna: (true), te permitira ver la orden del usuario
    // e) Si se retorna:(false), NO te permitira ver la orden del usuario

    public function author(User $user, Order $order){

        // Por tanto: Si la orden fue craeda por un usuario, y este usuario esta guardado en el campo:(user_id) de la orden,
        // vamos a PREGUNTAR si ese valor ( user_id ) coincide, con el con el id del usuario que actualmente esta intentando
        // ver esta orden. Y si eso es cierto que retorne el valor de: (true) y en caso contrario el valor de (false)

        if ($order->user_id == $user->id) {
            return true;
        }else{
            return false;
        }

        // WOW works !!!
    }

    // Esta policy: Evitara que regreses a esta pagina y vuelvas a pagar por segunda vez, si YA esta pagado
    public function payment(User $user, Order $order){

        // Solo si el estatus de la orden es igual a: dos q significa (RECIVIDO), QUE SE PERMITA EL PASO, CASO CONTRARIO
        // SE PROHIBA EL PASO

        if ($order->status == 2) {
            return false;
        }else{
            return true;
        }
    }
}
