<?php

class Migration_Create_Users_Table extends CI_Migration {
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
                        'username' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'password' => array(
                                'type' => 'TEXT'
                        ),
                        'fullname' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'email_address' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'phone_number' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '11',
                        ),
                        'privileges' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'status' => array(
                                'type' => 'INT',
                                'constraint' => '1',
                        ),
                    'datecreated timestamp default now()',
                    'datemodified timestamp',

                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('t_admin_users');
                }

    public function down(){
                $this->dbforge->drop_table('t_admin_users');
        }
}
