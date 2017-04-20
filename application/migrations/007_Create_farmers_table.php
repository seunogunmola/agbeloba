<?php

class Migration_Create_farmers_table extends CI_Migration {
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
                        'surname' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'othernames' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'email_address' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'NULL'=>TRUE
                        ),
                        'phone_number' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '11',
                        ),
                        'farm_address' => array(
                                'type' => 'TEXT',
                                'constraint' => '11',
                                'NULL'=>TRUE
                        ),
                        'gps_location' => array(
                                'type' => 'TEXT',
                                'constraint' => '11',
                                'NULL'=>TRUE
                        ),
                        'country_id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                        ),
                        'state_id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                        ),
                        'lga_id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                        ),
                        'produces' => array(
                                'type' => 'TEXT',
                        ),
                        'passport' => array(
                                'type' => 'TEXT',
                                'NULL'=>TRUE
                        ),
                        'status' => array(
                                'type' => 'INT',
                                'constraint' => '1',
                        ),
                        'createdby' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                    'datecreated timestamp default now()',
                    'datemodified timestamp',

                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('t_farmers');
                }

    public function down(){
                $this->dbforge->drop_table('t_farmers');
        }
}
