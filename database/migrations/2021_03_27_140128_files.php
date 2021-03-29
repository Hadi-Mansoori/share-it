<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Files extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE IF NOT EXISTS `files` (
              `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
              `user_id` BIGINT(20) NOT NULL,
              `created_at` TIMESTAMP NULL DEFAULT NULL,
              `updated_at` TIMESTAMP  NULL DEFAULT NULL,
              `name` VARCHAR(255) COLLATE utf8_unicode_ci NULL DEFAULT NULL,
              `standard_name` VARCHAR(255) COLLATE utf8_unicode_ci NULL DEFAULT NULL,
              `size` DOUBLE  NULL DEFAULT NULL,
              `type` VARCHAR(45) COLLATE utf8_unicode_ci  NULL DEFAULT NULL,
              `path` VARCHAR(500) COLLATE utf8_unicode_ci  NULL DEFAULT NULL ,
              `unique_code` VARCHAR(45) COLLATE utf8_unicode_ci  NULL DEFAULT NULL ,
              `download_count` BIGINT(20)  NULL DEFAULT NULL ,
              PRIMARY KEY (`id`, `user_id`),
              INDEX `fk_files_users_idx` (`user_id` ASC) ,
              CONSTRAINT `fk_files_users`
                FOREIGN KEY (`user_id`)
                REFERENCES `users` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE)
            ENGINE = InnoDB
            DEFAULT CHARACTER SET = utf8
            COLLATE = utf8_unicode_ci
        "
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
