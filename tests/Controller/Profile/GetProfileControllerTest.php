<?php

declare(strict_types=1);

namespace App\Tests\Controller\Profile;

use App\Tests\TestCase\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class GetProfileControllerTest extends WebTestCase
{
    public function testResponse(): void
    {
        $client = $this->createAnonymousApiClient();
        $client->request('GET', '/api/profiles/user1');

        $response = $client->getResponse();
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('profile', $data);
    }
}
