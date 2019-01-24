<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Breadcrumbs
{
    private $breadcrumbs = array();
    private $tags;
    
    public function __construct()
    {
        $this->tags['open'] = "<ol class='breadcrumb'>";
        $this->tags['close'] = "</ol>";
        $this->tags['itemOpen'] = "<li>";
        $this->tags['itemClose'] = "</li>";
    }

    public function add($title, $href, $icon="fa fa-hand-o-down")
    {
        if (!$title or !$href) {
            return;
        }
        $this->breadcrumbs[] = array('title' => $title, 'href' => $href, 'icon' => $icon);
    }
    
    public function openTag($tags="")
    {
        if (empty($tags)) {
            return $this->tags['open'];
        } else {
            $this->tags['open'] = $tags;
        }
    }
    
    public function closeTag($tags="")
    {
        if (empty($tags)) {
            return $this->tags['close'];
        } else {
            $this->tags['close'] = $tags;
        }
    }
    
    public function itemOpenTag($tags="")
    {
        if (empty($tags)) {
            return $this->tags['itemOpen'];
        } else {
            $this->tags['itemOpen'] = $tags;
        }
    }
    
    public function itemCloseTag($tags="")
    {
        if (empty($tags)) {
            return $this->tags['itemClose'];
        } else {
            $this->tags['itemClose'] = $tags;
        }
    }
    
    public function render()
    {
        if (!empty($this->tags['open'])) {
            $output = $this->tags['open'];
        } else {
            $output = '<ol class="breadcrumb">';
        }
        
        $count = count($this->breadcrumbs)-1;
        foreach ($this->breadcrumbs as $index => $breadcrumb) {
            if ($index == $count) {
                $output .= '<li class="active">';
                $output .= '<i class="'.$breadcrumb['icon'].'"></i> '.$breadcrumb['title'];
                $output .= '</li>';
            } else {
                $output .= '<li>';
                $output .= '<a href="'.$breadcrumb['href'].'">';
                $output .= '<i class="'.$breadcrumb['icon'].'"></i> '.$breadcrumb['title'];
                $output .= '</a>';
                $output .= '</li>';
            }
        }
        
        if (!empty($this->tags['open'])) {
            $output .= $this->tags['close'];
        } else {
            $output .= "</ol>";
        }
        

        return $output;
    }
}
