<?php

namespace JPM\HTTP;

use JPM\HTTP\ParamContainer;

/**
 * Description of ServerContainer
 *
 * @author linkus
 */
class ServerContainer extends ParamContainer
{

    public function getUri()
    {
        return $this->get('REQUEST_SCHEME').'://'.$this->get('SERVER_NAME').$this->get('SCRIPT_NAME');
    }

}
