<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('hello response');
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('Yanuar')->assertSeeText('Satria')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Acun_satria')
            ->assertHeader('App', 'Belajar Laravel');
    }

    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText("Hello Yanuar");
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                "firstName" => 'Yanuar',
                "lastName" => "Satria"
            ]);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'text/html; charset=UTF-8');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('Yanuar.jpg');
    }
}
