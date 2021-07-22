<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class Iugu_CustomerTest extends TestCase
{
    protected function setUp(): void
    {
        Iugu::$endpoint = 'http://api.desenvolvimento';
        Iugu::setApiKey('development_api_token');
    }

    /**
     * @test
     */
    public function should_create_a_customer(): void
    {
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('iugu_customer_should_create_a_customer');

        $customer = Iugu_Customer::create([
            'email' => 'martin@fowler.com',
            'name'  => 'Martin Fowler',
            'notes' => 'Uses emacs',
        ]);

        $this->assertFalse($customer->is_new());
        $this->assertSame('martin@fowler.com', $customer->email);
        $this->assertSame('Martin Fowler', $customer->name);
        $this->assertSame('Uses emacs', $customer->notes);

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    /**
     * @test
     */
    public function should_create_a_customer_with_cpf(): void
    {
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('iugu_customer_should_create_a_customer_with_cpf');

        $customer = Iugu_Customer::create([
            'email'    => 'martin@fowler.com',
            'name'     => 'Martin Fowler',
            'cpf_cnpj' => '648.144.103-01',
        ]);

        $this->assertFalse($customer->is_new());
        $this->assertSame('648.144.103-01', $customer->cpf_cnpj);

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    /**
     * @test
     */
    public function should_create_a_customer_with_cnpj(): void
    {
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('iugu_customer_should_create_a_customer_with_cnpj');

        $customer = Iugu_Customer::create([
            'email'    => 'martin@fowler.com',
            'name'     => 'Martin Fowler Inc',
            'cpf_cnpj' => '57.202.023/6256-27',
        ]);

        $this->assertFalse($customer->is_new());
        $this->assertSame($customer->cpf_cnpj, '57.202.023/6256-27');

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    /**
     * @test
     */
    public function should_create_a_customer_with_full_address(): void
    {
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('iugu_customer_should_create_a_customer_with_full_address');

        $customer = Iugu_Customer::create([
            'email'      => 'john.snow@greatwall.com',
            'name'       => 'John Snow',
            'cpf_cnpj'   => '648.144.103-01',
            'cc_emails'  => 'heisenberg@lospolloshermanos.com',
            'zip_code'   => '29190560',
            'number'     => '8',
            'street'     => 'Rua dos Bobos',
            'city'       => 'São Paulo',
            'state'      => 'SP',
            'district'   => 'Mooca',
            'complement' => '123C',
        ]);

        $this->assertFalse($customer->is_new());
        $this->assertSame('648.144.103-01', $customer->cpf_cnpj);
        $this->assertSame('heisenberg@lospolloshermanos.com', $customer->cc_emails);
        $this->assertSame('29190560', $customer->zip_code);
        $this->assertSame('8', $customer->number);
        $this->assertSame('Rua dos Bobos', $customer->street);
        $this->assertSame('Mooca', $customer->district);
        $this->assertSame('123C', $customer->complement);

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    /**
     * @test
     */
    public function should_raise_error_when_email_is_empty(): void
    {
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('iugu_customer_should_not_create_a_customer_without_email');

        $customer = Iugu_Customer::create(['name' => 'Fred Flintstone']);

        $this->assertSame(2, count($customer->errors['email']));

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }
}
