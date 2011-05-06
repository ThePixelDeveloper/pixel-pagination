<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Punbb pagination style
 * 
 * @example    Pages: 1 … 4 5 6 7 8 … 15
 * @author     Mathew Davies
 * @copyright  (c) 2011 Mathew Davies
 * @license    MIT
 */
class View_Pagination_Punbb extends View_Pagination
{
	public $_template = 'pagination/punbb';
	
	/**
	 *
	 * @param type $template
	 * @param type $view
	 * @param type $partials 
	 */
	public function __construct($template = null, $view = null, $partials = null)
	{
		parent::__construct($template, $view, $partials);
		
		$this->pages_label = __('Pages');
	}
	
	public function links()
	{						
		$links = array();
		
		$current_page = $this->pagination->get_page();
		
		if ($current_page > 3)
		{
			$link = array('url' => $this->url(1), 'label' => $this->label(1));
			$links[] = $link;
			
			if ($current_page !== 4)
			{
				// Add ellipsis
				$link = array('label' => '...', 'current' => TRUE);
				$links[] = $link;
			}
		}
		
		for($i = $current_page - 2, $stop = $current_page + 3; $i < $stop; ++$i)
		{
			if ($i < 1 OR $i > $this->pagination->get_total_pages())
			{
				continue;
			}
				
			$link = array();
			
			if ($i === $current_page)
			{
				// Allows for highlighting the current page.
				$link['current'] = TRUE;
			}
			else
			{
				$link['url'] = $this->url($i);
			}
			
			$link['label'] = $this->label($i);
			
			$links[] = $link;
		}
		
		if ($current_page <=  $this->pagination->get_total_pages() - 3)
		{
			if ($current_page != $this->pagination->get_total_pages() - 3)
			{
				// Add ellipsis
				$link = array('label' => '...', 'current' => TRUE);
				$links[] = $link;
			}
			
			$link = array('url' => $this->url($this->pagination->get_total_pages()), 'label' => $this->label($this->pagination->get_total_pages()));
			$links[] = $link;
		}
		
		return $links;
	}
}