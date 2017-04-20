<?php

class Migration_Create_produce_types_table extends CI_Migration {
    public function up(){
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'uniqueid' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '12',
                        ),
                        'produce_category_id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'produce_type_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'createdby' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                    'datecreated timestamp default now()',
                    'datemodified timestamp',

                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('t_produce_types');
                }

    public function down(){
                $this->dbforge->drop_table('t_produce_types');
        }
}
