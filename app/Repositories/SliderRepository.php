<?php

namespace App\Repositories;
use App\Models\Slider;
use Log;
class SliderRepository
{

    public function getSlider()
    {
        $slider = Slider::all();
        return $slider;
    }

   
    
    public function deleteSlider($id)
    {
        return Slider::find($id)->delete();
    }

    public function _edit($id)
    {
        return Slider::find($id);
    }

    public function saveSlider($data)
    {
       
        return Slider::create($data); 
    }

    public function _update($id, $data)
    {
        if(isset($data['image']))
        {
           
            $slider = Slider::find($id);
            $slider->discount_title = is_null($data['discount_title']) ? Null : $data['discount_title'];
            $slider->title = $data['title'];
            $slider->image = $data['image'];
            $slider->url= $data['url'];
            $slider->save();
        }
        else
        {   
            
            $slider = Slider::find($id);
            $slider->discount_title = is_null($data['discount_title']) ? Null : $data['discount_title'];
            $slider->title = $data['title'];
            $slider->url= $data['url'];
            $slider->save();
        }
       
    }
}