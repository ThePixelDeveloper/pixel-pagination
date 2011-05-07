<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Select box pagination.
 * 
 * To have text labels for the select boxes you need to pass in an array 
 * of labels.
 * 
 * $view = new View_Pagination_Dropdown
 * $view->labels = array_values($query->as_array('id', 'name'));
 * $view->pagination ...
 * $view->request ...
 * 
 * We use array_values here as providing the ids will cause the pagination view
 * to pull out incorrect labels.
 * 
 * @author     Mathew Davies
 * @copyright  (c) 2011 Mathew Davies
 * @license    MIT
 */
class View_Pagination_Dropdown extends View_Pagination
{
	public $_template = 'pagination/dropdown';
}