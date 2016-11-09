<?php

namespace App\Library\Traits;


trait PerPage
{
    /**
     * Count items on page
     *
     * @var integer $countItems
     */
    public $countItems = 12;

    /**
     * name url fragment
     *
     * @var string $fragmentName
     */
    public $fragmentName = 'items';

    /**
     * @return int
     */
    public function perPager()
    {
        if(request()->has($this->fragmentName)){
            $this->countItems = (int)request()->get($this->fragmentName);
            if($this->countItems < self::MIN_ITEMS) $this->countItems = self::MIN_ITEMS;
            elseif ($this->countItems > self::MAX_ITEMS) $this->countItems = self::MAX_ITEMS;
        }

        return $this->countItems;
    }
}