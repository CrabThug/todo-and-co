<?php


namespace App\Tests;


trait ConnexionTrait
{
    private $client;
    private $crawler;

    public function login($user,$password)
    {
        $this->client = static::createClient();
        $this->client->followRedirects();
        $this->crawler = $this->client->request('GET', '/');
        $form = $this->crawler->selectButton('Se connecter')->form();
        $form['_username'] = $user;
        $form['_password'] = $password;
        $this->client->submit($form);
    }

    public function logout()
    {
        $link = $this->crawler->selectLink('Se déconnecter');
        $this->client->submit($link);
    }
}
