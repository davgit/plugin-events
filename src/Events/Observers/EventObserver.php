<?php
/**
 * This file is part of the DreamFactory Services Platform(tm) SDK For PHP
 *
 * DreamFactory Services Platform(tm) <http://github.com/dreamfactorysoftware/dsp-core>
 * Copyright 2012-2014 DreamFactory Software, Inc. <support@dreamfactory.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace DreamFactory\Platform\Events\Observers;

use DreamFactory\Platform\Events\Enums\ObserverEvents;
use DreamFactory\Platform\Events\Interfaces\EventObserverLike;
use DreamFactory\Platform\Events\ObserverEvent;
use DreamFactory\Platform\Resources\System\Config;

/**
 * A base event observer class
 */
abstract class EventObserver implements EventObserverLike
{
    //*************************************************************************
    //	Members
    //*************************************************************************

    /**
     * @var bool Indicates if this observer is currently enabled or disabled
     */
    protected $_enabled = true;

    //*************************************************************************
    //	Methods
    //*************************************************************************

    /**
     * Enables the observer in the eyes of a dispatcher
     *
     * @return void
     */
    public function enable()
    {
        $this->_enabled = true;
        Platform::trigger( ObserverEvents::ENABLED, new ObserverEvent( $this ) );

        return $this;
    }

    /**
     * Disables the observer in the eyes of a dispatcher
     *
     * @return void
     */
    public function disable()
    {
        $this->_enabled = false;
        Platform::trigger( ObserverEvents::DISABLED, new ObserverEvent( $this ) );

        return $this;
    }

    /**
     * @return bool True if this observer is enabled for event handling
     */
    public function isEnabled()
    {
        return false !== $this->_enabled;
    }
}