<?php
/**
 * Form Model
 *
 * @package		Nova
 * @subpackage	Fusion
 * @category	Model
 * @author		Anodyne Productions
 * @copyright	2012 Anodyne Productions
 */
 
namespace Fusion;

class Model_Form extends \Model {
	
	public static $_table_name = 'forms';
	
	public static $_properties = array(
		'id' => array(
			'type' => 'int',
			'constraint' => 11,
			'auto_increment' => true),
		'key' => array(
			'type' => 'string',
			'constraint' => 20,
			'null' => true),
		'name' => array(
			'type' => 'string',
			'constraint' => 255,
			'null' => true),
		'orientation' => array(
			'type' => 'string',
			'constraint' => 50,
			'default' => 'vertical'),
	);
}
