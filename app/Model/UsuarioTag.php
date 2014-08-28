<?php
App::uses('AppModel', 'Model');
/**
 * UsuarioTag Model
 *
 * @property Tags $Tags
 */
class UsuarioTag extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    public $useTable = 'usuario_tags';
	public $belongsTo = array(
		'Tags' => array(
			'className' => 'Tags',
			'foreignKey' => 'tags_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
