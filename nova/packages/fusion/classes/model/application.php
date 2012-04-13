<?php
/**
 * Application Model
 *
 * *NOTE:* The user, character and positions fields do not use the _id naming
 * convention because they may not necessarily be tied to the current item at
 * that ID.
 *
 * @package		Nova
 * @subpackage	Fusion
 * @category	Model
 * @author		Anodyne Productions
 * @copyright	2012 Anodyne Productions
 */
 
namespace Fusion;

class Model_Application extends \Model {
	
	public static $_table_name = 'applications';
	
	public static $_properties = array(
		'id' => array(
			'type' => 'int',
			'constraint' => 11,
			'auto_increment' => true),
		'email' => array(
			'type' => 'string',
			'constraint' => 255,
			'null' => true),
		'ip_address' => array(
			'type' => 'string',
			'constraint' => 16,
			'null' => true),
		'user_id' => array(
			'type' => 'int',
			'constraint' => 11),
		'user_name' => array(
			'type' => 'string',
			'constraint' => 255,
			'null' => true),
		'character_id' => array(
			'type' => 'int',
			'constraint' => 11),
		'character_name' => array(
			'type' => 'text',
			'null' => true),
		'position' => array(
			'type' => 'string',
			'constraint' => 255,
			'null' => true),
		'date' => array(
			'type' => 'bigint',
			'constraint' => 20),
		'action' => array(
			'type' => 'string',
			'constraint' => 100,
			'null' => true),
		'message' => array(
			'type' => 'text',
			'null' => true),
	);
}
