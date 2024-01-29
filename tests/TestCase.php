<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("delete from kontak_amen");
        DB::delete("delete from kategori_untuk_puans");
        DB::delete("delete from users");
        DB::delete("delete from kategori_suara_puans");
    }
}
