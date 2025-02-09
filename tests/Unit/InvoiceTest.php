<?php

namespace Tests\Unit;

use App\Http\Controllers\InvoiceController;
use PHPUnit\Framework\TestCase;

class InvoiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_list()
    {
        $controller = new InvoiceController();
        $this->assertTrue(count($controller->get_category_list()) >= 0);
    }
}
