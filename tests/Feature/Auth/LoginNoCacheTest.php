<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class LoginNoCacheTest extends TestCase
{
    /** @test */
    public function login_page_has_no_cache_headers()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertHeader('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store, private');
        $response->assertHeader('Pragma', 'no-cache');
    }

    /** @test */
    public function root_page_has_no_cache_headers()
    {
        $response = $this->get('/');

        // Se estiver logado pode redirecionar, mas o middleware nocache deve agir na resposta inicial ou final.
        // Como guest deve retornar 200 (login view) ou 302 (se o controller redirecionar)
        // No AuthenticatedSessionController::create(), ele regenera sessão e retorna view ou redirect.

        $response->assertHeader('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store, private');
        $response->assertHeader('Pragma', 'no-cache');
    }
}
