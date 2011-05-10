<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Update Nova from 1.2.4 to 2.0
 */
$system_versions	= null;
$system_info		= null;
$add_tables			= null;
$drop_tables		= null;
$rename_tables		= null;
$add_column			= null;
$modify_column		= null;
$drop_column		= null;

/**
 * Version info for the database
 */
$system_versions = array(
	'version'			=> '2.0.0',
	'version_major'		=> 2,
	'version_minor'		=> 0,
	'version_update'	=> 0,
	'version_date'		=> 1308949200,
	'version_launch'	=> "You've spoken and we've listened. The feedback we constantly get about Nova is that it's great, but it's difficult to update. Nova 2 is all about fixing that very issue. With a brand new file structure, Nova 2 has never been easier to update (simply delete one folder and replace it with one from the zip archive). In addition, Nova 2 adds new functionality to the system to help admins manage their RPG. Nova 2 is smarter than before, tracking who did and who didn't participate in a post. If someone didn't add anything to the post, they'll automatically be removed before it's posted (this feature can be turned on and off from Site Settings). In addition, Thresher has gotten a much needed boost from R1 to R2 which adds new page management and page viewing interfaces and a new category selection process that allows admins to add categories on the fly. More information about these features and everything else in Nova 2 (plus a full changelog) can be found at AnodyneDocs. This update is recommended for all users.",
	'version_changes'	=> "* added the message.php file to handle notification of bans, a missing \"nova\" directory and incompatible PHP version
* added new process to write the database config file for you
* added the ability to upgrade SMS Database entries to Thresher wiki pages
* added the ability for textareas to \"grow\" as more text is added like Facebook
* updated seamless substitution to be able to override email view files
* updated Thresher with a new way to create and manage categories when working on a wiki page
* updated Thresher with a completely new user experience for managing wiki pages
* updated Thresher with a brand new interface for viewing wiki pages
* updated the upload instructions to include the maximum file size and maximum image dimensions from the config file for reference
* updated to jquery version 1.6
* updated to jquery version 1.8.12
* updated to uniform version 1.7.5
* updated to prettyPhoto version 3.1.2
* updated to qTip2
* refactored the location helper into a full-blown class with static methods
* refactored the upgrade process to mirror what was created for nova 3
* removed the banned.php file
* removed the rss model since it isn't necessary any more
* fixed bug with seamless substitution of images where they wouldn't work when they were in the _base_override directory
* fixed bug with private messages where RE: and FWD: would constantly be added to message, now Nova will make sure it's only added once
* fixed bug with private messages where the person sending the message would be on the recipient list, so any message they sent would show up in their inbox as well
* fixed bug where the join form could be submitted without an email address or password"
);

$system_info = array(
	'sys_last_update'		=> now(),
	'sys_version_major'		=> 2,
	'sys_version_minor'		=> 0,
	'sys_version_update'	=> 0
);

/*
|---------------------------------------------------------------
| TABLES TO ADD
|
| $add_tables = array(
|	'table_name' => array(
|		'id' => 'table_id',
|		'fields' => 'fields_table_name')
| );
|
| $fields_table_name = array(
|	'table_id' => array(
|		'type' => 'INT',
|		'constraint' => 6,
|		'auto_increment' => TRUE),
|	'table_field_1' => array(
|		'type' => 'VARCHAR',
|		'constraint' => 255,
|		'default' => ''),
|	'table_field_2' => array(
|		'type' => 'INT',
|		'constraint' => 4,
|		'default' => '99')
| );
|---------------------------------------------------------------
*/

$add_tables = array(
	'wiki_restrictions' => array(
		'id' => 'restr_id',
		'fields' => 'fields_wiki_restrictions'),
);

$fields_wiki_restrictions = array(
	'restr_id' => array(
		'type' => 'INT',
		'constraint' => 10,
		'auto_increment' => TRUE),
	'restr_page' => array(
		'type' => 'INT',
		'constraint' => 10),
	'restr_created_at' => array(
		'type' => 'BIGINT',
		'constraint' => 20),
	'restr_created_by' => array(
		'type' => 'INT',
		'constraint' => 8),
	'restr_updated_at' => array(
		'type' => 'BIGINT',
		'constraint' => 20),
	'restr_updated_by' => array(
		'type' => 'INT',
		'constraint' => 8),
	'restrictions' => array(
		'type' => 'TEXT'),
);

