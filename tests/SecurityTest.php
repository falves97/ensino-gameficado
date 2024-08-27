<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityTest extends WebTestCase
{
    public function testAdminLoggingSuccess(): void
    {
        $client = static::createClient();
        $credentials = [
            'email' => 'professor@professor.com',
            'password' => 'admin',
        ];

        $client->request('GET', '/admin/login');
        $this->assertResponseIsSuccessful();

        $client->submitForm('Sign in', [
            '_username' => $credentials['email'],
            '_password' => $credentials['password'],
        ]);

        $this->assertResponseRedirects('/admin');
    }

    public function testAdminLoggingFail(): void
    {
        $client = static::createClient();
        $credentials = [
            'email' => 'student@email.com',
            'password' => 'admin',
        ];

        $client->request('GET', '/admin/login');
        $this->assertResponseIsSuccessful();

        $client->submitForm('Sign in', [
            '_username' => $credentials['email'],
            '_password' => $credentials['password'],
        ]);

        $this->assertResponseRedirects('/admin/login');

        $client->followRedirect();
        $this->assertSelectorTextContains('div.alert', 'Invalid credentials.');
    }
}
