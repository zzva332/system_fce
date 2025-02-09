<?php

namespace Tests\Unit;

use App\Http\Controllers\ClientController;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_client_type_ids_allowed()
    {
        $controller = new ClientController();

        $result = $controller->get_type_id_list();

        $this->assertCount(3, $result);
    }
}
