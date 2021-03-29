<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
                      CREATE TABLE IF NOT EXISTS `share-it`.`users` (
                          `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
                          `created_at` TIMESTAMP NULL DEFAULT NULL,
                          `updated_at` TIMESTAMP NULL DEFAULT NULL,
                          `name` VARCHAR(255) NULL DEFAULT NULL,
                          `password` VARCHAR(65) NULL DEFAULT NULL,
                          `email` VARCHAR(255) NULL DEFAULT NULL,
                          `first_name` VARCHAR(45) NULL DEFAULT NULL,
                          `last_name` VARCHAR(45) NULL DEFAULT NULL,
                          `remember_token` VARCHAR(255) NULL DEFAULT NULL,
                          PRIMARY KEY (`id`),
                          UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
                          UNIQUE INDEX `name_UNIQUE` (`name` ASC))
                        ENGINE = InnoDB
                        DEFAULT CHARACTER SET = utf8
                        COLLATE = utf8_unicode_ci"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
