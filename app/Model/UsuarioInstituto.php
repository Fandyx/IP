<?php
App::uses('AppModel', 'Model');
/**
 * UsuarioInstituto Model
 *
 */
class UsuarioInstituto extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'usuario_instituto';
        public $hasMany = array(
		
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Instituto' => array(
			'className' => 'Instituto',
			'foreignKey' => 'instituto',
			'associationForeignKey' => 'instituto',
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
