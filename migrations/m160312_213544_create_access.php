<?php

use yii\db\Schema;
use yii\db\Migration;

class m160312_213544_create_access extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `tbl_access` (
              `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
              `calendar_id` INT NOT NULL COMMENT '',
              `user_owner` INT NOT NULL COMMENT '',
              `user_guest` INT NOT NULL COMMENT '',
              `date` DATE NOT NULL COMMENT '',
              PRIMARY KEY (`id`)  COMMENT '',
              INDEX `fk_tbl_access_1_idx` (`user_owner` ASC)  COMMENT '',
              INDEX `fk_tbl_access_2_idx` (`user_guest` ASC)  COMMENT '',
              INDEX `fk_tbl_access_3_idx` (`calendar_id` ASC)  COMMENT '')
            ENGINE = InnoDB CHARACTER SET UTF8
        ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF EXISTS `tbl_access`;
        ");
    }
}
