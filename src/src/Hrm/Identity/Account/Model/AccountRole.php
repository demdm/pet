<?php

namespace App\Hrm\Identity\Account\Model;

use App\Hrm\Common\Type\ArrayEnumType;

final class AccountRole extends ArrayEnumType
{
    const ADMINISTRATOR = 'administrator';
    const COMPANY_OWNER = 'company_owner';
    const HR_MANAGER = 'hr_manager';
    const RECRUITER = 'recruiter';
    const EMPLOYEE = 'employee';
    const USER = 'user';
}
