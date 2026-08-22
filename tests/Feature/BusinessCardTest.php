<?php

namespace Tests\Feature;

use Tests\TestCase;

class BusinessCardTest extends TestCase
{
    public function test_business_card_page_shows_contact_data(): void
    {
        $response = $this->get('/businesscard');

        $response->assertStatus(200);
        $response->assertSee('The Palace Team');
        $response->assertSee('Directora General');
        $response->assertSee('THE PALACE HALL');
        $response->assertSee('308-746-4108');
        $response->assertSee('tel:+13087464108', false);
        $response->assertSee('https://wa.me/13087464108', false);
    }

    public function test_vcard_download_has_correct_headers_and_fields(): void
    {
        $response = $this->get('/businesscard/vcard');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/vcard; charset=utf-8');
        $response->assertHeader('Content-Disposition', 'attachment; filename="the-palace-team.vcf"');

        $content = $response->getContent();

        $this->assertStringContainsString('BEGIN:VCARD', $content);
        $this->assertStringContainsString('FN:The Palace Team', $content);
        $this->assertStringContainsString('ORG:THE PALACE HALL', $content);
        $this->assertStringContainsString('TITLE:Directora General', $content);
        $this->assertStringContainsString('TEL;TYPE=CELL:+13087464108', $content);
        $this->assertStringContainsString('URL:', $content);
        $this->assertStringContainsString('END:VCARD', $content);
    }
}
