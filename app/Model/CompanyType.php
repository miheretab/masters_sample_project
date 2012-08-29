<?php
App::uses('AppModel', 'Model');
/**
 * CompanyType Model
 *
 * @property User $User
 */
class CompanyType extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'company_type';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'type';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'company_type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
