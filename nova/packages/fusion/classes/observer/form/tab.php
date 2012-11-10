<?php
/**
 * The form tab observer acts on the form tab model at given times to ensure
 * additional work on on other tabs, data, values, fields, and sections happens
 * as it should.
 *
 * @package		Nova
 * @subpackage	Fusion
 * @category	Observer
 * @author		Anodyne Productions
 * @copyright	2012 Anodyne Productions
 */

namespace Fusion;

class Observer_Form_Tab extends \Orm\Observer
{
	/**
	 * When a new tab is added, we need to check to see how many tabs exist
	 * already. If there's only 1 (i.e. the one we just created) then we need to
	 * update all of the sections for that form to move them in to the newly
	 * created tab. If there aren't any sections either, we need to create a 
	 * blank section and move all the fields in to that section. If these steps 
	 * aren't done, we could orphan fields and sections for the form.
	 *
	 * @internal
	 * @param	Model	the model being acted on
	 * @return	void
	 */
	public function after_insert(\Model $model)
	{
		/**
		 * System Event
		 */
		\SystemEvent::add('user', '[[event.admin.form.tab_create|{{'.$model->name.'}}|{{'.$model->form_key.'}}]]');

		// what form are we updating?
		$form = $model->form_key;

		// count how many tabs we have in this form
		$tabs = \Model_Form_Tab::getFormItems($form);

		if (count($tabs) < 2)
		{
			// get all the sections for this form
			$sections = \Model_Form_Section::getFormItems($form);

			if (count($sections) > 0)
			{
				foreach ($sections as $s)
				{
					// set the section to have the ID of the newly created tab
					$s->tab_id = $model->id;

					// save the record
					$s->save();
				}
			}
			else
			{
				// create a new section
				$sec = \Model_Form_Section::createItem(array(
					'form_key' => $form,
					'tab_id' => $model->id,
					'name' => '',
					'order' => 0
				), true);

				// get all the fields and move them in to the section
				$fields = \Model_Form_Field::getFormItems($form);

				if (count($fields) > 0)
				{
					foreach ($fields as $f)
					{
						// update the field section
						$f->section_id = $sec->id;

						// save the field
						$f->save();
					}
				}
			}
		}
	}

	/**
	 * When a tab is updated, create a system event.
	 *
	 * @internal
	 * @param	Model	the model being acted on
	 * @return	void
	 */
	public function after_update(\Model $model)
	{
		/**
		 * System Event
		 */
		\SystemEvent::add('user', '[[event.admin.form.tab_update|{{'.$model->name.'}}|{{'.$model->form_key.'}}]]');
	}

	/**
	 * When a tab is deleted, create a system event.
	 *
	 * @internal
	 * @param	Model	the model being acted on
	 * @return	void
	 */
	public function before_delete(\Model $model)
	{
		/**
		 * System Event
		 */
		\SystemEvent::add('user', '[[event.admin.form.tab_delete|{{'.$model->name.'}}|{{'.$model->form_key.'}}]]');
	}
}