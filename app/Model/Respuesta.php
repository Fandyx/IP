<?php
App::uses('AppModel', 'Model');
/**
 * Respuesta Model
 *
 * @property User $User
 * @property Area $Area
 * @property Respuesta $Respuesta
 */
class Respuesta extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'respuesta';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Pregunta' => array(
			'className' => 'Pregunta',
			'foreignKey' => 'pregunta',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
			'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'id_usuario_res',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
public $hasMany=array(
        'RespuestaVoto' => array(
            'className' => 'RespuestaVoto',
            'foreignKey' => 'respuesta',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
        
    );
}
