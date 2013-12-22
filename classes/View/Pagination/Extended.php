<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Extended pagination style
 * 
 * @example    « Previous | Page 2 of 11 | Showing items 6-10 of 52 | Next »
 * @author     Mathew Davies
 * @copyright  (c) 2011 Mathew Davies
 * @license    MIT
 */
class View_Pagination_Extended extends View_Pagination
{
	public $_template = 'pagination/extended';
	
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
	
	public function page()
	{
		return __('Page') .' '. $this->pagination->get_page() .' '. __('of') .' '. $this->pagination->get_total_pages();
	}
	
	public function items()
	{
		return __('Showing items') . ' '. 
			($this->pagination->get_offset() + 1) . '-' . 
			min($this->pagination->get_total(), $this->pagination->get_page() * $this->pagination->get_limit()) .' '. __('of') .' '. 
			$this->pagination->get_total();
	}
}