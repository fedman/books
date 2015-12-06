<?php

use yii\db\Schema;
use yii\db\Migration;

class m151204_093324_create_tbl_authors extends Migration
{
    public function up()
    {
        $this->createTable('authors', [
            'id' => Schema::TYPE_PK,
            'firstname' => Schema::TYPE_STRING,
            'lastname' => Schema::TYPE_STRING,
        ]);
        
        $this->insert('authors', ['firstname' => 'Александр', 'lastname' => 'Пушкин']);
        $this->insert('authors', ['firstname' => 'Максим', 'lastname' => 'Горький']);
        $this->insert('authors', ['firstname' => 'Тарас', 'lastname' => 'Шевченко']);
        $this->insert('authors', ['firstname' => 'Анна', 'lastname' => 'Ахматова']);
        $this->insert('authors', ['firstname' => 'Алла', 'lastname' => 'Пугачева']);
    }

    public function down()
    {
        $this->dropTable('authors');
    }
}
