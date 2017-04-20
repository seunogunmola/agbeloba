<?php
#LOAD HEADER
$this->load->view('Administrator/_templates/_head');

#LOAD MENU
$this->load->view('Administrator/_templates/_menu');

#LOAD SUBVIEW
$this->load->view($subview);

#LOAD FOOTER
$this->load->view('Administrator/_templates/_foot');