<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class BusinessCardController extends Controller
{
    private function data(): array
    {
        return [
            'name' => 'The Palace Team',
            'title' => 'Directora General',
            'company' => 'THE PALACE HALL',
            'phone' => '308-746-4108',
            'phone_tel' => '+13087464108',
            'phone_wa' => '13087464108',
        ];
    }

    public function show()
    {
        return view('businesscard.show', $this->data());
    }

    public function vcard()
    {
        $data = $this->data();

        $vcard = implode("\r\n", [
            'BEGIN:VCARD',
            'VERSION:3.0',
            'FN:'.$data['name'],
            'ORG:'.$data['company'],
            'TITLE:'.$data['title'],
            'TEL;TYPE=CELL:'.$data['phone_tel'],
            'URL:'.route('home'),
            'END:VCARD',
        ]);

        $filename = Str::slug($data['name']).'.vcf';

        return response($vcard, 200, [
            'Content-Type' => 'text/vcard; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }
}
