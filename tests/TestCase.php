<?php

namespace Tests;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

use Tests\CreatesApplication;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use CreatesApplication;

    public $baseUrl = 'http://localhost';

}
