<?php
/**
 * Nova's ajax controller.
 *
 * @package		Nova
 * @category	Controller
 * @author		Anodyne Productions
 * @copyright	2012 Anodyne Productions
 */

namespace Nova;

class Controller_Ajax_Info extends \Controller
{
	public function before()
	{
		parent::before();

		// manually add the nova module to the paths
		\Finder::instance()->add_path(\Fuel::add_module('nova'));
		
		// go out and load then merge the nova config files
		\Config::load('nova', true, false, true);
	}
	
	public function after($response)
	{
		parent::after($response);
		
		// return the response object
		return $this->response;
	}

	public function action_position_desc()
	{
		// set the POST variable
		$position = \Security::xss_clean(\Input::post('position', false));
		$position = (is_numeric($position)) ? $position : false;

		// grab the position details
		$item = \Model_Position::find($position);

		// set the output
		$output = (count($item) > 0) ? $item->desc : '';
		
		echo nl2br($output);
	}

	public function action_rank_image()
	{
		// set the POST variables
		$rank = \Security::xss_clean(\Input::post('rank', false));
		$location = \Security::xss_clean(\Input::post('location', false));
		
		// a little sanity check
		$rank = (is_numeric($rank)) ? $rank : false;
		
		// grab the rank catalogue
		$catalog = \Model_Catalog_Rank::get_item($location);
		
		// pull the rank record
		$rank = \Model_Rank::find($rank);
		
		// set the output
		$output = (count($rank) > 0) ? \Location::rank($location, $rank->image, $catalog->extension) : '';
		
		echo $output;
	}
}
