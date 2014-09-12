<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 * @property PaginatorComponent $Paginator
 */
class CalendarController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method

 *SELECT * FROM ip_usuario  inner join ip_profesor_area on
 * ip_usuario.id=ip_profesor_area.profesor inner join 
 * ip_area on ip_profesor_area.area=ip_area.id 
 * where ip_area.area like 
 * @return void
 */


}
