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
        DB::delete("delete from catatan_haids");
        DB::delete("delete from options");
        DB::delete("delete from questions");
        DB::delete("delete from comment_puans");
        DB::delete("delete from suara_puans");
        DB::delete("delete from roles");
        DB::delete("delete from kontak_amen");
        DB::delete("delete from kategori_untuk_puans");
        DB::delete("delete from kategori_suara_puans");
        DB::delete("delete from users");
    }
}
