<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Yanuar')
            ->assertSeeText('Hello Yanuar');

        $this->post('/input/hello', [
            'name' => 'Yanuar'
        ])->assertSeeText('Hello Yanuar');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Yanuar",
                "last" => "Satria"
            ]
        ])->assertSeeText("Hello Yanuar");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Yanuar",
                "last" => "Satria"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Yanuar")
            ->assertSeeText("Satria");
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 30000000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 15000000
                ]
            ]
        ])->assertSeeText("Apple Mac Book Pro")
            ->assertSeeText("Samsung Galaxy S10");
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Budi',
            'married' => 'true',
            'birth_date' => '1990-10-10'
        ])->assertSeeText('Budi')->assertSeeText("true")->assertSeeText("1990-10-10");
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Yanuar",
                "middle" => "Eka Candra",
                "last" => "Satria"
            ]
        ])->assertSeeText("Yanuar")->assertDontSeeText("Eka Candra");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "Yanuar",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("Yanuar")->assertSeeText("rahasia")
            ->assertDontSeeText("admin");
    }


    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "Yanuar",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("Yanuar")->assertSeeText("rahasia")
            ->assertSeeText("admin")->assertSeeText("false");
    }
}
