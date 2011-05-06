<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Pagination helper.
 * 
 * @author     Mathew Davies
 * @copyright  (c) 2011 Mathew Davies
 * @license    MIT
 */
class View_Pagination extends Kostache
{
	/**
	 * @var Pagination
	 */
	public $pagination;
	
	/**
	 * @var array Label for pagination link.
	 */
	public $labels = array();
	
	/**
	 * @var Request
	 */
	public $request;
	
	public $_template = 'pagination/basic';
	
	/**
	 *
	 * @param type $template
	 * @param type $view
	 * @param type $partials 
	 */
	public function __construct($template = null, $view = null, $partials = null)
	{
		parent::__construct($template, $view, $partials);
		
		// Setup labels, not sure of a good way to do this
		$this->first_page_label    = __('First page');
		$this->last_page_label     = __('Last page');
		$this->previous_page_label = __('Previous page');
		$this->next_page_label     = __('Next page');
	}
	
	/**
	 * @return array URL for the first page.
	 */
	public function first_page()
	{
		if ($this->pagination->get_page() !== 1)
		{
			return array(array('url' => $this->url(1)));
		}
	}
	
	/**
	 * @return array URL for the last page.
	 */
	public function last_page()
	{
		if ($this->pagination->get_page() !== $this->pagination->get_total_pages())
		{
			return array(array('url' => $this->url($this->pagination->get_total_pages())));
		}
	}
	
	/**
	 * @return array URL for the previous page.
	 */
	public function previous_page()
	{
		if ($this->pagination->get_page() > 1)
		{
			return array(array('url' => $this->url($this->pagination->get_page() - 1)));
		}
	}
	
	/**
	 * @return array URL for the next page.
	 */
	public function next_page()
	{
		if ($this->pagination->get_page() < $this->pagination->get_total_pages())
		{
			return array(array('url' => $this->url($this->pagination->get_page() + 1)));
		}
	}
	
	/**
	 * Build an array of links to display
	 * 
	 * @return array
	 */
	public function links()
	{
		$links = array();
		
		for($i = 1; $i <= $this->pagination->get_total_pages(); $i++)
		{
			$link = array();
			
			if ($i === $this->pagination->get_page())
			{
				// Allows for highlighting the current page.
				$link['current'] = TRUE;
			}
			
			$link['url']   = $this->url($i);
			$link['label'] = $this->label($i);
			
			// Add link to array.
			$links[] = $link;
		}
		
		return $links;
	}
	
	/**
	 * @param integer $page 
	 * @return string URL to paginated page.
	 */
	public function url($page)
	{
		if ($page === 1)
		{
			// Don't append GET arguments for the first page
			$page = NULL;
		}
		
		return $this->request->url().URL::query(array('page' => $page));
	}
	
	/**
	 * Label for pagination link.
	 * 
	 * @param  integer $page
	 * @return string 
	 */
	public function label($page)
	{
		if (array_key_exists($page, $this->labels))
		{
			return (string) $this->labels[$page];
		}
		
		return $page;
	}
}