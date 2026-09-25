<?php

test('menampilkan statistik terverifikasi pada beranda', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('Destinasi wisata');
    $response->assertSee('Agenda budaya tahun ini');
    $response->assertSee('Ditetapkan Warisan Dunia');
});
