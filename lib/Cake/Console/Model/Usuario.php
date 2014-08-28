<?php
App::uses('AppModel', 'Model');
/**
 * Usuario Model
 *
 * @property Area $Area
 * @property Instituto $Instituto
 */
class Usuario extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'usuario';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Area' => array(
			'className' => 'Area',
			'joinTable' => 'usuario_area',
			'foreignKey' => 'usuario_id',
			'associationForeignKey' => 'area_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Instituto' => array(
			'className' => 'Instituto',
			'joinTable' => 'usuario_instituto',
			'foreignKey' => 'usuario_id',
			'associationForeignKey' => 'instituto_id',
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
