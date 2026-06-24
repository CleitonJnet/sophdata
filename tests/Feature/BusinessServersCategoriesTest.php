<?php

test('servers internal category pages render configured content', function (string $slug, string $title, string $expectedContent) {
    $this->get("/para-empresas/servidores-e-ambientes-corporativos/{$slug}")
        ->assertOk()
        ->assertSee('Voltar para Servidores e Ambientes Corporativos')
        ->assertSee($title)
        ->assertSee('Problemas que essa solucao ajuda a resolver')
        ->assertSee($expectedContent)
        ->assertSee('Observacoes importantes')
        ->assertSee('Outras solucoes de Servidores e Ambientes Corporativos')
        ->assertSee('/para-empresas/contato', false);
})->with([
    ['servidor-de-arquivos', 'Servidor de Arquivos', 'Compartilhamento basico de arquivos'],
    ['active-directory', 'Active Directory', 'Usuarios e permissoes'],
    ['backup-empresarial', 'Backup Empresarial', 'Backup Profissional - 250 GB'],
    ['vpn-e-trabalho-remoto', 'VPN e Trabalho Remoto', 'Usuarios remotos'],
    ['virtualizacao', 'Virtualizacao', 'Maquinas virtuais'],
]);

test('servers backup page renders monthly backup plan details', function () {
    $this->get('/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial')
        ->assertOk()
        ->assertSee('Acompanhamento mensal')
        ->assertSee('Armazenamento')
        ->assertSee('Nivel')
        ->assertSee('Teste de restauracao')
        ->assertSee('Proteger meus dados');
});

test('servers category returns not found for unknown slug', function () {
    $this->get('/para-empresas/servidores-e-ambientes-corporativos/categoria-inexistente')
        ->assertNotFound();
});

test('personal portal remains available after servers category pages', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você');
});
