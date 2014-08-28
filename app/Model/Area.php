<?php
App::uses('AppModel', 'Model');
/**
 * Area Model
 *
 * @property Profesor $Profesor
 * @property Usuario $Usuario
 */
class Area extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'area';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Profesor' => array(
			'className' => 'Profesor',
			'joinTable' => 'profesor_area',
			'foreignKey' => 'area_id',
			'associationForeignKey' => 'profesor_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'joinTable' => 'usuario_area',
			'foreignKey' => 'area_id',
			'associationForeignKey' => 'usuario_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
