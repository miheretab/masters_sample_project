<?php
App::uses('AppModel', 'Model');
/**
 * Rating Model
 *
 * @property RatingType $RatingType
 */
class Rating extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'rating';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'value';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Branch' => array(
			'className' => 'Branch',
			'foreignKey' => 'branch_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
