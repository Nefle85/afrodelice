<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ContactControllerTest extends WebTestCase
{
    public function testIndexPageLoadsCorrectly()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Contactez-nous');
    }

    public function testFormSubmission()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact');

        $form = $crawler->selectButton('Envoyer')->form([
            'contact[firstname]' => 'John',
            'contact[lastname]' => 'Doe',
            'contact[subject]' => 'Résa',
            'contact[email]' => 'john.doe@example.com',
            'contact[message]' => 'Hello, this is a test message.',
        ]);

        $client->submit($form);

        // Vérifie que la soumission du formulaire redirige vers la même page
        $this->assertResponseRedirects('/contact');

        // Suivre la redirection
        $client->followRedirect();

        // Vérifie que le message flash de succès est affiché
        $this->assertSelectorTextContains('.flash-success', 'Your message has been sent successfully!');
}
        
    }

