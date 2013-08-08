<?php
App::uses('AppModel', 'Model');
/**
 * Statue Model
 *
 */
class Statue extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'statue';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
}
