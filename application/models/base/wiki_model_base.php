<?php
/*
|---------------------------------------------------------------
| WIKI MODEL
|---------------------------------------------------------------
|
| File: models/wiki_model_base.php
| System Version: 1.0
|
| Model used to access the wiki tables.
|
*/

class Wiki_model_base extends Model {

	function Wiki_model_base()
	{
		parent::Model();
		
		/* load the db utility library */
		$this->load->dbutil();
	}
	
	/*
	|---------------------------------------------------------------
	| RETRIEVE METHODS
	|---------------------------------------------------------------
	*/
	
	function get_categories()
	{
		$query = $this->db->get('wiki_categories');
		
		return $query;
	}
	
	function get_category($id = '', $return = '')
	{
		$query = $this->db->get_where('wiki_categories', array('wikicat_id' => $id));
		
		$row = ($query->num_rows() > 0) ? $query->row() : FALSE;
		
		if (!empty($return) && $row !== FALSE)
		{
			if (!is_array($return))
			{
				return $row->$return;
			}
			else
			{
				$array = array();
				
				foreach ($return as $r)
				{
					$array[$r] = $row->$r;
				}
				
				return $array;
			}
		}
		
		return $row;
	}
	
	function get_comments($id = '')
	{
		$this->db->from('wiki_comments');
		$this->db->where('wcomments_page', $id);
		$this->db->order_by('wcomments_date', 'desc');
		
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_draft($id = '')
	{
		$query = $this->db->get_where('wiki_drafts', array('draft_id' => $id));
		
		return $query;
	}
	
	function get_drafts($id = '')
	{
		$this->db->from('wiki_drafts');
		$this->db->where('draft_page', $id);
		$this->db->order_by('draft_created_at', 'desc');
		
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_page($id = '')
	{
		$this->db->from('wiki_pages');
		$this->db->join('wiki_drafts', 'wiki_drafts.draft_id = wiki_pages.page_draft');
		$this->db->where('page_id', $id);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_pages($category = '', $order = 'wiki_drafts.draft_title', $sort = 'asc')
	{
		$this->db->from('wiki_pages');
		$this->db->join('wiki_drafts', 'wiki_drafts.draft_id = wiki_pages.page_draft');
		
		if (!empty($category))
		{
			if ($category == 0)
			{
				$this->db->where('wiki_drafts.draft_categories', '');
			}
			else
			{
				$this->db->like('wiki_drafts.draft_categories', $category);
			}
		}
		
		$this->db->order_by($order, $sort);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_recently_created($limit = 10)
	{
		$this->db->from('wiki_pages');
		$this->db->join('wiki_drafts', 'wiki_drafts.draft_id = wiki_pages.page_draft');
		$this->db->where('page_created_at >', '');
		$this->db->order_by('page_created_at', 'desc');
		
		if ($limit > 0)
		{
			$this->db->limit($limit);
		}
		
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_recently_updated($limit = 10)
	{
		$this->db->from('wiki_pages');
		$this->db->join('wiki_drafts', 'wiki_drafts.draft_id = wiki_pages.page_draft');
		$this->db->where('page_updated_at >', '');
		$this->db->order_by('page_updated_at', 'desc');
		
		if ($limit > 0)
		{
			$this->db->limit($limit);
		}
		
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	|---------------------------------------------------------------
	| CREATE METHODS
	|---------------------------------------------------------------
	*/
	
	function create_category($data = '')
	{
		$query = $this->db->insert('wiki_categories', $data);
		
		$this->dbutil->optimize_table('wiki_categories');
		
		return $query;
	}
	
	function create_draft($data = '')
	{
		$query = $this->db->insert('wiki_drafts', $data);
		
		$this->dbutil->optimize_table('wiki_drafts');
		
		return $query;
	}
	
	function create_page($data = '')
	{
		$query = $this->db->insert('wiki_pages', $data);
		
		$this->dbutil->optimize_table('wiki_pages');
		
		return $query;
	}
	
	/*
	|---------------------------------------------------------------
	| UPDATE METHODS
	|---------------------------------------------------------------
	*/
	
	function update_category($id = '', $data = '')
	{
		$this->db->where('wikicat_id', $id);
		$query = $this->db->update('wiki_categories', $data);
		
		$this->dbutil->optimize_table('wiki_categories');
		
		return $query;
	}
	
	function update_page($id = '', $data = '')
	{
		$this->db->where('page_id', $id);
		$query = $this->db->update('wiki_pages', $data);
		
		$this->dbutil->optimize_table('wiki_pages');
		
		return $query;
	}
	
	/*
	|---------------------------------------------------------------
	| DELETE METHODS
	|---------------------------------------------------------------
	*/
	
	function delete_category($id = '')
	{
		$query = $this->db->delete('wiki_categories', array('wikicat_id' => $id));
		
		$this->dbutil->optimize_table('wiki_categories');
		
		return $query;
	}
	
	function delete_comment($id = '', $type = 'comment')
	{
		switch ($type)
		{
			case 'comment':
				$this->db->where('wcomments_id', $id);
			
				break;
				
			case 'page':
				$this->db->where('wcomments_page', $id);
			
				break;
		}
		
		$query = $this->db->delete('wiki_comments');
		
		$this->dbutil->optimize_table('wiki_comments');
		
		return $query;
	}
	
	function delete_draft($id = '', $type = 'draft')
	{
		switch ($type)
		{
			case 'array_draft':
				if (is_array($id))
				{
					foreach ($id as $i)
					{
						$this->db->or_where('draft_id', $i);
					}
				}
			
				break;
				
			case 'array_page':
				if (is_array($id))
				{
					foreach ($id as $i)
					{
						$this->db->or_where('draft_page', $i);
					}
				}
			
				break;
				
			case 'draft':
				$this->db->where('draft_id', $id);
			
				break;
				
			case 'page':
				$this->db->where('draft_page', $id);
			
				break;
		}
		
		$query = $this->db->delete('wiki_drafts');
		
		$this->dbutil->optimize_table('wiki_drafts');
		
		return $query;
	}
	
	function delete_page($id = '')
	{
		/* remove the comments */
		$drafts = $this->delete_comment($id, 'page');
		
		/* remove the drafts */
		$drafts = $this->delete_draft($id, 'page');
		
		$query = $this->db->delete('wiki_pages', array('page_id' => $id));
		
		$this->dbutil->optimize_table('wiki_pages');
		
		return $query;
	}
}

/* End of file wiki_model_base.php */
/* Location: ./application/models/base/wiki_model_base.php */