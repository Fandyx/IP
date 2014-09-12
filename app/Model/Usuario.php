<?php
App::uses('AppModel', 'Model');
/**
 * Usuario Model
 *
 * @property PreguntaVoto $PreguntaVoto
 * @property RespuestaVoto $RespuestaVoto
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
       
/**
 * Validation rules
 *
 * @var array
 */
   public $validate = array(
        'email' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Se requiere un nombre de usuario'
            )
        )
    );
	

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PreguntaVoto' => array(
			'className' => 'PreguntaVoto',
			'foreignKey' => 'usuario_id',
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
		'RespuestaVoto' => array(
			'className' => 'RespuestaVoto',
			'foreignKey' => 'usuario_id',
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
		'UsuarioInstituto' => array(
			'className' => 'UsuarioInstituto',
			'joinTable' => 'usuario_instituto',
			'foreignKey' => 'usuario',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		
	);

public function beforeSave($options = array()) {
     App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
    if (isset($this->data[$this->alias]['pass'])) {
        $passwordHasher =  new SimplePasswordHasher(array('hashType' => 'sha256'));
        $this->data[$this->alias]['pass'] =  $passwordHasher->hash(
            $this->data[$this->alias]['pass']
        );
    }
    return true;
}



}
