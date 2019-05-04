<?php

namespace App\Tests\Controller;

use App\Controller\IndexController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class IndexTest extends TestCase
{
	// simple test function to test that the output is a valid array
    public function testPost_string_arrayOutput()
    {

 		$text = 'Hello World';

        $index = new IndexController();
        $result = $index->post_string($text);

        $this->assertContainsOnly('array', $result  );
    }
}