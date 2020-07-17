<?php

/*
 * This file is inspired by Builder from Laravel Gantt Chart - Mohammed Fowzi
 */

namespace Noonenew\LaravelGanttChart;

class Builder
{
    /**
     * @var array
     */
    private $gantt = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $defaults = [
        'datajson'          => [],
        'labels'            => [],
        'type'              => [],
        'customcontroller'  => [],
        'customfunction'    => [],
        'size'              => ['width' => null, 'height' => null]
    ];


    /**
     * @param $ganttid
     *
     * @return $this|Builder
     */
    public function ganttid($ganttid)
    {
        return $this->set('ganttid', $ganttid);
    }

    /**
     * @param $name
     *
     * @return $this|Builder
     */
    public function name($name)
    {
        $this->name          = $name;
        $this->gantt[$name] = $this->defaults;
        return $this;
    }

    /**
     * @param $element
     *
     * @return Builder
     */
    public function element($element)
    {
        return $this->set('element', $element);
    }

    /**
     * @param array $labels
     *
     * @return Builder
     */
    public function labels(array $labels)
    {
        return $this->set('labels', $labels);
    }

    /**
     * @param string|array $datajson
     *
     * @return Builder
     */
    public function datajson($datajson)
    {

//        if (is_array($datajson)) {
//            dd(json_encode($datajson, true));
//            $this->set('datajson', json_encode($datajson, true));
//            return $this;
//        }

        $this->set('datajson', json_encode($datajson, true));
        return $this;
    }


    /**
     * @param string $type
     *
     * @return Builder
     */
    public function type($type)
    {
        return $this->set('type', $type);
    }

    /**
     * @param array $size
     *
     * @return Builder
     */
    public function size($size)
    {
        return $this->set('size', $size);
    }

    /**
     * @param array $options
     *
     * @return $this|Builder
     */
    public function options(array $options)
    {
        foreach ($options as $key => $value) {
            $this->set('options.' . $key, $value);
        }

        return $this;
    }

    /**
     * @param string $customcontroller
     *
     * @return Builder
     */
    public function customcontroller($customcontroller)
    {
        if(is_null($customcontroller)){
            $customcontroller = null;
        } else {
            $customcontroller = $customcontroller;
        }
        return $this->set('customcontroller', $customcontroller);
    }

    /**
     * @param string $customfunction
     *
     * @return Builder
     */
    public function customfunction($customfunction)
    {
        if(is_null($customfunction)){
            $customfunction = null;
        } else {
            $customfunction = $customfunction;
        }
        return $this->set('customfunction', $customfunction);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $gantchart = $this->gantt[$this->name];
        //dd($map['datasets']);
        return view('gantt-template::gantt-template')
                ->with('datajson', $gantchart['datajson'])
                ->with('element', $this->name)
                ->with('labels', $gantchart['labels'])
                ->with('options', isset($gantchart['options']) ? $gantchart['options'] : '')
                ->with('customcontroller', $gantchart['customcontroller'])
                ->with('customfunction', $gantchart['customfunction'])
                ->with('type', $gantchart['type'])
                ->with('size', $gantchart['size']);
    }

    public function container()
    {
        $gantchart = $this->gantt[$this->name];

        return view('gantt-template::gantt-template-without-script')
                ->with('element', $this->name)
                ->with('size', $gantchart['size']);
    }


    public function script()
    {
        $gantchart = $this->gantt[$this->name];

        return view('gantt-template::gantt-template-script')
            ->with('datajson', $gantchart['datajson'])
            ->with('element', $this->name)
            ->with('labels', $gantchart['labels'])
            ->with('customcontroller', $gantchart['customcontroller'])
            ->with('customfunction', $gantchart['customfunction'])
            ->with('type', $gantchart['type'])
            ->with('size', $gantchart['size']);
    }

    public function ganttFunctions()
    {
        $gantchart = $this->gantt[$this->name];
        return view('gantt-template::gantt-template-functions')
        ->with('customfunction', $gantchart['customfunction']);
    }


    /**
     * @param $key
     *
     * @return mixed
     */
    private function get($key)
    {
        return array_get($this->gantt[$this->name], $key);
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this|Builder
     */
    private function set($key, $value)
    {
        array_set($this->gantt[$this->name], $key, $value);
        return $this;
    }
}
