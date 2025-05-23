<?php

namespace Poweradmin\Infrastructure\Utility;

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

class IpAddressRetriever
{
    private array $server;

    public function __construct(array $server)
    {
        $this->server = $server;
    }

    /**
     * Get the client IP address.
     *
     * @return string
     */
    function getClientIp(): string
    {
        $clientIpHeaders = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'REMOTE_ADDR'
        ];

        foreach ($clientIpHeaders as $header) {
            if (!empty($this->server[$header])) {
                $ips = array_filter(explode(',', $this->server[$header]), function ($ip) {
                    return filter_var($ip, FILTER_VALIDATE_IP);
                });

                return $ips[0] ?? '';
            }
        }

        return '';
    }
}
