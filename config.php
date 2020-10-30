<?php

class Core {
	// Footer created
	static $CREATED = 2012;

	// Meta, css, js
	static $CSS = array();
	static $JS = array();
	static $META = array(
		'title' => 'Spare parts',
		'description' => '',
		'keywords' => ''
	);

	// Skins and modules
	static $SKIN = 'default';
	static $CONT = 'modules';

	// Game
	static $START_HP = 10;
	static $START_INPUT = 1;
	static $END_INPUT = 3;
	static $START_RANDOM_COUNT = 1;
	static $END_RANDOM_COUNT = 3;
	static $START_RANDOM_DAMAGE = 1;
	static $END_RANDOM_DAMAGE = 4;
	static $GAME_OVER_HP = 0;

	// Data Base
	static $DB_NAME = 'main';
	static $DB_LOGIN = 'mysql';
	static $DB_PASS = '';
	static $DB_LOCAL = 'localhost';

	// Domains
	static $DOMAIN = 'http://shabo-test.ru/';
}

?>