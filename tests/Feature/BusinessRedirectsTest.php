<?php

test('old business category routes redirect permanently to the new catalog architecture', function (string $oldPath, string $newPath) {
    $this->get($oldPath)
        ->assertStatus(301)
        ->assertRedirect($newPath);
})->with([
    ['/para-empresas/sites-e-sistemas', '/para-empresas/desenvolvimento-de-software'],
    ['/para-empresas/automacao-e-dados', '/para-empresas/desenvolvimento-de-software/automacoes-e-integracoes'],
    ['/para-empresas/suporte-de-ti', '/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal'],
    ['/para-empresas/redes-e-wifi', '/para-empresas/infraestrutura-corporativa-gerenciada/redes-corporativas'],
    ['/para-empresas/seguranca-e-backup', '/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial'],
    ['/para-empresas/computadores-corporativos', '/para-empresas/infraestrutura-corporativa-gerenciada/hardware-corporativo'],
]);

test('personal portal route remains available without redirect', function () {
    $this->get('/para-voce')
        ->assertOk();
});
