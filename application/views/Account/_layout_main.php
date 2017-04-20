<?php
#LOAD HEADER
$this->load->view('Account/_templates/_head');

#LOAD MENU
$this->load->view('Account/_templates/_menu');

#LOAD SUBVIEW
$this->load->view($subview);

#LOAD FOOTER
$this->load->view('Account/_templates/_foot');