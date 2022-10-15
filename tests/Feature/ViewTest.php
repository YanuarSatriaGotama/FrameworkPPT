<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Yanuar');

        $this->get('/hello-again')
            ->assertSeeText('Hello Yanuar');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Yanuar');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Yanuar'])
            ->assertSeeText('Hello Yanuar');

        $this->view('hello.world', ['name' => 'Yanuar'])
            ->assertSeeText('World Yanuar');
    }
}
