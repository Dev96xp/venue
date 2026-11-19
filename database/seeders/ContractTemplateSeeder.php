<?php

namespace Database\Seeders;

use App\Models\ContractTemplate;
use Illuminate\Database\Seeder;

/**
 * Plantilla base del contrato de renta del salón (Omaha, Nebraska).
 *
 * IMPORTANTE: este texto es un punto de partida. Debe ser revisado por un
 * abogado con licencia en Nebraska antes de usarse con clientes reales.
 * Se puede editar desde Admin > Contracts > Templates.
 *
 * Uso: php artisan db:seed --class=ContractTemplateSeeder
 */
class ContractTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $existing = ContractTemplate::where('name', 'Venue Rental Agreement')->get();

        if ($existing->isNotEmpty()) {
            // Agregar la versión en español a la plantilla que aún no la tiene
            $existing->whereNull('body_es')->each->update(['body_es' => self::bodyEs()]);
            return;
        }

        ContractTemplate::create([
            'name' => 'Venue Rental Agreement',
            'version' => 1,
            'is_active' => true,
            'body' => self::body(),
            'body_es' => self::bodyEs(),
        ]);
    }

    public static function bodyEs(): string
    {
        return <<<'MD'
# CONTRATO DE RENTA DEL SALÓN

**Contrato No.:** {contract_code}
**Fecha:** {contract_date}

> **Aviso:** Esta traducción al español se proporciona solo como referencia. En caso de cualquier diferencia o conflicto entre esta traducción y la versión en inglés, **prevalecerá la versión en inglés**.

Este Contrato de Renta del Salón ("Contrato") se celebra entre **{venue_name}**, ubicado en {venue_address} ("el Salón"), y **{client_name}** ("el Cliente"), con domicilio en {client_address}, teléfono {client_phone}, correo electrónico {client_email}. El Salón y el Cliente son cada uno una "Parte" y en conjunto "las Partes".

## 1. Detalles del Evento

- **Tipo de evento:** {event_type}
- **Fecha del evento:** {event_date}
- **Horario de renta:** de {start_time} a {end_time} (incluye montaje y limpieza, salvo que se indique otra cosa en los Términos Especiales)
- **Área rentada:** {room}
- **Número máximo de invitados:** {guest_count}
- **Servicios incluidos:** {services}

El acceso a las instalaciones se limita al horario de renta indicado. La entrada anticipada o la salida tardía deben ser aprobadas por escrito por el Salón y están sujetas a los cargos por tiempo extra de la Sección 6.

## 2. Precio y Calendario de Pagos

- **Precio total de la renta:** {rental_fee}
- **Depósito de reservación (no reembolsable):** {deposit_amount}, se paga al firmar
- **Saldo pendiente:** {balance_due}, a más tardar el {balance_due_date}
- **Depósito de seguridad / por daños (reembolsable):** {security_deposit}, se paga junto con el saldo pendiente

La fecha del evento queda reservada únicamente cuando este Contrato haya sido firmado por ambas Partes **y** se haya recibido el depósito de reservación. El depósito de reservación **no es reembolsable**, ya que el Salón retira la fecha del mercado y rechaza otras reservaciones confiando en este Contrato.

Si el saldo pendiente no se paga completo en la fecha límite, el Salón podrá, previo aviso por escrito al Cliente, considerar la reservación como cancelada por el Cliente conforme a la Sección 3. Los pagos devueltos o rechazados tendrán un cargo de $35.00. Los impuestos sobre ventas aplicables, si los hay, son responsabilidad del Cliente.

## 3. Cancelación por parte del Cliente

Toda cancelación debe hacerse **por escrito**. Se aplicará el siguiente calendario según la fecha en que el Salón reciba el aviso por escrito:

- **Más de 180 días antes del evento:** el Cliente pierde únicamente el depósito de reservación.
- **Entre 90 y 180 días antes del evento:** el Cliente pierde el depósito de reservación más el 50% del resto del precio de la renta.
- **Menos de 90 días antes del evento:** el Cliente pierde el 100% del precio total de la renta.

Las Partes acuerdan que estas cantidades son una estimación razonable de los daños del Salón por reservaciones perdidas, los cuales son difíciles de calcular, y no constituyen una penalización. El depósito de seguridad se reembolsará completo en caso de cancelación.

**Cambio de fecha:** se puede solicitar un cambio de fecha por escrito, por una sola vez, al menos 120 días antes del evento, sujeto a disponibilidad. Los pagos ya realizados se aplicarán a la nueva fecha. La nueva fecha debe estar dentro de los 12 meses siguientes a la fecha original. Un cambio de fecha solicitado después se tratará como una cancelación.

## 4. Cancelación por parte del Salón; Fuerza Mayor

Ninguna de las Partes será responsable por incumplimiento causado por hechos fuera de su control razonable, incluyendo clima severo, desastres naturales, incendio, inundación, fallas en servicios públicos, epidemia o pandemia, órdenes o restricciones gubernamentales, actos de terrorismo o disturbios civiles ("Fuerza Mayor"). En tal caso, el Salón ofrecerá al Cliente (a) una nueva fecha disponible dentro de los siguientes 12 meses, aplicando todos los pagos realizados, o (b) si no hay una fecha aceptable disponible, el reembolso de los pagos realizados, menos cualquier costo no reembolsable de terceros ya generado para el evento.

Si el Salón cancela por cualquier motivo distinto a Fuerza Mayor o incumplimiento del Cliente, el Salón reembolsará todos los pagos recibidos. **La responsabilidad total del Salón bajo este Contrato no excederá la cantidad total pagada por el Cliente.**

## 5. Depósito de Seguridad y Daños

El depósito de seguridad se devolverá dentro de los catorce (14) días posteriores al evento, menos las deducciones por: daños a las instalaciones, mobiliario o equipo; artículos faltantes; limpieza excesiva; tiempo extra; violación de las reglas del Salón; o cualquier saldo no pagado. El Cliente es responsable de todos los daños causados por el Cliente, sus invitados y proveedores, **incluyendo los daños que excedan el monto del depósito de seguridad.** El Salón entregará un estado de cuenta detallado de cualquier deducción.

## 6. Horario, Tiempo Extra y Ruido

El evento debe terminar y todos los invitados y proveedores deben retirarse al final del horario de renta. Cada hora adicional o fracción se cobrará a {overtime_rate} y podrá descontarse del depósito de seguridad. El Cliente y sus invitados deben cumplir con los reglamentos de ruido de la Ciudad de Omaha. El Salón podrá bajar el volumen de la música o detener el evento si así lo exige la ley o un oficial de policía o de bomberos.

## 7. Capacidad y Seguridad

El número de personas en las instalaciones no puede exceder el número de invitados indicado arriba ni la capacidad máxima establecida por el Departamento de Bomberos de Omaha, lo que sea menor. Las salidas de emergencia deben permanecer despejadas en todo momento. El Salón podrá negar la entrada a personas adicionales o terminar el evento si se violan las reglas de capacidad o seguridad, sin reembolso.

## 8. Alcohol

Las bebidas alcohólicas solo pueden ser servidas por un bartender o servicio de banquetes **con licencia conforme a la Ley de Control de Licores de Nebraska (Nebraska Liquor Control Act)** y aprobado por el Salón. Se prohíbe el alcohol externo que no sea servido por dicho proveedor con licencia. No se puede servir alcohol a ninguna persona menor de 21 años ni a ninguna persona visiblemente intoxicada, y se debe verificar la identificación. El Salón o el bartender pueden suspender el servicio de alcohol en cualquier momento. El servicio de alcohol debe terminar al menos 30 minutos antes del final del horario de renta. El Cliente acepta toda la responsabilidad por la conducta de sus invitados relacionada con el alcohol.

## 9. Seguro

El Cliente debe obtener una póliza de **seguro de responsabilidad civil general para eventos especiales** con límites de al menos **$1,000,000 por incidente**, que incluya responsabilidad por servicio de licor del anfitrión (host liquor liability) si se sirve alcohol, nombrando a **{venue_name}** como asegurado adicional. Se debe entregar un certificado de seguro al Salón al menos catorce (14) días antes del evento. El Salón podrá cancelar el evento conforme a la Sección 3 si no recibe el certificado.

## 10. Indemnización y Liberación de Responsabilidad

En la máxima medida permitida por las leyes de Nebraska, el Cliente acepta **indemnizar, defender y liberar de responsabilidad** al Salón, sus propietarios, empleados y agentes frente a cualquier reclamación, daño, pérdida, lesión o gasto (incluyendo honorarios razonables de abogados) que surja del evento o de los actos u omisiones del Cliente, sus invitados o proveedores, excepto en la medida en que sean causados por negligencia grave o mala conducta intencional del Salón.

## 11. Proveedores

Todos los proveedores externos (banquetes, decoración, DJ, fotografía, etc.) deben ser aprobados por el Salón, contar con su propio seguro de responsabilidad civil, seguir las reglas del Salón y completar su montaje y retiro dentro del horario de renta. El Cliente es responsable de sus proveedores y de cualquier daño que causen.

## 12. Decoración y Reglas del Salón

Se **prohíbe**: confeti, diamantina (glitter), arroz, alpiste, máquinas de humo o niebla (salvo aprobación por escrito), fuego abierto excepto velas encapsuladas, fuegos artificiales o bengalas dentro del edificio, y clavos, grapas, cinta o adhesivos en paredes, techos o mobiliario. Se prohíbe fumar y vapear dentro del edificio, conforme a la Ley de Aire Limpio en Interiores de Nebraska (Nebraska Clean Indoor Air Act). Se prohíben drogas ilegales y armas. Toda la decoración debe retirarse antes del final del horario de renta. Por cualquier violación se descontará un cargo de limpieza del depósito de seguridad.

## 13. Conducta

El Cliente es responsable de la conducta de todos sus invitados. El Salón podrá retirar a cualquier persona, o terminar el evento sin reembolso, si hay comportamiento desordenado, ilegal o peligroso, o si se violan gravemente las reglas del Salón.

## 14. Bienes Personales

El Salón **no se hace responsable** por la pérdida, robo o daño de bienes personales, regalos o equipo del Cliente, sus invitados o proveedores, antes, durante o después del evento. Los artículos olvidados se guardarán durante siete (7) días y después se desecharán.

## 15. Fotografía y Mercadotecnia

El Salón podrá fotografiar el montaje del evento (sin identificar a los invitados) con fines de mercadotecnia, a menos que el Cliente ponga sus iniciales aquí: ______ para no aceptarlo.

## 16. Términos Especiales

{special_terms}

## 17. Disposiciones Generales

- **Ley aplicable:** Este Contrato se rige por las leyes del Estado de Nebraska. Cualquier acción legal deberá presentarse ante los tribunales del Condado de Douglas, Nebraska.
- **Honorarios de abogados:** Si se requiere una acción legal para hacer cumplir este Contrato, la Parte que prevalezca podrá recuperar los honorarios razonables de abogados y costos.
- **Acuerdo completo:** Este Contrato es el acuerdo completo entre las Partes y sustituye cualquier conversación previa. Los cambios deben hacerse por escrito y estar firmados por ambas Partes.
- **Divisibilidad:** Si alguna disposición se considera inaplicable, las demás disposiciones seguirán vigentes.
- **Cesión:** El Cliente no puede transferir este Contrato sin el consentimiento por escrito del Salón.
- **Firmas electrónicas:** Las Partes acuerdan que este Contrato puede firmarse electrónicamente y que las firmas y copias electrónicas tienen el mismo efecto que los originales, según lo permite la Ley Uniforme de Transacciones Electrónicas de Nebraska (Nebraska Uniform Electronic Transactions Act).
- **Idioma:** Este Contrato se firma en inglés. Esta traducción al español es solo de referencia; en caso de conflicto, prevalece la versión en inglés.

Al firmar a continuación, el Cliente confirma que ha leído, entiende y acepta todos los términos de este Contrato.
MD;
    }

    public static function body(): string
    {
        return <<<'MD'
# VENUE RENTAL AGREEMENT

**Contract No.:** {contract_code}
**Date:** {contract_date}

This Venue Rental Agreement ("Agreement") is entered into between **{venue_name}**, located at {venue_address} ("Venue"), and **{client_name}** ("Client"), residing at {client_address}, phone {client_phone}, email {client_email}. The Venue and the Client are each a "Party" and together the "Parties."

## 1. Event Details

- **Type of event:** {event_type}
- **Event date:** {event_date}
- **Rental period:** {start_time} to {end_time} (including setup and cleanup unless otherwise stated in Special Terms)
- **Area rented:** {room}
- **Maximum number of guests:** {guest_count}
- **Included services:** {services}

Access to the premises is limited to the rental period above. Early access or late departure must be approved in writing by the Venue and is subject to the overtime charges in Section 6.

## 2. Fees and Payment Schedule

- **Total rental fee:** {rental_fee}
- **Reservation deposit (non-refundable):** {deposit_amount}, due at signing
- **Remaining balance:** {balance_due}, due no later than {balance_due_date}
- **Security / damage deposit (refundable):** {security_deposit}, due with the remaining balance

The event date is reserved only after this Agreement is signed by both Parties **and** the reservation deposit has been received. The reservation deposit is **non-refundable** because the Venue removes the date from the market and declines other bookings in reliance on this Agreement.

If the remaining balance is not paid in full by the due date, the Venue may, after written notice to the Client, treat the reservation as cancelled by the Client under Section 3. Payments returned or declined are subject to a $35.00 fee. Applicable sales taxes, if any, are the responsibility of the Client.

## 3. Cancellation by Client

All cancellations must be made **in writing**. The following schedule applies based on the date the Venue receives written notice:

- **More than 180 days before the event:** the Client forfeits the reservation deposit only.
- **Between 90 and 180 days before the event:** the Client forfeits the reservation deposit plus 50% of the remaining rental fee.
- **Less than 90 days before the event:** the Client forfeits 100% of the total rental fee.

The Parties agree that these amounts are a reasonable estimate of the Venue's damages from lost bookings, which are difficult to calculate, and are not a penalty. The security deposit will be refunded in full upon cancellation.

**Date change:** one date change may be requested in writing at least 120 days before the event, subject to availability. Payments already made will be applied to the new date. The new date must be within 12 months of the original date. A date change requested later is treated as a cancellation.

## 4. Cancellation by Venue; Force Majeure

Neither Party will be liable for failure to perform caused by events beyond its reasonable control, including severe weather, natural disasters, fire, flood, utility failure, epidemic or pandemic, government orders or restrictions, acts of terrorism, or civil unrest ("Force Majeure"). In such a case, the Venue will offer the Client (a) a new available date within 12 months, applying all payments made, or (b) if no acceptable date is available, a refund of payments made, less any non-refundable third-party costs already incurred for the event.

If the Venue cancels for any reason other than Force Majeure or Client breach, the Venue will refund all payments received. **The Venue's total liability under this Agreement shall not exceed the total amount paid by the Client.**

## 5. Security Deposit and Damages

The security deposit will be returned within fourteen (14) days after the event, less deductions for: damage to the premises, furniture, or equipment; missing items; excess cleaning; overtime; violation of Venue rules; or any unpaid balance. The Client is responsible for all damage caused by the Client, guests, and vendors, **including damage exceeding the security deposit amount.** The Venue will provide an itemized statement of any deductions.

## 6. Hours, Overtime, and Noise

The event must end and all guests and vendors must leave by the end of the rental period. Each additional hour or portion thereof will be charged at {overtime_rate}, and may be deducted from the security deposit. The Client and guests must comply with the City of Omaha noise ordinances. The Venue may lower the music volume or stop the event if required by law or by a police or fire official.

## 7. Capacity and Safety

The number of people on the premises may not exceed the guest count above or the maximum occupancy set by the Omaha Fire Department, whichever is lower. Fire exits must remain clear at all times. The Venue may refuse entry to additional persons or end the event if capacity or safety rules are violated, with no refund.

## 8. Alcohol

Alcoholic beverages may only be served by a bartender or caterer **licensed under the Nebraska Liquor Control Act** and approved by the Venue. Outside alcohol not served by such a licensed provider is prohibited. Alcohol may not be served to any person under 21 years of age or to any person who is visibly intoxicated, and identification must be checked. The Venue or the bartender may stop alcohol service at any time. Alcohol service must end at least 30 minutes before the end of the rental period. The Client accepts full responsibility for the conduct of guests related to alcohol.

## 9. Insurance

The Client must obtain a **special event general liability insurance** policy with limits of at least **$1,000,000 per occurrence**, including host liquor liability if alcohol is served, naming **{venue_name}** as an additional insured. A certificate of insurance must be delivered to the Venue at least fourteen (14) days before the event. The Venue may cancel the event under Section 3 if the certificate is not received.

## 10. Indemnification and Release

To the fullest extent permitted by Nebraska law, the Client agrees to **indemnify, defend, and hold harmless** the Venue, its owners, employees, and agents from and against any claims, damages, losses, injuries, or expenses (including reasonable attorney fees) arising from the event, or from the acts or omissions of the Client, guests, or vendors, except to the extent caused by the gross negligence or willful misconduct of the Venue.

## 11. Vendors

All outside vendors (catering, decoration, DJ, photography, etc.) must be approved by the Venue, carry their own liability insurance, follow Venue rules, and complete setup and removal within the rental period. The Client is responsible for its vendors and for any damage they cause.

## 12. Decorations and Venue Rules

The following are **prohibited**: confetti, glitter, rice, birdseed, fog or smoke machines (unless approved in writing), open flames other than enclosed candles, fireworks or sparklers inside the building, nails, staples, tape, or adhesives on walls, ceilings, or furniture. Smoking and vaping are prohibited inside the building as required by the Nebraska Clean Indoor Air Act. Illegal drugs and weapons are prohibited. All decorations must be removed by the end of the rental period. A cleaning fee will be deducted from the security deposit for violations.

## 13. Conduct

The Client is responsible for the conduct of all guests. The Venue may remove any person, or end the event without refund, if there is disorderly, illegal, or dangerous behavior, or if the Venue's rules are seriously violated.

## 14. Personal Property

The Venue is **not responsible** for loss, theft, or damage to personal property, gifts, or equipment belonging to the Client, guests, or vendors, before, during, or after the event. Items left behind will be held for seven (7) days and then disposed of.

## 15. Photography and Marketing

The Venue may photograph the event setup (without identifying guests) for marketing purposes unless the Client initials here: ______ to opt out.

## 16. Special Terms

{special_terms}

## 17. General Provisions

- **Governing law:** This Agreement is governed by the laws of the State of Nebraska. Any legal action shall be brought in the courts of Douglas County, Nebraska.
- **Attorney fees:** If legal action is needed to enforce this Agreement, the prevailing Party may recover reasonable attorney fees and costs.
- **Entire agreement:** This Agreement is the entire agreement between the Parties and replaces any prior discussions. Changes must be in writing and signed by both Parties.
- **Severability:** If any provision is found unenforceable, the remaining provisions remain in effect.
- **Assignment:** The Client may not transfer this Agreement without the Venue's written consent.
- **Electronic signatures:** The Parties agree that this Agreement may be signed electronically and that electronic signatures and copies have the same effect as originals, as permitted by the Nebraska Uniform Electronic Transactions Act.
- **Language:** This Agreement is executed in English. Any Spanish translation is provided for reference only; in case of conflict, the English version controls.

By signing below, the Client confirms that they have read, understand, and agree to all terms of this Agreement.
MD;
    }
}
