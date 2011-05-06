<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Pagination helper.
 * 
 * You need to pass three arguments into Pagination::factory():
 * 
 *  - total:   Total number of entries from your resultset. 
 *  - limit:   How many you want to display per page.
 *  - current: Current page number from URL.
 * 
 *     $pagination = Pagination::factory(100, 5, 1);
 * 
 * The helper function Pagination::get_page_from_url() is available to get the 
 * current page number from the URL. This has 3 arguments:
 * 
 *  - request: Request object used to get data from.
 *  - source:  query or route
 *  - key:     query key or route parameter name
 * 
 * Pagination can now be used to offset your resultset 
 * (we already have the limit). Get the offset with the `get_offset()` function.
 * 
 * 2 other methods are available: get_total_pages() and get_page(), but these are
 * mainly used in the view class and have no need to be accessed in the controller.
 * 
 * The pagination class is now ready to be passed into the Pagination view.
 * 
 *     $view = new View_Pagination;
 *     $view->pagination = $pagination;
 *     $view->request    = $request;
 * 
 * 2 variables are required to be set: pagination and request. Pagination can
 * now be rendered as $view->render();
 *
 * @author     Mathew Davies
 * @copyright  (c) 2011 Mathew Davies
 * @license    MIT
 */
abstract class Pixel_Pagination
{
	protected $_titles = array();
	
	/**
	 * @var integer 
	 */
	protected $_total, $_limit, $_current;
	
	/**
	 *
	 * @param type $total
	 */
	public function __construct($total, $limit, $current)
	{
		$this->_total   = (int) $total;
		$this->_limit   = (int) $limit;
		$this->_current = (int) $current;
	}
	
	/**
	 *
	 * @param integer $total
	 * @param integer $limit
	 */
	public static function factory($total, $limit, $current)
	{
		return new Pagination($total, $limit, $current);
	}
	
	/**
	 * @return integer Offset used in result set
	 */
	public function get_offset()
	{
		return (($this->get_page() - 1) * $this->_limit);
	}
		
	/**
	 * @return integer Current page number
	 */
	public function get_page()
	{
		return (int) min(max(1, $this->_current), max(1, $this->get_total_pages()));
	}
	
	/**
	 * @return integer Total number of pages
	 */
	public function get_total_pages()
	{
		return (int) ceil($this->_total / $this->_limit);
	}
	
	/**
	 * This is a helper function to grab the page number from the URL. Returns 1
	 * if nothing was found.
	 * 
	 * @param Request $request
	 * @param string  $source
	 * @param string  $key
	 * @return integer 
	 */
	public static function get_page_from_url(Request $request, $source = 'query', $key = 'page')
	{
		if ($source === 'query')
		{
			$page = $request->query($key);
		}
		
		if ($source === 'route')
		{
			$page = $request->param($key);
		}
		
		return (int) $page ?: 1;
	}
} // End Pagination
