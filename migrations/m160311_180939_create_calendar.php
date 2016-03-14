<?php

use yii\db\Schema;
use yii\db\Migration;

class m160311_180939_create_calendar extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `tbl_calendar` (
              `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
              `text` TEXT NOT NULL COMMENT '',
              `creator` INT NOT NULL COMMENT '',
              `date_event` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT '',
              PRIMARY KEY (`id`)  COMMENT '',
              INDEX `fk_tbl_calendar_1_idx` (`creator` ASC)  COMMENT '',
            ENGINE = InnoDB CHARACTER SET UTF8
        ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF EXISTS `tbl_calendar`;
        ");
    }
}
