<?php
App::uses('AppModel', 'Model');
/**
 * Instituto Model
 *
 * @property Tipo $Tipo
 * @property Usuario $Usuario
 */
class Instituto extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'instituto';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Tipo' => array(
			'className' => 'Tipo',
			'joinTable' => 'instituto_tipo',
			'foreignKey' => 'instituto_id',
			'associationForeignKey' => 'tipo_id',
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
			'joinTable' => 'usuario_instituto',
			'foreignKey' => 'instituto_id',
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