if ($add_tables !== null)
{
	foreach ($add_tables as $key => $value)
	{
		$this->dbforge->add_field($$value['fields']);
		$this->dbforge->add_key($value['id'], true);
		$this->dbforge->create_table($key, true);
	}
}

/*
|---------------------------------------------------------------
| TABLES TO DROP
|
| $drop_tables = array('table_name');
|---------------------------------------------------------------
*/

if ($drop_tables !== null)
{
	foreach ($drop_tables as $value)
	{
		$this->dbforge->drop_table($value);
	}
}

/*
|---------------------------------------------------------------
| TABLES TO RENAME
|
| $rename_tables = array('old_table_name' => 'new_table_name');
|---------------------------------------------------------------
*/

if ($rename_tables !== null)
{
	foreach ($rename_tables as $key => $value)
	{
		$this->dbforge->rename_table($key, $value);
	}
}

/*
|---------------------------------------------------------------
| COLUMNS TO ADD
|
| $add_column = array(
|	'table_name' => array(
|		'field_name_1' => array('type' => 'TEXT'),
|		'field_name_2' => array(
|			'type' => 'VARCHAR',
|			'constraint' => 100)
|	)
| );
|---------------------------------------------------------------
*/

$add_column = array(
	'wiki_pages' => array(
		'page_type' => array(
			'type' => 'ENUM',
			'constraint' => "'standard','system'",
			'default' => 'standard'),
		'page_key' => array(
			'type' => 'VARCHAR',
			'constraint' => 100,
			'default' => ''),
	),
	'posts' => array(
		'post_participants' => array(
			'type' => 'TEXT'),
	)
);

if ($add_column !== null)
{
	foreach ($add_column as $key => $value)
	{
		$this->dbforge->add_column($key, $value);
	}
}

/*
|---------------------------------------------------------------
| COLUMNS TO MODIFY
|
| $modify_column = array(
|	'table_name' => array(
|		'old_field_name' => array(
|			'name' => 'new_field_name',
|			'type' => 'TEXT')
|	)
| );
|---------------------------------------------------------------
*/

if ($modify_column !== null)
{
	foreach ($modify_column as $key => $value)
	{
		$this->dbforge->modify_column($key, $value);
	}
}

/*
|---------------------------------------------------------------
| COLUMNS TO DROP
|
| $drop_column = array(
|	'table_name' => array('field_name')
| );
|---------------------------------------------------------------
*/

if ($drop_column !== null)
{
	foreach ($drop_column as $key => $value)
	{
		$this->dbforge->drop_column($key, $value[0]);
	}
}

/**
 * Data to insert/update/delete
 */

// update the lazy version info
$this->db->where('comp_name', 'Lazy');
$this->db->update('system_components', array('comp_version' => '1.5'));

// update the jquery version info
$this->db->where('comp_name', 'jQuery');
$this->db->update('system_components', array('comp_version' => '1.6'));

// update the jquery ui version info
$this->db->where('comp_name', 'jQuery UI');
$this->db->update('system_components', array('comp_version' => '1.8.12'));

// update the jquery prettyphoto info
$this->db->where('comp_name', 'prettyPhoto');
$this->db->update('system_components', array('comp_version' => '3.1.2'));

// update the markItUp! info
$this->db->where('comp_name', 'markItUp!');
$this->db->update('system_components', array('comp_version' => '1.1.10'));

// update the thresher info
$this->db->where('comp_name', 'Thresher');
$this->db->update('system_components', array('comp_version' => 'Release 2'));

// add the elastic plugin to the list of components
$additem = array(
	'comp_name' => 'Elastic',
	'comp_version' => '1.6.5',
	'comp_desc' => "jQuery Elastic is a plugin that makes your textareas grow and shrink to fit its content and was inspired by the auto-growing textareas on Facebook.",
	'comp_url' => 'http://www.unwrongest.com/projects/elastic/'
);
$this->db->insert('system_components', $additem);

