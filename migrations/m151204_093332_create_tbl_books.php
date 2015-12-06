<?php

use yii\db\Schema;
use yii\db\Migration;

class m151204_093332_create_tbl_books extends Migration
{
    public function up()
    {
        $this->createTable('books', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'date_create' => Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP',
            'date_update' => Schema::TYPE_TIMESTAMP,
            'preview' => Schema::TYPE_STRING,
            'date' => Schema::TYPE_TIMESTAMP,
            'author_id' => Schema::TYPE_INTEGER,
        ]);

        $this->addForeignKey('fk_book_author', 'books', 'author_id', 'authors', 'id');
    }

    public function down()
    {
        $this->dropTable('books');
    }
}
