<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Form {
	// Return data time input
	public static function datetime(&$params) {
		$html = '<div class="form-group">';
		$html .= '<label for="'.$params->name.'">'.$params->title.'</label>';
		$html .= '<input id="'.$params->name.'" name="'.($params->prefix ?? '').str_replace('-','_',$params->name).'" type="'.($params->type ?? 'text').'" class="'.$params->class.'" placeholder="'.$params->title.'" value="'.($params->value ?? $params->default ?? '').'"'.(isset($params->readonly) && $params->readonly ? ' readonly' : '').' />';
		$html .= '</div>';
		return $html;
	}
	
	// Return hidden input
	public static function hidden(&$params) {
		$html = '<input id="'.$params->name.'" name="'.($params->prefix ?? '').str_replace('-','_',$params->name).'" type="'.($params->type ?? 'hidden').'" value="'.($params->value ?? $params->default ?? '').'" />';
		return $html;
	}
	
	// Return query
	public static function query($class,$filter = "1",$order = "`title`") {
		return "SELECT `#`,`title` FROM `{$class}` WHERE {$filter} ORDER BY {$order}";
	}
	
	// Return selection
	public static function select(&$params) {
		!is_array($params) || $params = (object)$params;
		$html = '<div class="'.($params->{'group-class'} ?? 'form-group').'">';
		$html .= '<label for="'.$params->name.'">'.$params->title.'</label>';
		$html .= '<select id="'.$params->name.'" name="'.($params->prefix ?? '').(isset($params->prefix) && $params->prefix != '@' ? str_replace('-','_',$params->name) : $params->name).'" class="'.$params->class.'"'.(isset($params->readonly) && $params->readonly ? ' readonly' : '').'>';
		$items = [];
		if(isset($params->query)) {
			$_Model = new Model;
			$items = $_Model->getDB()->loadItems($params->query);
		}
		if(!empty($params->list)) {
			$items = array_merge($params->list,$items);
		}
		foreach($items as $item) {
			$item = (object)$item;
			$html .= '<option value="'.$item->{'#'}.'"'.($item->{'#'} == ($params->value ?? $params->default) ? ' selected' : '').'>'.$item->title.'</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		return $html;
	}
	
	// Return filter selection
	public static function selectFilter(&$params) {
		!is_array($params) || $params = (object)$params;
		return self::select($params);
	}
	
	// Return text input
	public static function text(&$params) {
		$html = '<div class="form-group">';
		$html .= '<label for="'.$params->name.'">'.$params->title.'</label>';
		$html .= '<input id="'.$params->name.'" name="'.($params->prefix ?? '').str_replace('-','_',$params->name).'" type="'.($params->type ?? 'text').'" class="'.$params->class.'" placeholder="'.$params->title.'" value="'.($params->value ?? $params->default ?? '').'"'.(isset($params->readonly) && $params->readonly ? ' readonly' : '').' />';
		$html .= '</div>';
		return $html;
	}
	
	// Return textarea
	public static function textarea(&$params) {
		!is_array($params) || $params = (object)$params;
		$html = '<div class="form-group'.(isset($params->width) ? ' grid-column-'.$params->width : '').'">';
		$html .= '<label for="'.$params->name.'">'.$params->title.'</label>';
		$html .= '<textarea id="'.$params->name.'" name="'.($params->prefix ?? '').str_replace('-','_',$params->name).'" class="'.$params->class.'" placeholder="'.$params->title.'" rows="'.$params->size.'"'.(isset($params->readonly) && $params->readonly ? ' readonly' : '').(isset($params->required) && $params->required ? ' required' : '').'>'.($params->value ?? $params->default ?? '').'</textarea>';
		$html .= '</div>';
		return $html;
	}
	
	// Filter for text search
	public static function textFilter(&$params) {
		!is_array($params) || $params = (object)$params;
		return '<div class="form-group col"><label for="'.$params->name.'">'.$params->label.'</label><input id="'.$params->prefix.str_replace('-','_',$params->name).'" name="'.$params->name.'" class="form-control" type="text" placeholder="'.$params->label.'" value="'.$params->value.'" /></div>';
	}
}
?>