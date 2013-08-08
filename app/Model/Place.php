<?php
App::uses('AppModel', 'Model');
/**
 * Place Model
 *
 */
class Place extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'place';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
}
