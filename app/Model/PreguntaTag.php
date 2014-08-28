<?php
App::uses('AppModel', 'Model');
/**
 * Pregunta Model
 *
 * @property User $User
 * @property Area $Area
 * @property PreguntaTag $PreguntaTag
 */
class PreguntaTag extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'pregunta_tags';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
public $belongsTo=array(
        'Tag' => array(
            'className' => 'Tag',
            'foreignKey' => 'tag',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