// add the use_post_participants setting
$additem = array(
	'setting_key' => 'use_post_participants',
	'setting_value' => 'y',
	'setting_user_created' => 'n'
);
$this->db->insert('settings', $additem);

// update the level 3 wiki page item
$this->db->where('page_url', 'wiki/page');
$this->db->where('page_level', 3);
$this->db->update('access_pages', array('page_desc' => "Can create, delete and edit all wiki pages (including system pages), including viewing history and reverting to previous drafts. Level 3 permissions can bypass all access restrictions on a wiki page."));

/**
 * Thresher system pages.
 */
$data = array(
	array(
		'draft' => array(
			'draft_title' => 'Welcome to Thresher',
			'draft_author_user' => 0,
			'draft_author_character' => 0,
			'draft_summary' => "This is the main wiki system page.",
			'draft_content' => "<p>Welcome to Thresher R2. Thresher is Nova's built-in mini-wiki to help your RPG collaborate and share information easily. You can change this message by editing the system page from the Wiki Page Management page.</p>",
			'draft_created_at' => now()),
		'page' => array(
			'page_created_at' => now(),
			'page_created_by_user' => 0,
			'page_created_by_character' => 0,
			'page_comments' => 'closed',
			'page_type' => 'system',
			'page_key' => 'index'),
	),
	array(
		'draft' => array(
			'draft_title' => 'Create Wiki Page',
			'draft_author_user' => 0,
			'draft_author_character' => 0,
			'draft_summary' => "",
			'draft_content' => "",
			'draft_created_at' => now()),
		'page' => array(
			'page_created_at' => now(),
			'page_created_by_user' => 0,
			'page_created_by_character' => 0,
			'page_comments' => 'closed',
			'page_type' => 'system',
			'page_key' => 'create'),
	),
	array(
		'draft' => array(
			'draft_title' => 'Edit Wiki Page',
			'draft_author_user' => 0,
			'draft_author_character' => 0,
			'draft_summary' => "",
			'draft_content' => "",
			'draft_created_at' => now()),
		'page' => array(
			'page_created_at' => now(),
			'page_created_by_user' => 0,
			'page_created_by_character' => 0,
			'page_comments' => 'closed',
			'page_type' => 'system',
			'page_key' => 'edit'),
	),
	array(
		'draft' => array(
			'draft_title' => 'Wiki Categories',
			'draft_author_user' => 0,
			'draft_author_character' => 0,
			'draft_summary' => "Categories in Thresher allow pages to be broken up in to different subject matters and categorized in a way that makes sense. Below is the complete list of categories. Clicking on one of the categories will show all pages associated with that category.",
			'draft_content' => "",
			'draft_created_at' => now()),
		'page' => array(
			'page_created_at' => now(),
			'page_created_by_user' => 0,
			'page_created_by_character' => 0,
			'page_comments' => 'closed',
			'page_type' => 'system',
			'page_key' => 'categories'),
	),
	array(
		'draft' => array(
			'draft_title' => 'Wiki Category Page',
			'draft_author_user' => 0,
			'draft_author_character' => 0,
			'draft_summary' => "",
			'draft_content' => "",
			'draft_created_at' => now()),
		'page' => array(
			'page_created_at' => now(),
			'page_created_by_user' => 0,
			'page_created_by_character' => 0,
			'page_comments' => 'closed',
			'page_type' => 'system',
			'page_key' => 'category'),
	),
);

foreach ($data as $key => $value)
{
	// insert the draft
	$this->db->insert('wiki_drafts', $value['draft']);
	$draftID = $this->db->insert_id();
	
	// update the page record
	$value['page']['page_draft'] = $draftID;
	
	// insert the page
	$this->db->insert('wiki_pages', $value['page']);
	$pageID = $this->db->insert_id();
	
	// update the draft record
	$this->db->where('draft_id', $draftID);
	$this->db->update('wiki_drafts', array('draft_page' => $pageID));
}