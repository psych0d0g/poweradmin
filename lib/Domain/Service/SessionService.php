<?php

/*  Poweradmin, a friendly web-based admin tool for PowerDNS.
 *  See <https://www.poweradmin.org> for more details.
 *
 *  Copyright 2007-2010 Rejo Zenger <rejo@zenger.nl>
 *  Copyright 2010-2025 Poweradmin Development Team
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Poweradmin\Domain\Service;

use Poweradmin\Domain\Model\SessionEntity;

class SessionService
{
    public function startSession(SessionEntity $sessionEntity): void
    {
        $this->setSessionData($sessionEntity);
    }

    public function endSession(): void
    {
        session_regenerate_id(true);
        session_unset();
    }

    public function setSessionData(SessionEntity $sessionEntity): void
    {
        $_SESSION['message'] = $sessionEntity->getMessage();
        $_SESSION['type'] = $sessionEntity->getType();
    }
}
