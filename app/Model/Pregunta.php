<?php
App::uses('AppModel', 'Model');
/**
 * Pregunta Model
 *
 * @property User $User
 * @property Area $Area
 * @property Pregunta $Pregunta
 */
class Pregunta extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'pregunta';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'id_usuario_preg',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Area'=> array(
            'className' => 'Area',
            'foreignKey' => 'area',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'PreguntaTag' => array(
            'className' => 'PreguntaTag',
            'foreignKey' => 'id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
	);
public $hasMany=array(
        'PreguntaTag' => array(
            'className' => 'PreguntaTag',
            'foreignKey' => 'pregunta',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
        
    );
}
